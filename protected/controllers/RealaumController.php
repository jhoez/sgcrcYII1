<?php

class RealaumController extends Controller
{
	//Indicamos que este controlador utilizará la siguiente plantilla
	//public $layout="//layouts/plantilla";

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','verra'),
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
	public function actionVerra($id)
	{
		$this->layout="//layouts/nothing";
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($id);
		$realidadaumentada = $this->loadModel($param);

		$this->render('plantillara',array(
			'realidadaumentada'=>$realidadaumentada,
		));

	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$proyecto			= new	Proyecto;
		$imag				= new	Imagen;
		$realidadaumentada	= new	Realaum;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($realidadaumentada);

		if( isset($_POST['Realaum']) && isset($_POST['Proyecto']) )
		{
			//$purifier = new CHtmlPurifier(); // INSTANCIA PARA PURIFICAR EL PARAMETRO POST

			$transaction = $proyecto->dbConnection->beginTransaction();
            try{
				$realidadaumentada->fileglb = CUploadedFile::getInstance($realidadaumentada,'fileglb');// archivo pdf
				$imag->imagen = CUploadedFile::getInstance($imag,'imagen');// archivo imagen

				$proyecto->nombpro		= $_POST['Proyecto']['nombpro'];
				$proyecto->creador		= $_POST['Proyecto']['creador'];
				$proyecto->colaboracion = $_POST['Proyecto']['colaboracion'];
				$proyecto->descripcion	= $_POST['Proyecto']['descripcion'];
				$proyecto->create_at	= $_POST['Proyecto']['create_at'];
				$proyecto->fkuser		= Yii::app()->user->getUser()->iduser;
				if( $proyecto->save() ){
					$imag->nombimg		= (string)date( "h:i:s",time() ).$imag->imagen->getName();
					$imag->extension	= $imag->imagen->getExtensionName();
					$imag->ruta			= "/proyectos/raimg/";
					$imag->tamanio		= $this->convert_format_bytes($imag->imagen->size);
					$imag->tipoimg		= 'ra';

					if ($imag->save()) {
						$realidadaumentada->nra		= $realidadaumentada->fileglb->getName();
						$realidadaumentada->exten	= $realidadaumentada->fileglb->getExtensionName();
						$realidadaumentada->ruta	= '/proyectos/ra/';
						$realidadaumentada->fk_pro	= $proyecto->primaryKey;
						$realidadaumentada->fkimag	= $imag->primaryKey;

						$rutaimagen	= Yii::getPathOfAlias("webroot").$imag->ruta.$imag->nombimg;
						$rutara		= Yii::getPathOfAlias("webroot").$realidadaumentada->ruta.$realidadaumentada->nra;

						if ( $realidadaumentada->save() ) {
							$realidadaumentada->fileglb->saveAs($rutara);
							$imag->imagen->saveAs($rutaimagen);
							Yii::app()->user->setFlash('raC','El proyecto de Realidad Aumentada fue Registrado');
						}
					}
				}

				$transaction->commit();
				$this->redirect(array('view','id'=>$realidadaumentada->idra));
			} catch(Exception $e){
				echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','El proyecto de Realidad Aumentada no fue Registrado');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'realidadaumentada'=>$realidadaumentada,
			'proyecto'=>$proyecto,
			'imag'=>$imag
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$realidadaumentada	= $this->loadModel($id);
		$imag				= Imagen::model()->findByPk($realidadaumentada->fkimag);
		$proyecto			= Proyecto::model()->findByPk($realidadaumentada->fk_pro);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($realidadaumentada);

		if(isset($_POST['Realaum']))
		{
			$transaction = $proyecto->dbConnection->beginTransaction();
			try{
				$realidadaumentada->fileglb	= CUploadedFile::getInstance($realidadaumentada,'fileglb');// archivo imagen
				$imag->imagen				= CUploadedFile::getInstance($imag,'imagen');// archivo imagen

				$raf	= $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$realidadaumentada->ruta.$realidadaumentada->nra);// unlink() borra el archivo
				$imgf	= $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$imag->ruta.$imag->nombimg);

				if ( $raf && $imgf ) {
					$proyecto->nombpro = $_POST['Proyecto']['nombpro'];
					$proyecto->creador = $_POST['Proyecto']['creador'];
					$proyecto->colaboracion = $_POST['Proyecto']['colaboracion'];
					$proyecto->descripcion = $_POST['Proyecto']['descripcion'];
					$proyecto->update_at = $_POST['Proyecto']['update_at'];
					if( $proyecto->save() ){
						$imag->nombimg		= (string)date( "h:i:s",time() ).$imag->imagen->getName();
						$imag->extension	= $imag->imagen->getExtensionName();
						$imag->ruta			= "/proyectos/raimg/";
						$imag->tamanio		= $this->convert_format_bytes($imag->imagen->size);
						$imag->tipoimg		= 'ra';

						if ($imag->save()) {
							$realidadaumentada->nra		= $realidadaumentada->fileglb->getName();
							$realidadaumentada->exten	= $realidadaumentada->fileglb->getExtensionName();
							$realidadaumentada->ruta	= '/proyectos/ra/';
							$realidadaumentada->fkimag	= $imag->primaryKey;

							$rutaimagen	= Yii::getPathOfAlias("webroot").$imag->ruta.$imag->nombimg;
							$rutara		= Yii::getPathOfAlias("webroot").$realidadaumentada->ruta.$realidadaumentada->nra;

							if ( $realidadaumentada->save() ) {
								$realidadaumentada->fileglb->saveAs($rutara);
								$imag->imagen->saveAs($rutaimagen);
								Yii::app()->user->setFlash('raC','El proyecto de Realidad Aumentada fue Actualizado');
							}
						}
					}

					$transaction->commit();
					$this->redirect(array('view','id'=>$realidadaumentada->idra));
				}else {
					Yii::app()->user->setFlash('notfound','El archivo de Realidad Aumentada que deseas Actualizar no existe');
				}
			} catch(Exception $e){
				//echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','El proyecto de Realidad Aumentada no fue Actualizado');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}

		}// END IF $_POST

		$this->render('update',array(
			'realidadaumentada'=>$realidadaumentada,
			'proyecto'=>$proyecto,
			'imag'=>$imag
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$realidadaumentada	= $this->loadModel($id);
		$imagen				= Imagen::model()->findByPk($realidadaumentada->fkimag);
		$proyecto			= Proyecto::model()->findByPk($realidadaumentada->fk_pro);
		// RUTAS
		$rutara		= Yii::getPathOfAlias("webroot").$realidadaumentada->ruta;
		$filera		= $realidadaumentada->nra;
		$rutaimg	= Yii::getPathOfAlias("webroot").$imagen->ruta;
		$fileimg	= $imagen->nombimg;
		// LLAMADA A FUNCTION eliminarArchivo
		$nraf = $this->eliminarArchivo($rutara,$filera);
		$imgf = $this->eliminarArchivo($rutaimg,$fileimg);
		if ($nraf && $imgf) {
			$realidadaumentada->delete();
			$imagen->delete();
			$proyecto->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if($nraf && !isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Realaum');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$realidadaumentada = new Realaum('search');
		$realidadaumentada->unsetAttributes();  // clear any default values
		if(isset($_GET['Realaum']))
			$realidadaumentada->attributes=$_GET['Realaum'];

		$this->render('admin',array(
			'realidadaumentada'=>$realidadaumentada,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Realaum the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Realaum::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Realaum $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='realaum-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
