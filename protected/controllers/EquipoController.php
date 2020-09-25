<?php

class EquipoController extends Controller
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
				'actions'=>array(
					'admin',
					'delete',
					'create',
					'update',
					'updatedate',
					'muncall',
					'parrall',
					//'generarpdf',
					'reportespdf',
					'reporteFallas',
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
			'equipo'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$estado			=	new		Estado;
		$municipio		=	new		Municipio;
		$parroquia		=	new		Parroquia;
		$sedeciat		=	new		Sedeciat;
		$insteduc		=	new		Insteduc;
		$representante	=	new		Representante;
		$direcuser		=	new		Direcuser;
		$estudiante		=	new		Estudiante;
		$niveleduc		=	new		Niveleduc;
		$equipo			=	new		Equipo;
		$fsoftware		=	new		Fsoftware;
		$fpantalla		=	new		Fpantalla;
		$ftarjetamadre	=	new		Ftarjetamadre;
		$fteclado		=	new		Fteclado;
		$fcarga			=	new		Fcarga;
		$fgeneral		=	new		Fgeneral;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($estado);

		if(
			isset($_POST['Equipo'])			&&
			isset($_POST['Estado'])			&&
			isset($_POST['Municipio'])		&&
			isset($_POST['Parroquia'])		&&
			isset($_POST['Sedeciat'])		&&
			isset($_POST['Insteduc'])		&&
			isset($_POST['Representante'])	&&
			isset($_POST['Estudiante'])		&&
			isset($_POST['Niveleduc'])		&&
			isset($_POST['Fsoftware'])		&&
			isset($_POST['Fpantalla'])		&&
			isset($_POST['Ftarjetamadre'])	&&
			isset($_POST['Fteclado'])		&&
			isset($_POST['Fcarga'])			&&
			isset($_POST['Fgeneral'])
		){
			$transaction = $equipo->dbConnection->beginTransaction();
            try{
				$sedeciat->attributes	=	$_POST['Sedeciat'];
				if( $sedeciat->save() ) {
					$insteduc->attributes	=	$_POST['Insteduc'];
					if( $insteduc->save() ) {
						$representante->attributes	=	$_POST['Representante'];
						$representante->idciat		=	$sedeciat->primaryKey;
						$representante->fkuser		=	Yii::app()->user->getUser()->iduser;
						$representante->idinst		=	$insteduc->primaryKey;
						if( $representante->save() ) {
							$estudiante->attributes		=	$_POST['Estudiante'];
							$estudiante->idinst			=	$insteduc->primaryKey;
							$estudiante->idrep			=	$representante->primaryKey;
							if ( $estudiante->save() ) {
								$niveleduc->attributes		=	$_POST['Niveleduc'];
								$niveleduc->idestu			=	$estudiante->primaryKey;
								if ( $niveleduc->save() ) {
									$direcuser->idfkesta		=	trim($_POST['Estado']['idesta']);
									$direcuser->idfkmunc		=	trim($_POST['Municipio']['idmunc']);
									$direcuser->idfkpar			=	trim($_POST['Parroquia']['idpar']);
									$direcuser->idfkciat		=	trim($sedeciat->primaryKey);
									$direcuser->idfkinst		=	trim($insteduc->primaryKey);
									$direcuser->idfkrep			=	trim($representante->primaryKey);
									if ( $direcuser->save() ) {
										$equipo->attributes		=	$_POST['Equipo'];
										$equipo->idrep			=	$representante->primaryKey;
										if ( $equipo->save() ) {
											$fsoftware->attributes	=	$_POST['Fsoftware'];
											$fsoftware->ideq		=	$equipo->primaryKey;
											if ( $fsoftware->save() ) {
												$fpantalla->attributes	=	$_POST['Fpantalla'];
												$fpantalla->ideq		=	$equipo->primaryKey;
												if ( $fpantalla->save() ) {
													$ftarjetamadre->attributes	=	$_POST['Ftarjetamadre'];
													$ftarjetamadre->ideq		=	$equipo->primaryKey;
													if ( $ftarjetamadre->save() ) {
														$fteclado->attributes	=	$_POST['Fteclado'];
														$fteclado->ideq			=	$equipo->primaryKey;
														if ( $fteclado->save() ) {
															$fcarga->attributes	=	$_POST['Fcarga'];
															$fcarga->ideq		=	$equipo->primaryKey;
															if ( $fcarga->save() ) {
																$fgeneral->attributes	=	$_POST['Fgeneral'];
																$fgeneral->ideq			=	$equipo->primaryKey;
																if ( $fgeneral->save() ) {
																	Yii::app()->user->setFlash('canaimitaC',"La Canaimita $equipo->eqserial fue Registrada");
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}

				$transaction->commit();
				$this->redirect(array('view','id'=>$equipo->ideq));
			} catch(Exception $e){
				echo $e->getMessage();die;
				$transaction->rollBack();
				Yii::app()->user->setFlash('error','La Canaimita no fue ser Registrada');
				$this->redirect($this->createUrl('site/notfound') );// redirecciona a una vista cuando no sea exitoso el registro
			}
		}

		$this->render('create',array(
			'estado'		=>	$estado,
			'municipio'		=>	$municipio,
			'parroquia'		=>	$parroquia,
			'sedeciat'		=>	$sedeciat,
			'insteduc'		=>	$insteduc,
			'representante'	=>	$representante,
			'estudiante'	=>	$estudiante,
			'niveleduc'		=>	$niveleduc,
			'equipo'		=>	$equipo,
			'fsoftware'		=>	$fsoftware,
			'fpantalla'		=>	$fpantalla,
			'ftarjetamadre'	=>	$ftarjetamadre,
			'fteclado'		=>	$fteclado,
			'fcarga'		=>	$fcarga,
			'fgeneral'		=>	$fgeneral,
		));
	}// fin create

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$equipo			= 	$this->loadModel($id);
		$estado			=	new		Estado;
		$municipio		=	new		Municipio;
		$parroquia		=	new		Parroquia;
		$sedeciat		=	new		Sedeciat;
		$insteduc		=	new		Insteduc;
		$representante	=	new		Representante;
		$estudiante		=	new		Estudiante;
		$niveleduc		=	new		Niveleduc;
		$fsoftware		=	new		Fsoftware;
		$fpantalla		=	new		Fpantalla;
		$ftarjetamadre	=	new		Ftarjetamadre;
		$fteclado		=	new		Fteclado;
		$fcarga			=	new		Fcarga;
		$fgeneral		=	new		Fgeneral;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($equipo);

		if(isset($_POST['Equipo']))
		{
			$equipo->attributes = $_POST['Equipo'];
			if($equipo->save())
				$this->redirect(array('view','id'=>$equipo->id));
		}

		$this->render('update',array(
			'estado'		=>	$estado,
			'municipio'		=>	$municipio,
			'parroquia'		=>	$parroquia,
			'sedeciat'		=>	$sedeciat,
			'insteduc'		=>	$insteduc,
			'representante'	=>	$representante,
			'estudiante'	=>	$estudiante,
			'niveleduc'		=>	$niveleduc,
			'equipo'		=>	$equipo,
			'fsoftware'		=>	$fsoftware,
			'fpantalla'		=>	$fpantalla,
			'ftarjetamadre'	=>	$ftarjetamadre,
			'fteclado'		=>	$fteclado,
			'fcarga'		=>	$fcarga,
			'fgeneral'		=>	$fgeneral,
		));
	}

	/**
	*	@method updatedate
	*	Se actualiza la propiedad @var fentrega cuando el equipo sea entregado...
	*/
	public function actionUpdatedate($id){
		$purifier = new CHtmlPurifier();
		$param = $purifier->purify($id);

		if ( !empty($param) ) {
			try {
				$fecha = date( "Y-m-d",time() );// OBTIENE FECHA ACTUAL DE MI MAQUINA
				$equipo = Yii::app()->db->createCommand()->update(
					'sc.equipo',
					array("fentrega"=>$fecha,"status"=>1),// campos que a actualizar
					'ideq = :id',
					array(':id'=>$param)
				);
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			} catch (Exception $e) {
				//echo $e->getMessage();die;
				Yii::app()->user->setFlash('error','No se pudo Marcar como entregado el equipo');
				$this->redirect( $this->createUrl('site/notfound') );
			}
		}else {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}

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
		$equipo = new Equipo('search');
		$equipo->unsetAttributes();  // clear any default values
		$formato = new Formato;// solo para las actas descargables
		$formato2 = new Formato('search');
		if (Yii::app()->user->checkAccess('tutor')) { // los tutores solo veran los formatos mas no las actas
			$formato2->dbCriteria->condition="update_at=0";
		}
		$formato2->unsetAttributes();  // clear any default values

		if( isset($_GET['Equipo']) ){
			$equipo->attributes = $_GET['Equipo'];
		}elseif (isset($_GET['Formato'])) {
			$formato2->attributes = $_GET['Formato'];
		}

		$this->render('index',array(
			'equipo'	=> $equipo,
			'formato'	=> $formato,
			'formato2'	=> $formato2
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$equipo = new Equipo('search');
		$equipo->unsetAttributes();  // clear any default values

		if(isset($_GET['Equipo'])){
			$equipo->attributes=$_GET['Equipo'];
		}

		$this->render('admin',array(
			'equipo'=>$equipo,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Equipo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Equipo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Equipo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * @Muncall
	 */
	public function actionMuncall(){
		$idesta = $_POST['Estado']['idesta'];
		$listmunc = Municipio::model()->findAll( 'idesta = :id_esta', array(':id_esta' => $idesta) );
		$listmunc = CHtml::listData($listmunc,'idmunc','municipio');

		echo CHtml::tag( 'option', array( 'value'=>'' ), 'Seleccione', true );
		foreach ($listmunc as $clave => $municipio) {
			echo CHtml::tag(
				'option',array('value'=>$clave),
				CHtml::encode($municipio),true
			);
		}
	}

	/**
	 * @Parrall
	 */
	public function actionParrall(){
		$idmunc = $_POST['Municipio']['idmunc'];
		$listpar = Parroquia::model()->findAll( "idmunc = :id_munc", array(":id_munc" => $idmunc) );
		$listpar = CHtml::listData($listpar,'idpar','parroquia');

		echo CHtml::tag( 'option', array( 'value'=>'' ), 'Seleccione', true );
		foreach ($listpar as $clave => $parroquia) {
			echo CHtml::tag(
				'option',array('value'=>$clave),
				CHtml::encode($parroquia),true
			);
		}
	}

	/**
	*	@method reporte individual pdf
	*	metodo utilizado para generar un reporte individual de un solo registro.
	*/
	public function actionGenerarpdf($id = "")
	{
	    $equipo = new Equipo('search');
		$equipo->unsetAttributes();  // clear any default values

	    // empty($id) Se evalúa a true ya que $id está vacia
	    // !empty($id) Se evalúa a true con la negación ya que $var no está vacia
	    if ( !empty($id) ) {
	        try {
	            $equipo = Equipo::model()->findByPk($id); //Consulta para buscar todos los registros
	            $html2pdf = Yii::app()->ePdf->HTML2PDF( 'P','A4','es','true','UTF-8', array(14, 5, 14, 5) );
				/*
				FUNCIONA
				ob_start();
				$html = $this->renderPartial( '_reportePDF', array('equipo'=>$equipo),false );
				$reportePDF = ob_get_clean();
				*/
				$reportePDF = $this->renderPartial( '_reportePDF', array('equipo'=>$equipo),true );
				$html2pdf->WriteHTML( $reportePDF ); //hacemos un render partial a una vista preparada, en este caso es la vista pdfReport
	            $pdfFilename = 'Canaimita_serial_'.$equipo->eqserial.'.pdf';
				//return $html2pdf->Output( $pdfFilename, EYiiPdf::OUTPUT_TO_BROWSER );
				$html2pdf->Output( $pdfFilename,'FI', EYiiPdf::OUTPUT_TO_DOWNLOAD );
	            die;
	        } catch (HTML2PDF_Exception $e) {
	            //$formatter = new ExceptionFormatter($e);
	            //echo $formatter->getHtmlMessage();
	            $this->redirect($this->createUrl('site/notfound') );
	        }
	    }

	    $this->render('reporte', array(
	        'equipo' => $equipo
	    ));

	}// END ACTION

	/**
	*	@method ReportesPDF
	*	metodo utilizado para crear el reporte mediante la fecha de inicio y fecha fin
	*	el cual creara un pdf con todos los registros entre las dos fechas ingresadas.
	*/
	public function actionReportespdf()
	{
		// OUTPUT_TO_BROWSER = 'I'
		// OUTPUT_TO_DOWNLOAD = "D"
		// OUTPUT_TO_FILE = "F"
		// OUTPUT_TO_STRING = "S"
		$equipo			=	new		Equipo;
		$fsoftware		=	new		Fsoftware;
		$fpantalla		=	new		Fpantalla;
		$ftarjetamadre	=	new		Ftarjetamadre;
		$fteclado		=	new		Fteclado;
		$fcarga			=	new		Fcarga;
		$fgeneral		=	new		Fgeneral;


		// MEDIDAS DE HOJA A4 WIDTH='992PX' HEIGHT='1403PX'
		if ( isset($_POST['Equipo']) ) {
			if ( !empty($_POST['Equipo']['mes']) ) {
				$mes = $_POST['Equipo']['mes'];
				$anio = date('Y');
				$fechainicio = "$anio-$mes-01";

				if ($mes == 12) {
					$anionuevo = $anio + 1;
					$fechafinal = "$anioNuevo-01-01";
				}else {
					$mesnuevo = $mes + 1;
					$fechafinal = "$anio-$mesnuevo-01";
				}
				$equipo = Equipo::model()->findAll(array('condition'=>"frecepcion >='$fechainicio' AND frecepcion < '$fechafinal'"));
			}else if ( !empty($_POST['Equipo']['frecepcion']) ) {
				$finicio = $_POST['Equipo']['frecepcion'];
				$ffin = $_POST['Equipo']['fentrega'];
				$equipo = Equipo::model()->findAll(array('condition'=>"frecepcion >='$finicio' AND frecepcion <= '$ffin'"));
			}


			try {
				if ( $equipo !== null ) {
					$registros	= 6; // maximo de registros a mostrar en el PDF
					$incre		= 0;
					$control 	= 0;
					$contador	= count($equipo); // variable de incremento

					$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','es', true,'UTF-8', array(0, 0, 0, 0) );
					$html2pdf->setDefaultFont('arialunicid0');
					$html2pdf->pdf->SetDisplayMode('fullpage');

					foreach ($equipo as $key => $value) {
					    if ($incre == $registros) {
							if ( !empty($mes) ) {
								$html2pdf->WriteHTML($this->renderPartial('_reportesPDF',array(
									'equipo'=>$eq,
									'mes'=>$mes
								),true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}else {
								$html2pdf->WriteHTML($this->renderPartial('_reportesPDF',array(
									'equipo'=>$eq,
									'finicio'=>$finicio,
									'ffin'=>$ffin
								),true));
							}
							unset($eq); // VACIA $eq PARA VOLVER A INICIALIZARLA
							$incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
						}
						$eq[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
						$incre++;
						$control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
						// IMPRIME EL RESTO DE LOS REGISTROS
						if ($control == $contador) {
							if ( !empty($mes) ) {
								$html2pdf->WriteHTML($this->renderPartial('_reportesPDF',array(
									'equipo'=>$eq,
									'mes'=>$mes
								),true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							}else {
								$html2pdf->WriteHTML($this->renderPartial('_reportesPDF',array(
									'equipo'=>$eq,
									'finicio'=>$finicio,
									'ffin'=>$ffin
								),true));
							}
						}
					}

					$pdfFilename = !empty($mes) ? 'Reporte_del_mes_'.$mes.'.pdf' : 'Reporte_de_'.$finicio.'_a_'.$ffin.'.pdf';
					$html2pdf->Output( $pdfFilename, EYiiPdf::OUTPUT_TO_BROWSER );
					Yii::app()->user->setFlash('reporteC','El reporte ha sido Creado');
					$this->refresh();die;
				}
			} catch ( HTML2PDF_Exception $e ) {
				Yii::app()->user->setFlash('error','El reporte no ha sido Creado');
				$this->redirect($this->createUrl('site/notfound') );
			}
		}

		$this->render('reporte', array(
	        'equipo'		=>	$equipo,
			'equipo'		=>	$equipo,
			'fsoftware'		=>	$fsoftware,
			'fpantalla'		=>	$fpantalla,
			'ftarjetamadre'	=>	$ftarjetamadre,
			'fteclado'		=>	$fteclado,
			'fcarga'		=>	$fcarga,
			'fgeneral'		=>	$fgeneral,
	    ));
	}// END ACTION REPORTESPDF

	/**
	*	@method reporteFallas
	*	metodo utilizado crear el reporte por la falla que se alla seleccionado.
	*/
	public function actionReporteFallas()
	{
		// OUTPUT_TO_BROWSER = 'I'
		// OUTPUT_TO_DOWNLOAD = "D"
		// OUTPUT_TO_FILE = "F"
		// OUTPUT_TO_STRING = "S"
		$equipo	= new Equipo;

		// MEDIDAS DE HOJA A4 WIDTH='992PX' HEIGHT='1403PX'
		if ( isset($_POST) ) {
			if($_POST['Fsoftware']['fsoft']){
				$clase = 'Fsoftware';
				$index = 'fsoft';
				$falla = $_POST['Fsoftware']['fsoft'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}else
			if($_POST['Fpantalla']['fpant']){
				$clase = 'Fpantalla';
				$index = 'fpant';
				$falla = $_POST['Fpantalla']['fpant'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}else
			if($_POST['Ftarjetamadre']['ftarj']){
				$clase = 'Ftarjetamadre';
				$index = 'ftarj';
				$falla = $_POST['Ftarjetamadre']['ftarj'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}else
			if($_POST['Fteclado']['ftec']){
				$clase = 'Fteclado';
				$index = 'ftec';
				$falla = $_POST['Fteclado']['ftec'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}else
			if($_POST['Fcarga']['fcarg']){
				$clase = 'Fcarga';
				$index = 'fcarg';
				$falla = $_POST['Fcarga']['fcarg'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}else
			if($_POST['Fgeneral']['fgen']){
				$clase = 'Fgeneral';
				$index = 'fgen';
				$falla = $_POST['Fgeneral']['fgen'];
				$equipo = $this->construirConsultar($clase,$index,$falla);
			}

			if ( $equipo != false ) {
				$registros	= 6; // maximo de registros a mostrar en el PDF
				$incre		= 0;
				$control 	= 0;
				$contador	= count($equipo); // variable de incremento

					$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','es', true,'UTF-8', array(0, 0, 0, 0) );
					$html2pdf->setDefaultFont('arialunicid0');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					//$html2pdf->pdf->SetProtection(array('print'), '1234'); // PROTEGIDO POR CONTRASEÑA
					foreach ($equipo as $key => $value) {
						if ($incre == $registros) {
							$html2pdf->WriteHTML($this->renderPartial('_reportesFallas',array(
								'equipo'=>$eq,
								'falla'=>$falla
							),true)); //hacemos un render partial a una vista preparada, en este caso es la vista ReportesPDF
							//$html2pdf->pdf->AddPage('NEXT-EVEN');// CREA PAGINA EN BLANCO
							unset($eq); // VACIA $eq PARA VOLVER A INICIALIZARLA
							$incre = 0; // SE INICIALIZA A SU VALOR POR DEFECTO PARA LUEGO IMPRIMIR OTROS 6 REGISTROS EN EL PDF
						}
						$eq[$key] = $value;// ARREGLO AUXILIAR DEL OBJETO Equipo CON SU CLAVE => VALOR
						$incre++;
						$control++; // INCREMENTA HASTA QUE SEA IGUAL AL NUMERO DE REGISTROS EN LA BASE DE DATOS
						// IMPRIME EL RESTO DE LOS REGISTROS
						if ($control == $contador) {
							$html2pdf->WriteHTML($this->renderPartial('_reportesFallas',array(
								'equipo'=>$eq,
								'falla'=>$falla
							),true));
							unset($eq);
						}
					}
					$pdfFilename = 'Reporte_falla_de_'.$falla.'.pdf';
					$html2pdf->Output( $pdfFilename, EYiiPdf::OUTPUT_TO_BROWSER );
					Yii::app()->user->setFlash('reporteC','El reporte ha sido Creado');
					$this->refresh();
					die;
			}else {
				Yii::app()->user->setFlash('error',"Disculpe no existe data con la Falla '$falla' ");
				$this->redirect($this->createUrl('site/notfound') );
			}
		}

		$this->render('reporte', array(
	        'equipo' =>	$equipo
	    ));
	}// END actionReporteFallas

	/**
	*	@method construirConsultar
	*	construye una consulta segun la falla que sea enviada por POST
	*/
	protected function construirConsultar($clase,$index,$falla){
		$modelo = $clase::model()->findAll( "$index = :f_$index", array(":f_$index" => $falla) );
		if ($modelo) {
			for ($i=0; $i < count($modelo); $i++) {
				$ideq[$i] = $modelo[$i]->ideq;
			}
			return Equipo::model()->findAllByPk($ideq);
		}else {
			return false;
		}
	}

}
