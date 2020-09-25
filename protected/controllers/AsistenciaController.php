<?php

class AsistenciaController extends Controller
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
				'actions'=>array(
					'create',
					'update',
					'admin',
					'delete',
					'reporteAsistencia',
					'reporteMes',
					'marcarSalida'
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'asistencia'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$asistencia = new Asistencia;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if( isset($_POST['Asistencia']) )
		{
			$fecha			= date("Y-m-d",time());// OBTIENE HORA ACTUAL DE MI MAQUINA

			$asistencia->fkuser	= Yii::app()->user->getUser()->iduser;
			$asistencia->fecha	= $fecha;
			$asistencia->horain	= $_POST['Asistencia']['horain'];

			if ($asistencia->save()) {
				Yii::app()->user->setFlash('asistenciaES','Se logro marcar su Entrada');
				$this->redirect(array('view','id'=>$asistencia->idasis));
			}else {
				Yii::app()->user->setFlash('error','No se logro marcar su Asistencia');
				$this->redirect($this->createUrl('/site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'asistencia'=>$asistencia
		));
	}

	/**
	*	metodo para marcar la salida dependiendo:
	*	si el usuario marco su entrada actualizara el campo horaout de lo contrario
	*	solo marcara su salida en el campo horaout.
	*	@method marcarSalida
	*/
	public function actionMarcarSalida(){
		$asistencia = new Asistencia;

		if( isset($_POST['Asistencia']) )
		{
			$fecha	= date("Y-m-d",time());// OBTIENE HORA ACTUAL DE MI MAQUINA
			$asist	= Asistencia::model()->find(array('condition'=>"fkuser=".Yii::app()->user->getUser()->iduser." AND fecha='$fecha' "));

			if ($asist !== null && $asist->horain === null) {
				$asist->horaout		= $_POST['Asistencia']['horaout'];
				$asist->observacion = $_POST['Asistencia']['observacion'];
				if ( $asist->save() ) {
					Yii::app()->user->setFlash('asistenciaES','Se logro marcar su Salida');
					$this->redirect(array('view','id'=>$asistencia->idasis));
				}else {
					Yii::app()->user->setFlash('error','No se logro marcar su Salida');
					$this->redirect($this->createUrl('/site/notfound') );
				}
			}else {
				$asistencia		= new Asistencia;

				$asistencia->fkuser			= Yii::app()->user->getUser()->iduser;
				$asistencia->fecha			= $fecha;
				$asistencia->horaout		= $_POST['Asistencia']['horaout'];
				$asistencia->observacion	= $_POST['Asistencia']['observacion'];
				if ($asistencia->save()) {
					Yii::app()->user->setFlash('asistenciaES','Se marco solo su Salida');
					$this->redirect(array('view','id'=>$asistencia->idasis));
				}else {
					Yii::app()->user->setFlash('error','No se logro marcar su Asistencia');
					$this->redirect($this->createUrl('/site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
				}
			}

		}//END ISSET($_POST)

		$this->render('create',array(
			'asistencia'=>$asistencia
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Asistencia']))
		{
			$model->attributes=$_POST['Asistencia'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idasis));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$asistencia = new Asistencia('search');
		//$asistencia->dbCriteria->order="idasis DESC";
		$asistencia->unsetAttributes();  // clear any default values
		if(isset($_GET['Asistencia']))
			$asistencia->attributes=$_GET['Asistencia'];

		$this->render('index',array(
			'asistencia'=>$asistencia
		));
	}

	/**
	* @method ReportesPDF
	*/
	public function actionReporteAsistencia()
	{
		// OUTPUT_TO_BROWSER = 'I'
		// OUTPUT_TO_DOWNLOAD = "D"
		// OUTPUT_TO_FILE = "F"
		// OUTPUT_TO_STRING = "S"
		$asistencia = new Asistencia;

		// MEDIDAS DE HOJA A4 WIDTH='992PX' HEIGHT='1403PX'
		if ( isset($_POST['Asistencia']) ) {
			if ( !empty($_POST['Asistencia']['mes']) ) {
				$mes			= $_POST['Asistencia']['mes'];
				$anio			= date('Y');
				$fechainicio	= "$anio-$mes-01";

				if ($mes == 12) {
					$anionuevo	= $anio + 1;
					$fechafinal = "$anioNuevo-01-01";
				}else {
					$mesnuevo	= $mes + 1;
					$fechafinal = "$anio-$mesnuevo-01";
				}

				$asistencia = Asistencia::model()->findAll(array('condition'=>"fecha >= '$fechainicio' and fecha < '$fechafinal'"));
			}else {
				$finicio = $_POST['Asistencia']['fechain'];
				$ffin = $_POST['Asistencia']['fechaout'];
				$asistencia = Asistencia::model()->findAll(array('condition'=>"fecha>='$finicio' AND fecha<='$ffin' "));
			}
			if ( $asistencia != null ) {
				$registros	= 6; // maximo de registros a mostrar en el PDF
				$incre		= 0;
				$control 	= 0;
				$contador	= count($asistencia); // variable de incremento

				try {
					$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','es', true,'UTF-8', array(0, 0, 0, 0) );
					$html2pdf->setDefaultFont('arialunicid0');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					foreach ($asistencia as $key => $value) {
					    if ($incre == $registros) {
							if ( !empty($mes) ) {
								$html2pdf->WriteHTML($this->renderPartial(
									'_reporteAsistencia',
									array(
										'asistencia'=>$asist,
										'mes'=>$mes
									),
								true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}else {
								$html2pdf->WriteHTML($this->renderPartial(
									'_reporteAsistencia',
									array(
										'asistencia'=>$asist,
										'finicio'=>$finicio,
										'ffin'=>$ffin
									),
								true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}
							unset($asist); // VACIA $eq PARA VOLVER A INICIALIZARLA
							$incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
						}
						$asist[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
						$incre++;
						$control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
						// IMPRIME EL RESTO DE LOS REGISTROS
						if ($control == $contador) {
							if ( !empty($mes) ) {
								$html2pdf->WriteHTML($this->renderPartial(
									'_reporteAsistencia',
									array(
										'asistencia'=>$asist,
										'mes'=>$mes
									),
								true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}else {
								$html2pdf->WriteHTML($this->renderPartial(
									'_reporteAsistencia',
									array(
										'asistencia'=>$asist,
										'finicio'=>$finicio,
										'ffin'=>$ffin
									),
								true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}
							unset($asist);
						}
					}
					$pdfFilename = !empty($mes) ? 'Reporte_del_mes_'.$mes.'.pdf' : 'Reporte_de_'.$finicio.'_a_'.$ffin.'.pdf';
					$html2pdf->Output( $pdfFilename, EYiiPdf::OUTPUT_TO_BROWSER );
					Yii::app()->user->setFlash('reporteasis','El reporte ha sido Creado');
					$this->refresh();die;
				} catch ( HTML2PDF_Exception $e ) {
					Yii::app()->user->setFlash('error','El reporte no ha sido Creado');
					$this->redirect($this->createUrl('site/notfound') );
				}
			}
		}

		$this->render('reporte', array(
	        'asistencia' => $asistencia
	    ));
	}// END ACTION REPORTESPDF

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Asistencia the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Asistencia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Asistencia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='asistencia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
