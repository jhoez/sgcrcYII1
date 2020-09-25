<?php
/* @var $this FormatoController */
/* @var $model Formato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idf'); ?>
		<?php echo $form->textField($model,'idf'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'opcion'); ?>
		<?php echo $form->textField($model,'opcion',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombf'); ?>
		<?php echo $form->textField($model,'nombf',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extens'); ?>
		<?php echo $form->textField($model,'extens',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ruta'); ?>
		<?php echo $form->textField($model,'ruta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tamanio'); ?>
		<?php echo $form->textField($model,'tamanio',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fkuser'); ?>
		<?php echo $form->textField($model,'fkuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->