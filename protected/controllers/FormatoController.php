<?php

class FormatoController extends Controller
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
				'actions'=>array('create','update','admin','delete','verformato','updatestatus','descargaF'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	*	@method descargaF
	*	permite descargar los formatos descargables
	*/
	public function actionDescargaF(){
		$purifier = new CHtmlPurifier();
		if ( isset($_POST['Formato']) ) {
			$acta2 = $purifier->purify($_POST['Formato']);
			$formato = Formato::model()->findByPk($acta2['idf']);
			$this->redirect(Yii::app()->request->baseUrl.$formato->ruta.$formato->nombf);
		}
		exit;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($id);
		$this->render('view',array(
			'formato'=>$this->loadModel($param),
		));
	}

	/**
	 * @method verformato
	 * recibe el id para descargar el formato subido por el tutor
	 */
	public function actionVerformato($id)
	{
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($id);
		$formato = $this->loadModel($param);
		$this->redirect(Yii::app()->request->baseUrl.$formato->ruta.$formato->nombf);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$formato = new Formato;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($fomato);

		if(isset($_POST['Formato']))
		{
			$formato->ftutor = CUploadedFile::getInstance($formato,'ftutor');// archivo pdf

			$formato->opcion	= $_POST['Formato']['opcion'];
			$formato->nombf		= $formato->ftutor->getName();
			$formato->extens	= $formato->ftutor->getExtensionName();
			if (!empty($_POST['Formato']['update_at'])) {
				$formato->ruta		= "/formatos/fd/";
				$formato->update_at = $_POST['Formato']['update_at'];
			}else {
				$formato->ruta		= "/formatos/";
			}
			$formato->tamanio	= $this->convert_format_bytes($formato->ftutor->size);
			$formato->create_at = $_POST['Formato']['create_at'];
			$formato->fkuser	= Yii::app()->user->getUser()->iduser;

			if($formato->save()){
				$formato->ftutor->saveAs(Yii::getPathOfAlias("webroot").$formato->ruta.$formato->nombf);
				Yii::app()->user->setFlash('formatoC','El formato fue Registrado.');
				$this->redirect(array('view','id'=>$formato->idf));
			}else {
				Yii::app()->user->setFlash('error','El formato no fue Registrado.');
				$this->redirect($this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'formato'=>$formato,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$formato = $this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($formato);

		if(isset($_POST['Formato']))
		{
			$formato->ftutor = CUploadedFile::getInstance($formato,'ftutor');

			if ( $formato->ftutor != NULL ) {
				$filef = $this->eliminarArchivo(Yii::getPathOfAlias("webroot").$formato->ruta.$formato->nombf);

				if ($filef) {
					$formato->opcion	= $_POST['Formato']['opcion'];
					$formato->nombf		= $formato->ftutor->getName();
					$formato->extens	= $formato->ftutor->getExtensionName();
					if (!empty($_POST['Formato']['update_at'])) {
						$formato->ruta		= "/formatos/fd/";
						$formato->update_at = $_POST['Formato']['update_at'];
					}else {
						$formato->ruta		= "/formatos/";
					}
					$formato->tamanio	= $this->convert_format_bytes($formato->ftutor->size);
					$formato->create_at = $_POST['Formato']['create_at'];

					$rutaArchivo		= Yii::getPathOfAlias("webroot").$formato->ruta.$formato->nombf;

					if($formato->save()){
						$formato->ftutor->saveAs($rutaArchivo);
						Yii::app()->user->setFlash('formatoC','El formato fue Actualizado.');
						$this->redirect(array('view','id'=>$formato->idf));
					}else {//Crear mensaje flash
						Yii::app()->user->setFlash('error','El formato no fue Actualizado');
						$this->redirect($this->createUrl('site/notfound') );
						//$this->refresh();
					}
				}
			}
		}

		$this->render('update',array(
			'formato'=>$formato,
		));
	}

	/**
	*	@method updatestatus
	*	se actualiza el campo @var status de formato a visto
	*/
	public function actionUpdatestatus($id){
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($_GET['id']);

		if ( !empty($param) ) {
			try {
				$formato = Yii::app()->db->createCommand()->update(
					'sc.formato',
					array("status"=>1),
					'idf = :id',
					array(':id'=>$param)
				);
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/equipo/index'));
			} catch (Exception $e) {
				//echo $e->getMessage();die;
				Yii::app()->user->setFlash('error','No se pudo Marcar como Visto el formato');
				$this->redirect( $this->createUrl('site/notfound') );
			}
		}else {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/equipo/index'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$formato = $this->loadModel($id);
		$ruta = Yii::getPathOfAlias("webroot").$formato->ruta;
		$archivo = $formato->nombf;
		$filef = $this->eliminarArchivo($ruta,$archivo);
		if ($filef) {
			$formato->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$formato = new Formato('search');
		if (Yii::app()->user->checkAccess('tutor')) {// los tutores solo veran los formatos mas no las actas
			$formato->dbCriteria->condition="update_at=0";
		}
		$formato->unsetAttributes();  // clear any default values

		if(isset($_GET['Formato']))
			$formato->attributes = $_GET['Formato'];

		$this->render('index',array(
			'formato'=>$formato,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$formato = new Formato('search');
		if (Yii::app()->user->checkAccess('tutor')) {
			$formato->dbCriteria->condition="update_at=0";
		}
		$formato->unsetAttributes();  // clear any default values
		if(isset($_GET['Formato']))
			$formato->attributes = $_GET['Formato'];

		$this->render('admin',array(
			'formato'=>$formato,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formato the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formato $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
