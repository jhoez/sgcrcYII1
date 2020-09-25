<?php

class MultimediaController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','descargarwav','descargar'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	*
	*
	*/
	public function actionDescargarwav($id) {
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($id);
		$multimedia = $this->loadModel($param);
		$this->redirect(Yii::app()->request->baseUrl.$multimedia->ruta.$multimedia->nombmult);
	}

	/**
	*	@method	Descargar
	*
	*/
	public function actionDescargar() {
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($_POST['m']);
		$multimedia = $this->loadModel($param);
	 	$this->redirect(Yii::app()->request->baseUrl.$multimedia->ruta.$multimedia->nombmult);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'multimedia'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$proyecto = new Proyecto;
		$multimedia = new Multimedia;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset($_POST['Proyecto']) )
		{
			$transaction = $proyecto->dbConnection->beginTransaction();
            try{
				$multimedia->mva = CUploadedFile::getInstance($multimedia,'mva');// archivo pdf

				$proyecto->nombpro		= $_POST['Proyecto']['nombpro'];
				$proyecto->creador		= $_POST['Proyecto']['creador'];
				$proyecto->colaboracion = $_POST['Proyecto']['colaboracion'];
				$proyecto->descripcion	= $_POST['Proyecto']['descripcion'];
				$proyecto->create_at	= $_POST['Proyecto']['create_at'];
				$proyecto->fkuser		= Yii::app()->user->getUser()->iduser;

				if($proyecto->save()){
					$multimedia->nombmult	= $multimedia->mva->getName();
					$multimedia->extension	= $multimedia->mva->getExtensionName();
					$multimedia->tamanio	= $this->convert_format_bytes( $multimedia->mva->size );
					if ($multimedia->mva->getExtensionName() == 'mp4') {
						$multimedia->tipomult	= 'video';
						$multimedia->ruta		= '/proyectos/video/';
					}elseif ($multimedia->mva->getExtensionName() == 'mp3') {
						$multimedia->tipomult	= 'audio';
						$multimedia->ruta		= '/proyectos/audio/';
					}
					$multimedia->fkidpro = $proyecto->primaryKey;
					$rutamultimedia = Yii::getPathOfAlias("webroot").$multimedia->ruta.$multimedia->nombmult;

					if (
						$multimedia->mva->getExtensionName() == 'mp4' ||
						$multimedia->mva->getExtensionName() == 'mp3'
					) {
						if ($multimedia->save()){
							$multimedia->mva->saveAs($rutamultimedia);
							Yii::app()->user->setFlash('multimediaC',"El Proyecto '$proyecto->nombpro' a sido Registrado");
						}
					}
				}

				$transaction->commit();
				$this->redirect( array('view','id'=>$multimedia->idmult) );
			} catch(Exception $e){
				//echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','El proyecto Digital no fue Registrado');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'proyecto'		=> $proyecto,
			'multimedia'	=> $multimedia
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$multimedia = $this->loadModel($id);
		$proyecto = Proyecto::model()->findByPk($multimedia->fkidpro);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Multimedia']))
		{
			$transaction = $proyecto->dbConnection->beginTransaction();
			try{
				$multimedia->mva = CUploadedFile::getInstance($multimedia,'mva');// archivo imagen
				$multf = $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$multimedia->ruta.$multimedia->nombmult);// borra el archivo

				if ( $multf ) {
					$proyecto->nombpro		= $_POST['Proyecto']['nombpro'];
					$proyecto->creador		= $_POST['Proyecto']['creador'];
					$proyecto->colaboracion = $_POST['Proyecto']['colaboracion'];
					$proyecto->descripcion	= $_POST['Proyecto']['descripcion'];
					$proyecto->update_at	= $_POST['Proyecto']['update_at'];

					if($proyecto->save()){
						$multimedia->nombmult	= $multimedia->mva->getName();
						$multimedia->extension	= $multimedia->mva->getExtensionName();
						$multimedia->tamanio	= $this->convert_format_bytes( $multimedia->mva->size );
						if ($multimedia->mva->getExtensionName() == 'mp4') {
							$multimedia->tipomult	= 'video';
							$multimedia->ruta		= '/proyectos/video/';
						}elseif ($multimedia->mva->getExtensionName() == 'mp3') {
							$multimedia->tipomult	= 'audio';
							$multimedia->ruta		= '/proyectos/audio/';
						}

						$rutamultimedia = Yii::getPathOfAlias("webroot").$multimedia->ruta.$multimedia->nombmult;

						if (
							($multimedia->mva->getExtensionName() == 'mp4' ||
							$multimedia->mva->getExtensionName() == 'mp3') &&
							$multimedia->save()
						) {
							$multimedia->mva->saveAs($rutamultimedia);
							Yii::app()->user->setFlash('multimediaC',"El Proyecto Digital '$proyecto->nombpro' fue actualizado");
						}

					}

					$transaction->commit();
					$this->redirect( array('view','id'=>$multimedia->idmult) );
				}else {
					Yii::app()->user->setFlash('notfound','No existe el archivo multimedia del Proyecto Digital que desea Actualizar');
				}
			} catch(Exception $e){
				//echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','El Proyecto Digital no fue Actualizado');
				$this->redirect( $this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('update',array(
			'proyecto' => $proyecto,
			'multimedia'=>$multimedia
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$multimedia		= $this->loadModel($id);
		$proyecto		= Proyecto::model()->findByPk($multimedia->fkidpro);
		$rutamultimedia	= Yii::getPathOfAlias("webroot").$multimedia->ruta;
		$filemult		= $multimedia->nombmult;
		$multf = $this->eliminarArchivo($rutamultimedia,$filemult);
		if ($multf) {
			$multimedia->delete();
			$proyecto->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if($multf && !isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$multimedia = Multimedia::model()->findAll();
		$this->render('index',array(
			'multimedia'=>$multimedia
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$multimedia = new Multimedia('search');
		$multimedia->unsetAttributes();  // clear any default values
		if(isset($_GET['Multimedia'])){
			$multimedia->attributes=$_GET['Multimedia'];
		}

		$this->render('admin',array(
			'multimedia' => $multimedia
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Multimedia the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Multimedia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Multimedia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='multimedia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
