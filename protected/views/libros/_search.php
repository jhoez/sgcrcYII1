<?php
/* @var $this LibrosController */
/* @var $model Libros */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idlib'); ?>
		<?php echo $form->textField($model,'idlib'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nomblib'); ?>
		<?php echo $form->textField($model,'nomblib',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extension'); ?>
		<?php echo $form->textField($model,'extension',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ruta'); ?>
		<?php echo $form->textField($model,'ruta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'coleccion'); ?>
		<?php echo $form->textField($model,'coleccion',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->