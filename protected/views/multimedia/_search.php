<?php
/* @var $this MultimediaController */
/* @var $multimedia Multimedia */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($multimedia,'idmult'); ?>
		<?php echo $form->textField($multimedia,'idmult'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'nombmult'); ?>
		<?php echo $form->textField($multimedia,'nombmult',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'extension'); ?>
		<?php echo $form->textField($multimedia,'extension',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'tipomult'); ?>
		<?php echo $form->textField($multimedia,'tipomult',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'tamanio'); ?>
		<?php echo $form->textField($multimedia,'tamanio',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'ruta'); ?>
		<?php echo $form->textField($multimedia,'ruta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($multimedia,'fkidpro'); ?>
		<?php echo $form->textField($multimedia,'fkidpro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
