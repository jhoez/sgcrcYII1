<?php

class LibrosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
		//return array(array('CrugeAccessControlFilter'));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','viewpdf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','viewpdf'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * recibe el id para ver el archivo en una nueva ventana
	 * @method para ver libro
	 */
	public function actionViewpdf()
	{
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($_POST['p']);
		$libros = $this->loadModel($param);
		$this->redirect(Yii::app()->request->baseUrl.$libros->ruta.$libros->nomblib);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'libros'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$libros		= new Libros;
		$img		= new Imagen;
		//$libros->scenario = 'validarPDF';
		//$img->scenario = 'register';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset($_POST['Libros']) && isset($_POST['Imagen']) )
		{
			$transaction	= $img->dbConnection->beginTransaction();
            try{
				$img->imagen	= CUploadedFile::getInstance($img,'imagen');// archivo imagen
				$libros->files	= CUploadedFile::getInstance($libros,'files');// archivo pdf
				//$purifier		= new CHtmlPurifier(); // INSTANCIA PARA PURIFICAR EL PARAMETRO POST

				$img->nombimg	= (string)date( "h:i:s",time() ).$img->imagen->getName();
				$img->extension = $img->imagen->getExtensionName();
				$img->ruta		= "/coleccionLibros/cimg/";
				$img->tamanio	= $this->convert_format_bytes($img->imagen->size);
				$img->fkuser	= Yii::app()->user->getUser()->iduser;

				if ( $img->save() ) {
					$libros->nomblib	= $libros->files->getName();
					$libros->extension	= $libros->files->getExtensionName();

					$coleccion	= $_POST['Libros']['coleccion'];
					$niv		= $_POST['Libros']['nivel'];
					if ($coleccion == 'coleccionBicentenaria') {
						$libros->ruta = "/coleccionLibros/$coleccion/$niv/";
					}elseif( $coleccion == ('coleccionMaestros' || 'lectura') ){
						$libros->ruta = "/coleccionLibros/$coleccion/";
					}
					$libros->coleccion	= $coleccion;
					if ($niv == ('inicial' || 'primaria' || 'media')) {
						$libros->nivel	= $niv;
					}else if($coleccion == 'coleccionMaestros'){
						$libros->nivel	=  'Maestro';
					}elseif ($coleccion == 'lectura') {
						$libros->nivel = 'lectura';
					}

					$libros->tamanio	= $this->convert_format_bytes($libros->files->size);
					$libros->idfkimag	= $img->primaryKey;

					$rutaimagen = Yii::getPathOfAlias("webroot").$img->ruta.$img->nombimg;
					$rutalibro	= Yii::getPathOfAlias("webroot").$libros->ruta.$libros->nomblib;

					if (
						$img->imagen->getExtensionName() == 'png' &&
						$libros->files->getExtensionName() == 'pdf'
					) {
						if ($libros->save()) {
							$img->imagen->saveAs($rutaimagen);
							$libros->files->saveAs($rutalibro);//Guardamos el fichero
							Yii::app()->user->setFlash('libroC',"El Libro '$libros->nomblib' a sido Registrado");
						}
					}
				}

				$transaction->commit();
				$this->redirect(array('view','id'=>$libros->idlib));
			} catch(Exception $e){
				//echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','El libro no fue Registrado. Los formatos aceptables son PNG y PDF');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'libros'	=> $libros,
			'img'		=> $img
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$libros = $this->loadModel($id);
		$img = Imagen::model()->findByPk($libros->idfkimag);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($libros);

		if( isset($_POST['Libros']) && isset($_POST['Imagen']) )
		{
			//$purifier = new CHtmlPurifier(); // INSTANCIA PARA PURIFICAR EL PARAMETRO POST
			$transaction = $libros->dbConnection->beginTransaction();
			try {
				// INSTANCIA DEL FILE IMAGEN Y LIBRO
				$img->imagen	= CUploadedFile::getInstance($img,'imagen');// archivo imagen
				$libros->files	= CUploadedFile::getInstance($libros,'files');// archivo pdf
				// eliminarArchivo DEVUELVE true O false SI ELIMINA O NO LA PORTADA Y EL LIBRO
				$librof		= $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$libros->ruta.$libros->nomblib);
				$imagenf	= $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$img->ruta.$img->nombimg);
				// SI SON TRUE librof y imagenf ACTUALIZA LA PORTADA Y EL LIBRO
				if ($librof && $imagenf) {
					// DATOS DE LA PORTADA
					$img->nombimg	= (string)date( "h:i:s",time() ).$img->imagen->getName();
					$img->extension = $img->imagen->getExtensionName();
					$img->ruta		= "/coleccionLibros/cimg/";
					$img->tamanio	= $this->convert_format_bytes($img->imagen->size);

					if ( $img->save() ) {
						$libros->nomblib	= $libros->files->getName();
						$libros->extension	= $libros->files->getExtensionName();

						if (
							$_POST['Libros']['coleccion'] == 'coleccionBicentenaria' ||
							$_POST['Libros']['coleccion'] == ('coleccionMaestros' || 'lectura')
						) {
							$coleccion			= $_POST['Libros']['coleccion'];
							$niv				= $_POST['Libros']['nivel'];
							$libros->ruta		= "/coleccionLibros/$coleccion/$niv/";
							$libros->coleccion	= $coleccion;
							if ($niv == ('inicial' || 'primaria' || 'media')) {
								$libros->nivel	= $niv;
							}else if(empty($niv)){
								$libros->nivel	= $_POST['Libros']['coleccion'] == 'coleccionMaestros' ? 'Maestro' : 'lectura';
							}
						}

						$libros->tamanio	= $this->convert_format_bytes($libros->files->size);
						$libros->idfkimag	= $img->primaryKey;

						$rutaimagen = Yii::getPathOfAlias("webroot").$img->ruta.$img->nombimg;
						$rutalibro	= Yii::getPathOfAlias("webroot").$libros->ruta.$libros->nomblib;

						// CREAR UN ESCENARIO PARA VALIDAR LA EXTENSION
						if (
							$img->imagen->getExtensionName() == 'png' &&
							$libros->files->getExtensionName() == 'pdf'
						) {
							if ($libros->save()) {
								$img->imagen->saveAs($rutaimagen);
								$libros->files->saveAs($rutalibro);//Guardamos el fichero
								Yii::app()->user->setFlash('libroC',"El Libro '$libros->nomblib' a sido Registrado");
							}
						}
					}
					$transaction->commit();
					$this->redirect(array('view','id'=>$libros->idlib));
				}else {
					Yii::app()->user->setFlash('notfound','La portada o el libro que desea actualizar no existe');
				}
			} catch(Exception $e){
				//echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','La libro no fue Actualizado');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('update',array(
			'libros'=>$libros,
			'img'=>$img
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$libros		= $this->loadModel($id);
		$imag		= Imagen::model()->findByPk($libros->idfkimag);

		$rutalibro	= Yii::getPathOfAlias("webroot").$libros->ruta;
		$filelib	= $libros->nomblib;
		$rutaimagen	= Yii::getPathOfAlias("webroot").$imag->ruta;
		$fileimg	= $imag->nombimg;

		$librof		= $this->eliminarArchivo($rutalibro, $filelib);
		$imagenf	= $this->eliminarArchivo($rutaimagen, $fileimg);
		if ($librof && $imagenf) {
			$libros->delete();
			$imag->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$libros = Libros::model()->findAll();
		$this->render('index',array(
			'libros'=>$libros
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$libros=new Libros('search');
		$libros->unsetAttributes();  // clear any default values
		if(isset($_GET['Libros']))
			$libros->attributes=$_GET['Libros'];

		$this->render('admin',array(
			'libros'=>$libros,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Libros the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Libros::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Libros $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='libros-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
