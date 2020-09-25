<?php
/* @var $this EquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Equipo'=>array('/equipo/index'),
	'Asistencia'=>array('index'),
    'Reporte asistencia',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>add_circle_outline</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('reporteC')){?>
        window.addEventListener('load', function(){
            Swal.fire({
    			icon: 'success',
    			title: "<?php echo Yii::app()->user->getFlash('reporteC')?>",
    			showConfirmButton: false,
    			timer: 3000 // es ms (mili-segundos)
    		});
        });
	<?php }else if(Yii::app()->user->hasFlash('reporteE')){ ?>
        window.addEventListener('load', function(){
            Swal.fire({
                icon: 'error',
                title: "<?php echo Yii::app()->user->getFlash('reporteE'); ?>",
                showConfirmButton: false,
                timer: 3000 // es ms (mili-segundos)
            });
        });
	<?php } ?>
</script>


<h4 class="center-align">Reporte de Asistencia por Mes</h4>
<div class="valign-wrapper row">
    <div class="col s12 pull-l3 l6">
        <!--<fieldset class="z-depth-2">
            <legend class="">Seleccione la fecha de inicio y fin del Reporte</legend>
        -->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'asistencia-form',
                //'action'=>Yii::app()->createUrl("equipo/reportespdf"),
                //'method'=>'get',
                "enableClientValidation"=>true,
                "clientOptions"=>array(
                    "validateOnSubmit"=>true,
                ),
                'enableAjaxValidation'=>false,
            ));?>
            <?php echo $form->errorSummary($asistencia); ?>

            <div class="row">
                <div class="col s12">
                    <?php echo $form->labelEx($asistencia,'mes',array('class'=>'black-text')); ?>
                    <?php echo $form->dropDownList(
                        $asistencia,'mes',
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
                            'options' => array('Seleccione'=>array('selected'=>true)),
                            'class'=>'browser-default'
                        )
                    ); ?>
                    <?php echo $form->error($asistencia,'mes',array('class'=>'red-text darken-3')); ?>
                </div>
            </div>

            <div class="row center-align">
                <div class="col s12">
                    <div class="btn waves-effect waves-ligh">
                        <?php echo CHtml::link(
                            "Crear reporte mes<i class='small material-icons right'>assignment</i>",
                            array("/asistencia/reporteAsistencia"),
                            array(
                                'submit'=>array("/asistencia/reporteAsistencia"),
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

<h4 class="center-align">Reporte de Asistencia</h4>
<div class="valign-wrapper row">
    <div class="col s10 pull-l3 l6">
        <!--<fieldset class="z-depth-2">
            <legend class="">Seleccione la fecha de inicio y fin del Reporte</legend>
        -->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'equipo-form',
                //'action'=>Yii::app()->createUrl("equipo/reportespdf"),
                //'method'=>'get',
                "enableClientValidation"=>true,
                "clientOptions"=>array(
                    "validateOnSubmit"=>true,
                ),
                'enableAjaxValidation'=>false,
            ));?>
            <?php echo $form->errorSummary($asistencia); ?>

            <div class="row">
                <label id="labelsel" for="Asistencia_fechain"><i class='small material-icons left'>event</i></label>
                <?php echo $form->labelEx($asistencia,'fechain',array('class'=>'black-text')); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$asistencia,
                        'attribute'=>'fechain',
                        'value' => $asistencia->fechain,
                        //'language' => Yii::app()->language,//'es'
                        'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
                        'htmlOptions' => array(
                            'id' => 'fentrada',
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
                <?php echo $form->error($asistencia,'fechain'); ?>
            </div>

            <div class="row">
                <label id="labelsel" for="Asistencia_fechaout"><i class='small material-icons left'>event</i></label>
                <?php echo $form->labelEx($asistencia,'fechaout',array('class'=>'black-text')); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$asistencia,
                        'attribute'=>'fechaout',
                        'value' => $asistencia->fechaout,
                        //'language' => Yii::app()->language,//'es'
                        'i18nScriptFile' => 'jquery.ui.datepicker-es.js',//acomoda a mi manera dateFormat
                        'htmlOptions' => array(
                            'id' => 'fsalida',
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
                <?php echo $form->error($asistencia,'fechaout'); ?>
            </div>

            <div class="row center-align">
                <div class="col s12">
                    <div class="btn waves-effect waves-ligh">
                        <?php echo CHtml::link(
                            "Crear reporte <i class='small material-icons right'>assignment</i>",
                            array("/asistencia/reporteAsistencia"),
                            array(
                                'submit'=>array("/asistencia/reporteAsistencia"),
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
<?php

Yii::app()->clientScript->registerScript('re-install-date-picker', "
	function reinstallDatePicker(id, data) {
	        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
	        $('#fentrada').datepicker(
	            jQuery.extend({
	                showMonthAfterYear:false
	            },
	            jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
	        ));

			$('#fsalida').datepicker(
	            jQuery.extend({
	                showMonthAfterYear:false
	            },
	            jQuery.datepicker.regional['es'],{'dateFormat':'yy-mm-dd'}
	        ));
	}
");

?>
