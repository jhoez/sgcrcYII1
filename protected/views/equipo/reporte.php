<?php
/* @var $this EquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Equipos'=>array('index'),
    'Reporte PDF',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons right'>insert_drive_file</i>", 'url'=>array('/formato/create'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons right'>add_to_queue</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center-align">Reporte por Mes</h4>
<div class="valign-wrapper row">
    <div class="col s12 pull-l3 l6">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'equipomes-form',
            //'action'=>Yii::app()->createUrl("/equipo/reportespdf"),
            //'method'=>'get',
            "enableClientValidation"=>true,
            "clientOptions"=>array(
                "validateOnSubmit"=>true,
                "validateOnChange"=>true,
                "validateOnType"=>true
            ),
            'enableAjaxValidation'=>false,
        ));?>
        <?php echo $form->errorSummary($equipo); ?>

        <div class="row">
            <?php echo $form->labelEx($equipo,'mes',array('class'=>'black-text')); ?>
            <?php echo $form->dropDownList(
                $equipo,'mes',
                array(
                    '01'    =>	'Enero',
                    '02'    =>	'Febrero',
                    '03'    =>	'Marzo',
                    '04'    =>	'Abril',
                    '05'    =>	'Mayo',
                    '06'    =>	'Junio',
                    '07'    =>	'Julio',
                    '08'    =>	'Agosto',
                    '09'    =>	'Septiembre',
                    '10'	=>	'Octubre',
                    '11'	=>	'Noviembre',
                    '12'	=>	'Diciembre'
                ),
                array(
                    'prompt'=> 'Seleccione el mes',
                    //'disabled'=>false, // cambiar a true para desactivar
                    'options' => array('Seleccione'=>array('selected'=>true)),
                    'class'=>'browser-default'
                )
            ); ?>
            <?php echo $form->error($equipo,'mes',array('class'=>'red-text darken-3')); ?>
        </div>

        <div class="row center-align">
            <div class="col s12">
                <div class="btn waves-effect waves-ligh">
                    <?php echo CHtml::link(
                        "Crear reporte<i class='small material-icons right'>assignment</i>",
                        array("/equipo/reportespdf"),
                        array(
                            'submit'=>array("/equipo/reportespdf"),
                            //'params'=>array('frecepcion'=>'$equipo->frecepcion','fentrega'=>'$asistencia->fentrega'),//no es necesario
                            'target'=>'_blank',
                            //'id'=>'btnpdfs',
                            'class'=>'white-text'
                        )
                    );?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<h4 class="center-align">Reporte de Equipo por Fallas</h4>
<div class="valign-wrapper row">
    <div class="col s12 pull-l3 l6">
        <!--<fieldset class="z-depth-2">
            <legend class="">Seleccione la fecha de inicio y fin del Reporte</legend>
        -->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'equipofallas-form',
                "enableClientValidation"=>true,
                "clientOptions"=>array(
                    "validateOnSubmit"=>true,
                    "validateOnChange"=>true,
                    "validateOnType"=>true
                ),
                'enableAjaxValidation'=>false,
            ));?>
            <?php echo $form->errorSummary($equipo); ?>

            <div class="row">
        		<?php echo $form->labelEx($fsoftware,'fsoft',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$fsoftware,'fsoft',
        			array(
        				'Actualizacion'		=> 'Actualizacion',
        				'Posee windows'		=> 'Posee windows',
        				'No carga el S.O'	=> 'No carga el S.O',
        				'Revisar disco'		=> 'Revisar disco',
        				'Grub rescue'		=> 'Grub rescue',
        			),
        			array('prompt'=>'Seleccione Falla de software','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		); ?>
        		<?php echo $form->error($fsoftware,'fsoft',array('class'=>'red-text darken-3')); ?>
        	</div>
        	<!-- FALLA DE PANTALLA -->
        	<div class="row">
        		<?php echo $form->labelEx($fpantalla,'fpant',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$fpantalla,'fpant',
        			array(
        				'Pantalla partida'						=> 'Pantalla partida',
        				'Pixelada'								=> 'Pixelada',
        				'Pantalla despegada'					=> 'Pantalla despegada',
        				'Pantalla de cristal líquido dañada'	=> 'Pantalla de cristal líquido dañada',
        				'Flex dañado'							=> 'Flex dañado'
        			),
        			array('prompt'=>'Seleccione Falla de pantalla','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		);?>
        		<?php echo $form->error($fpantalla,'fpant',array('class'=>'red-text darken-3')); ?>
        	</div>
        	<!-- FALLA DE TARJETAMADRE -->
        	<div class="row">
        		<?php echo $form->labelEx($ftarjetamadre,'ftarj',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$ftarjetamadre,'ftarj',
        			array(
        				'Procesador dañado'			=> 'Procesador dañado',
        				'Tarj de video dañada'		=> 'Tarj de video dañada',
        				'Tarj de red dañada'		=> 'Tarj de red dañada',
        				'Tarj de sonido dañada'		=> 'Tarj de sonido dañada',
        				'Pila de bios'				=> 'Pila de bios',
        				'Configuracion del bios'	=> 'Configuracion del bios',
        				'Bios bloqueada'			=> 'Bios bloqueada',
        				'Corto circuito'			=> 'Corto circuito',
        				'Procesador dañado'			=> 'Procesador dañado'
        			),
        			array('prompt'=>'Seleccione Falla de tarjeta madre','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		);?>
        		<?php echo $form->error($ftarjetamadre,'ftarj',array('class'=>'red-text darken-3')); ?>
        	</div>
        	<!-- FALLA DE TECLADO -->
        	<div class="row">
        		<?php echo $form->labelEx($fteclado,'ftec',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$fteclado,'ftec',
        			array(
        				'Teclado dañado'	=> 'Teclado dañado',
        				'Faltan teclas'		=> 'Faltan teclas',
        				'No marcan teclas'	=> 'No marcan teclas'
        			),
        			array('prompt'=>'Seleccione Falla del teclado','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		);?>
        		<?php echo $form->error($fteclado,'ftec',array('class'=>'red-text darken-3')); ?>
        	</div>
        	<!-- FALLA DE CARGA -->
        	<div class="row">
        		<?php echo $form->labelEx($fcarga,'fcarg',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$fcarga,'fcarg',
        			array(
        				'Pin de carga'		=> 'Pin de carga',
        				'Bateria dañada'	=> 'Bateria dañada',
        				'Cargador dañado'	=> 'Cargador dañado'
        			),
        			array('prompt'=>'Seleccione Falla de carga','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		);?>
        		<?php echo $form->error($fcarga,'fcarg',array('class'=>'red-text darken-3')); ?>
        	</div>
        	<!-- FALLA GENERAL -->
        	<div class="row">
        		<?php echo $form->labelEx($fgeneral,'fgen',array('class'=>'black-text')); ?>
        		<?php echo $form->dropDownList(
        			$fgeneral,'fgen',
        			array(
        				'Mouse dañado'				=> 'Mouse dañado',
        				'Disco duro dañado'			=> 'Disco duro dañado',
        				'Momoria ram dañada'		=> 'Momoria ram dañada',
        				'Fan cooler dañado'			=> 'Fan cooler dañado',
        				'Boton encendido dañado'	=> 'Boton encendido dañado',
        				'Camara dañada'				=> 'Camara dañada',
        				'Equipo inoperativo'		=> 'Equipo inoperativo'
        			),
        			array('prompt'=>'Seleccione Falla general','options' => array('Seleccione'=>array('selected'=>true))),
        			array('class'=>'browser-default')
        		);?>
        		<?php echo $form->error($fgeneral,'fgen',array('class'=>'red-text darken-3')); ?>
        	</div>

            <div class="row center-align">
                <div class="col s12">
                    <div class="btn waves-effect waves-ligh">
                        <?php echo CHtml::link(
                            "Crear reporte<i class='small material-icons right'>assignment</i>",
                            array("/asistencia/reporteFallas"),
                            array(
                                'submit'=>array("/equipo/reporteFallas"),
                                //'params'=>array('frecepcion'=>'$asistencia->frecepcion','fentrega'=>'$asistencia->fentrega'),//no es necesario
                                'target'=>'_blank',
                                //'id'=>'btnpdfs',
                                'class'=>'white-text'
                            )
                        );?>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        <!--</fieldset>-->
    </div>
</div>

<h4 class="center-align">Reporte de Canaimita</h4>
<div class="valign-wrapper row">
    <div class="col s10 pull-l3 l6">

        <!--<fieldset class="z-depth-2">
            <legend class="">Seleccione la fecha de inicio y fin del Reporte</legend>
        -->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'equipoinout-form',
                //'action'=>Yii::app()->createUrl("equipo/reportespdf"),
                //'method'=>'get',
                "enableClientValidation"=>true,
                "clientOptions"=>array(
                    "validateOnSubmit"=>true,
                    "validateOnChange"=>true,
                    "validateOnType"=>true
                ),
                'enableAjaxValidation'=>false,
            ));?>
            <?php echo $form->errorSummary($equipo); ?>
            <div class="row">
                <label id="labelsel" for="Equipo_frecepcion">Inicio reporte <i class='small material-icons left'>event</i></label>
                <?php //echo $form->labelEx($equipo,'frecepcion'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$equipo,
                        'attribute'=>'frecepcion',
                        'value' => $equipo->frecepcion,
                        //'language' => Yii::app()->language,//'es'
                        'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
                        'htmlOptions' => array(
                            'id' => 'Erecepcion',
                            //'class'=>'datepicker',
                            'placeholder' => '0000-00-00',
                            'size' => '10',
                        ),
                        'options' => array(
                            'showOn'        => 'focus',// 'focus', 'button', 'both'
                            'buttonImage'   => Yii::app()->baseUrl.'/fonts/calendar.svg',
                            'buttonImageOnly'		=> true,
                            'buttonText'            => 'fecha',
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
                    ),
                    true
                );?>
                <?php echo $form->error($equipo,'frecepcion'); ?>
            </div>

            <div class="row">
                <label id="labelsel" for="Equipo_fentrega">Fin reporte <i class='small material-icons left'>event</i></label>
                <?php //echo $form->labelEx($equipo,'fentrega',array('id'=>'labelsel')); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$equipo,
                        'attribute'=>'fentrega',
                        'value' => $equipo->fentrega,
                        //'language' => Yii::app()->language,//'es'
                        'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
                        'htmlOptions' => array(
                            'id' => 'Eentrega',
                            //'class'=>'datepicker',
                            'placeholder' => '0000-00-00',
                            'size' => '10',
                        ),
                        'options' => array(
                            'showOn'				=> 'focus',// 'focus', 'button', 'both'
                            'buttonImage'			=> Yii::app()->baseUrl.'/fonts/calendar.svg',
                            'buttonImageOnly'		=> true,
                            'buttonText'            => 'fecha',
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
                    ),
                    true
                );?>
                <?php echo $form->error($equipo,'fentrega'); ?>
            </div>

            <!--<div class="row center-align">
        		<div class="col s12">
        			<div class="btn waves-effect waves-ligh">
        				<?php //echo CHtml::submitButton($equipo->isNewRecord ? 'Crear Reporte' : 'Guardar'); ?>
        			</div>
        		</div>
        	</div>-->

            <div class="row center-align">
                <div class="col s12">
                    <div class="btn waves-effect waves-ligh">
                        <?php echo CHtml::link(
                            "Crear reporte <i class='small material-icons right'>assignment</i>",
                            array("equipo/reportespdf"),
                            array(
                                'submit'=>array("equipo/reportespdf"),
                                //'params'=>array('frecepcion'=>'$equipo->frecepcion','fentrega'=>'$equipo->fentrega'),//no es necesario
                                'target'=>'_blank',
                                //'id'=>'btnpdfs',
                                'class'=>'white-text'
                            )
                        );?>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        <!--</fieldset>-->

    </div>
</div>
<?php

Yii::app()->clientScript->registerScript('re-install-date-picker', "
	function reinstallDatePicker(id, data) {
	        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
	        $('#Erecepcion').datepicker(
	            jQuery.extend({
	                showMonthAfterYear:false
	            },
	            jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
	        ));

			$('#Eentrega').datepicker(
	            jQuery.extend({
	                showMonthAfterYear:false
	            },
	            jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
	        ));
	}
");

?>
