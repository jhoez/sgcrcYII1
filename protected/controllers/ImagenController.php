<?php

class ImagenController extends Controller
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
		return array(array('CrugeAccessControlFilter'));
		/*return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);*/
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular imagen.
	 * @param integer $id the ID of the imagen to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'imag'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new imagen.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$imag = new Imagen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($imag);

		if(isset($_POST['Imagen']))
		{
			$imag->imagen = CUploadedFile::getInstance($imag,'imagen');// archivo imagen

			$imag->nombimg		= (string)date( "h:i:s",time() ).$imag->imagen->getName();
			$imag->extension	= $imag->imagen->getExtensionName();
			$imag->ruta			= "/proyectos/img/";
			$imag->tamanio		= $this->convert_format_bytes($imag->imagen->size);
			$imag->tipoimg		= 'noticia';
			$imag->fkuser		= Yii::app()->user->getUser()->iduser;

			$rutaimagen = Yii::getPathOfAlias("webroot").$imag->ruta.$imag->nombimg;

			if ( $imag->imagen->getExtensionName() == 'png' ) {
				if ( $imag->save() ) {
					$imag->imagen->saveAs($rutaimagen);
					Yii::app()->user->setFlash('imagenC',"La imagen '$imag->nombimg' a sido Registrada");
					$this->redirect(array('view','id'=>$imag->idimag));
				}else {
					Yii::app()->user->setFlash('error','La imagen no fue Registrada.');
					$this->redirect($this->createUrl('/site/notfound'));
				}
			}
		}

		$this->render('create',array(
			'imag'=>$imag,
		));
	}

	/**
	 * Updates a particular imagen.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the imagen to be updated
	 */
	public function actionUpdate($id)
	{
		$imagen = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($imagen);

		if(isset($_POST['Imagen']))
		{
			$imagen->imagen	= CUploadedFile::getInstance($imagen,'imagen');// archivo imagen
			$imgf			= $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$imagen->ruta.$imagen->nombimg);

			if ($imgf) {
				$imagen->nombimg	= (string)date( "h:i:s",time() ).$imagen->imagen->getName();
				$imagen->extension	= $imagen->imagen->getExtensionName();
				$imagen->ruta		= "/proyectos/img/";
				$imagen->tamanio	= $this->convert_format_bytes($imagen->imagen->size);
				$imagen->tipoimg	= 'noticia';
				$rutaimagen			= Yii::getPathOfAlias("webroot").$imagen->ruta.$imagen->nombimg;

				if ( $imagen->imagen->getExtensionName() == 'png' ) {
					if ( $imagen->save() ) {
						$imagen->imagen->saveAs($rutaimagen);
						Yii::app()->user->setFlash('imagenC',"La imagen '$imagen->nombimg' a sido Actualizada");
						$this->redirect(array('view','id'=>$imagen->idimag));
					}
				}
			} else {
				Yii::app()->user->setFlash('notfound',"La imagen que desea Actualizar no existe");
			}
		}

		$this->render('update',array(
			'imagen'=>$imagen,
		));
	}

	/**
	 * Deletes a particular imagen.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the imagen to be deleted
	 */
	public function actionDelete($id)
	{
		$imagen = $this->loadModel($id);
		$rutaimagen	= Yii::getPathOfAlias("webroot").$imagen->ruta;
		$archivo = $imagen->nombimg;
		$imagenf = $this->eliminarArchivo($rutaimagen,$archivo);

		if ($imagenf) {
			$imagen->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all imagens.
	 */
	public function actionIndex()
	{
		/*
		$criteria = new CDbCriteria;
		$criteria->addCondition("tipoimg='noticia'");
		$pagination = array('pageSize'=>'10');
		$dataProvider = new CActiveDataProvider('Imagen',array('criteria'=>$criteria,'pagination'=>$pagination));
		*/
		$dataProvider = new CActiveDataProvider(
			'Imagen',
			array('criteria'=>
				array(
					'condition'=>"tipoimg='noticia'",
					'order'=>'idimag DESC'
				)
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all imagens.
	 */
	public function actionAdmin()
	{
		$imagen=new Imagen;
		$imagen->dbCriteria->condition="tipoimg='noticia'";

		$imagen->unsetAttributes();  // clear any default values

		if(isset($_GET['Imagen']))
			$imagen->attributes=$_GET['Imagen'];

		$this->render('admin',array(
			'imagen'=>$imagen,
		));
	}

	/**
	 * Returns the data imagen based on the primary key given in the GET variable.
	 * If the data imagen is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the imagen to be loaded
	 * @return Imagen the loaded imagen
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$imagen=Imagen::model()->findByPk($id);
		if($imagen===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $imagen;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Imagen $imagen the imagen to be validated
	 */
	protected function performAjaxValidation($imagen)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imagen-form')
		{
			echo CActiveForm::validate($imagen);
			Yii::app()->end();
		}
	}
}
