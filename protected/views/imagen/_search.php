<?php
/* @var $this ImagenController */
/* @var $imagen Imagen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($imagen,'idimag'); ?>
		<?php echo $form->textField($imagen,'idimag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($imagen,'nombimg'); ?>
		<?php echo $form->textField($imagen,'nombimg',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($imagen,'extension'); ?>
		<?php echo $form->textField($imagen,'extension',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($imagen,'ruta'); ?>
		<?php echo $form->textField($imagen,'ruta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($imagen,'tamanio'); ?>
		<?php echo $form->textField($imagen,'tamanio',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
