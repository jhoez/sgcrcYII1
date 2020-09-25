<?php
/* @var $this RealaumController */
/* @var $realidadaumentada Realaum */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'realaum-form',
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
        //"validateOnChange"=>true,
        //"validateOnType"=>true
    ),
	'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

	<?php
	echo $form->errorSummary(array($proyecto,$realidadaumentada),null,null,array('class'=>'red-text darken-3'));
	//$fecha = date( "Y-m-d h:i:s",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA
	$fecha = date( "Y-m-d",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA

	if (!$realidadaumentada->isNewRecord) {
		echo $form->hiddenField($proyecto,'update_at',array('value' => $fecha));
	}else {
		echo $form->hiddenField($proyecto,'create_at',array('value' => $fecha));
	}
	?>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($proyecto,'nombpro',array('class'=>'validate','size'=>60,'maxlength'=>255)); ?>
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

	<!-- IMAGEN ASOCIADA EL PATRON -->
	<div class="row">
		<?php echo $form->labelEx($imag,'imagen',array('class'=>'black-text')); ?>
		<?php if (!$imag->isNewRecord) {?>
			<div class="row">
					<?php echo "Imagen a cambiar: " . $imag->nombimg;?>
			</div>
		<?php } ?>
		<div class="file-field input-field">
			<div class="btn">
				<span>Imagen png</span>
				<?php echo $form->FileField($imag,'imagen'); ?>
				<i class="material-icons right">file_upload</i>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Nombre de imagen">
			</div>
			<?php echo $form->error($imag,'imagen',array('class'=>'red-text darken-3')); ?>
		</div>
	</div>

	<!-- glb -->
	<div class="row">
		<?php echo $form->labelEx($realidadaumentada,'fileglb',array('class'=>'black-text')); ?>
		<?php	if (!$realidadaumentada->isNewRecord) {?>
			<div class="row">
					<?php	echo "Patron de Realidad Aumentada a ser reemplazado: " . $realidadaumentada->nra;?>
			</div>
		<?php } ?>
		<div class="file-field input-field">
			<div class="btn">
				<span>Cargar file GLB</span>
				<?php echo $form->FileField($realidadaumentada,'fileglb'); ?>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Nombre del archivo">
			</div>
			<?php echo $form->error($realidadaumentada,'fileglb',array('class'=>'red-text darken-3')); ?>
		</div>
	</div>

	<div class="row center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::submitButton($realidadaumentada->isNewRecord ? 'Subir Archivo' : 'Actualizar',array('class'=>'white-text')); ?>
				<i class="material-icons right">send</i>
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
