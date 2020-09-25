<?php
/* @var $this FormatoController */
/* @var $formato Formato */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formato-form',
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
        "validateOnChange"=>true,
        //"validateOnType"=>true
    ),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php
	echo $form->errorSummary($formato);

	if ( Yii::app()->user->checkAccess('admin') && Yii::app()->user->checkAccess('administrador') ) {
		$elementos = array(
			'estadistica'	=>	'Estadistica',
			'planificacion'	=>	'Actividades Planificadas',
			'inventario'	=>	'Inventario Tecnologico',
			'acta'			=>	'Acta'
		);
	}else if ( Yii::app()->user->checkAccess('tutor') ){
		$elementos = array(
			'estadistica'	=>	'Estadistica',
			'planificacion'	=>	'Actividades Planificadas',
			'inventario'	=>	'Inventario Tecnologico',
		);
	}

	$fecha = date( "Y-m-d",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA
	echo $form->hiddenField($formato,'create_at',array('value' => $fecha));
	?>

	<div class="row" id="selectlist">
		<div class="col s12">
			<?php echo $form->labelEx($formato,'opcion',array('class'=>'black-text')); ?>
			<?php echo $form->dropDownList(
				$formato,'opcion',
				$elementos,
				array(
					'prompt'=>'Seleccione Formato',
					'options' => array('Seleccione'=>array('selected'=>true)),
					'class'=>'browser-default'
				)
			); ?>
			<?php echo $form->error($formato,'opcion'); ?>
		</div>
	</div>

	<?php if (Yii::app()->user->checkAccess('admin')) {?>
		<div class="row">
			<div class="col s12">
				<?php echo $form->labelEx($formato,'update_at',array('class'=>'black-text')); ?>
				<div class="switch">
					<label>
						No
						<?php echo $form->checkBox($formato,'update_at'); ?>
						<span class="lever"></span>
						Si
					</label>
				</div>
				<?php echo $form->error($formato,'update_at',array('class'=>'red-text darken-3')); ?>
			</div>
		</div>
	<?php } ?>

	<?php /*if (!$formato->isNewRecord) { ?>
	<div class="row">
		<div class="col s12">
			<?php echo "Archivo a cambiar: ".$formato->nombf; ?>
		</div>
	</div>
	<?php }*/ ?>

	<!-- FORMATO -->
	<div class="row">
		<div class="col s12">
			<?php echo $form->labelEx($formato,'ftutor',array('class'=>'black-text')); ?>
			<div class="file-field input-field">
				<div class="btn">
					<span>Formato</span>
					<i class="material-icons right">file_upload</i>
					<?php echo $form->FileField($formato,'ftutor'); ?>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Nombre del Formato">
				</div>
				<?php echo $form->error($formato,'ftutor'); ?>
			</div>
		</div>
	</div>

	<div class="row center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::submitButton($formato->isNewRecord ? 'Subir formato' : 'Actualizar'); ?>
				<i class="material-icons right">send</i>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
