<?php
/* @var $this MultimediaController */
/* @var $model Multimedia */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s12 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'multimedia-form',
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
    ),
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

	<?php
	echo $form->errorSummary(array($proyecto,$multimedia));
	$fecha = date( "Y-m-d",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA

	if (!$multimedia->isNewRecord) {
		echo $form->hiddenField($proyecto,'update_at',array('value' => $fecha));
	}else {
		echo $form->hiddenField($proyecto,'create_at',array('value' => $fecha));
	}
	?>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($proyecto,'nombpro',array('class'=>'validate','size'=>60,'maxlength'=>255/*,'placeholder'=>'Nombre del proyecto'*/)); ?>
			<?php echo $form->labelEx($proyecto,'nombpro',array('class'=>'black-text')); ?>
		</div>
		<?php echo $form->error($proyecto,'nombpro',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($proyecto,'creador',array('class'=>'validate','size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->labelEx($proyecto,'creador',array('class'=>'black-text')); ?>
		</div>
		<?php echo $form->error($proyecto,'creador',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($proyecto,'colaboracion',array('class'=>'validate','size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->labelEx($proyecto,'colaboracion',array('class'=>'black-text')); ?>
		</div>
		<?php echo $form->error($proyecto,'colaboracion',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textArea($proyecto,'descripcion',array('class'=>'validate','maxlength'=>500,'class'=>'materialize-textarea')); ?>
			<?php echo $form->labelEx($proyecto,'descripcion',array('class'=>'black-text')); ?>
		</div>
		<?php echo $form->error($proyecto,'descripcion',array('class'=>'red-text darken-3')); ?>
	</div>

	<!-- video -->
	<div class="row">
		<?php echo $form->labelEx($multimedia,'mva',array('class'=>'black-text')); ?>
		<?php	if (!$multimedia->isNewRecord) {?>
			<div class="row">
					<?php	echo "$multimedia->tipomult a reemplazar: " . $multimedia->nombmult;?>
			</div>
		<?php } ?>
		<div class="file-field input-field">
			<div class="btn">
				<span>video o audio</span>
				<?php echo $form->FileField($multimedia,'mva'); ?>
				<i class="material-icons right">file_upload</i>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Nombre del multimedia">
			</div>
			<?php echo $form->error($multimedia,'mva',array('class'=>'red-text darken-3')); ?>
		</div>
	</div>

	<div class="row center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::submitButton($multimedia->isNewRecord ? 'Crear Proyecto' : 'Actualizar', array('class'=>'white-text') ); ?>
				<i class="material-icons right">save</i>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>

<?php if(Yii::app()->user->hasFlash('notfound')){ ?>
<script type="text/javascript">
	window.addEventListener('load', function(){
		Swal.fire({
			icon: 'error',
			title: "<?php echo Yii::app()->user->getFlash('notfound')?>",
			showConfirmButton: false,
			timer: 3000 // es ms (mili-segundos)
		});
	});
</script>
<?php } ?>
