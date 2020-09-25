<?php
/* @var $this EquipoController */
/* @var $data Equipo */

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipo-grid',
	'dataProvider'=>$equipo->search(),
	'filter'=>$equipo,
	'itemsCssClass'=>'highlight',
	'afterAjaxUpdate' => 'reinstallDatePicker', //call function to reinstall date picker after filter result
	'columns'=>array(
		array(
			'header' => 'Cedula',
			'name' => 'cedula',
			'value' => '$data->eqrep->cedula',
			'type' => 'text',
			'htmlOptions' => array('style'=>'text-align:center')
		),
		array(
			'header' => 'Serial',
            'name' => 'eqserial',
            'value' => '$data->eqserial',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'F recibido',
            'name' => 'frecepcion',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
						array(
							//'name'=>'frecepcion',
							'model'=>$equipo,
							'attribute'=>'frecepcion',
							'value' => $equipo->frecepcion,
							//'language' => Yii::app()->language,//'es'
							'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
							'htmlOptions' => array(
								'id' => 'datepicker_for_frecepcion',
								'size' => '10',
							),
							'options' => array(
								'showOn'				=> 'focus',// 'focus', 'button', 'both'
								//'buttonImage'			=> Yii::app()->request->baseUrl.'/fonts/calendar.svg',
								//'buttonImageOnly'		=> true,
								'dateFormat'			=> 'yy-mm-dd',//Date format 'mm/dd/yy', 'yy-mm-dd', 'd M, y', 'd MM, y', 'DD, d MM, yy'
								'monthNames'			=> array('Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre'),
								'monthNamesShort'		=> array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
								'dayNames'				=> array('Domingo,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado'),
								'dayNamesMin'			=> array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
								//'showOtherMonths'		=> true,
								//'selectOtherMonths'		=> true,
								'changeMonth'			=> true,
								'changeYear'			=> true,
								'yearRange'				=> '2000:2099',
								//'minDate'				=> '2000-01-01',
								//'maxDate'				=> '2099-12-31',
								//'showButtonPanel'		=> true,
								'showAnim'				=> 'drop',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
							)
						),true),
            //'value' => '$data->frecepcion',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'F entrega',
            'name' => 'fentrega',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				//'name'=>'frecepcion',
				'model'=>$equipo,
				'attribute'=>'fentrega',
				'value' => $equipo->fentrega,
				//'language' => Yii::app()->language,//'es'
				'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
				'htmlOptions' => array(
					'id' => 'datepicker_for_fentrega',
					'size' => '10',
				),
				'options' => array(
					'showOn'				=> 'focus',// 'focus', 'button', 'both'
					//'buttonImage'			=> Yii::app()->request->baseUrl.'/fonts/calendar.svg',
					//'buttonImageOnly'		=> true,
					'dateFormat'			=> 'yy-mm-dd',//Date format 'mm/dd/yy', 'yy-mm-dd', 'd M, y', 'd MM, y', 'DD, d MM, yy'
					'monthNames'			=> array('Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre'),
					'monthNamesShort'		=> array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
					'dayNames'				=> array('Domingo,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado'),
					'dayNamesMin'			=> array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
					//'showOtherMonths'		=> true,
					//'selectOtherMonths'		=> true,
					'changeMonth'			=> true,
					'changeYear'			=> true,
					'yearRange'				=> '2000:2099',
					//'minDate'				=> '2000-01-01',
					//'maxDate'				=> '2099-12-31',
					//'showButtonPanel'		=> true,
					'showAnim'				=> 'drop',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				)
			),true),
            //'value' => '$data->fentrega',//"strftime('%Y-%m-%d %I:%M:%S')",
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Version',
            'name' => 'eqversion',
            'value' => '$data->eqversion',
			'filter' =>	array(
				'V1'	=> 'V1',
				'V2'	=> 'V2',
				'V3'	=> 'V3',
				'V4'	=> 'V4',
				'V5'	=> 'V5',
				'V6'	=> 'V6',
				'tablet'	=> 'Tablet',
			),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Status',
            'name' => 'eqstatus',
            'value' => '$data->eqstatus',
			'visible'=>(
				!Yii::app()->user->checkAccess('tutor') &&
				!Yii::app()->user->checkAccess('administrador') &&
				!Yii::app()->user->checkAccess('admin')
			) ? false : true,
			'filter' =>	array('operativo'=>'Operativo','inoperativo'=>'Inoperativo'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Representante',
            'name' => 'eqrep',
            'value' => '$data->eqrep->nombre',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Status entrega',
            'name' => 'status',
            'value' => '$data->status == true ? "entregado" : "almacenado" ',
			'filter' =>	array('0'=>'almacenado','1'=>'entregado'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','Esta seguro de elimiar el Registro...'),
			'header'=>Yii::t('app','Acción'),
			//'afterDelete'=>'$.fn.yiiGridView.update("equipo-grid");',
			'template'=>'{view}{marcar}',
			//'template'=>'{view}{update}{delete}{marcar}{pdf}',
			'buttons'=>array(
				'view'=>array(
					//'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->ideq))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				/*'update'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->ideq))',
					//'click'=>"function(){//obtener valor del campo entregado para evitar que marque otra vez}",
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'delete'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->ideq))',
					'visible' => "Yii::app()->user->checkAccess('admin')"
				),*/
				'marcar'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/checked.svg",
					'url'=>'Yii::app()->controller->createUrl("updatedate", array("id"=>$data->ideq))',
					'visible'=>"Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				/*'pdf'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pdf_file.svg",
					'url'=>'Yii::app()->controller->createUrl( "generarpdf", array("id" => $data->ideq) )',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')",
					'options'=>array('target'=>'_blank'),
					//'url'=>"CHtml::normalizeUrl(array('generarpdf', 'id'=>\$data->ideq))",
				),*/
			),
		),// FIN ACCIONES
	),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
	function reinstallDatePicker(id, data) {
	        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
			$('#datepicker_for_frecepcion').datepicker(
				jQuery.extend({
					showMonthAfterYear:false
				},
				jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
			));
			$('#datepicker_for_fentrega').datepicker(
				jQuery.extend({
					showMonthAfterYear:false
				},
				jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
			));
	}
");
?>
