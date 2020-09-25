<?php
/* @var $this ImagenController */
/* @var $model Imagen */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imagen-form',
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
        "validateOnChange"=>true,
        //"validateOnType"=>true
    ),
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($imag); ?>

	<!-- IMAGEN -->
	<div class="row">
		<div class="col s12">
			<?php echo $form->labelEx($imag,'imagen',array('class'=>'black-text')); ?>
			<?php	if (!$imag->isNewRecord) {?>
				<div class="row">
						<?php echo "Imagen a ser reemplazada: " . $imag->nombimg;?>
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
				<?php echo $form->error($imag,'imagen'); ?>
			</div>
		</div>
	</div>

	<div class="center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::submitButton($imag->isNewRecord ? 'Subir imagen' : 'Actualizar'); ?>
				<i class="material-icons right">send</i>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
