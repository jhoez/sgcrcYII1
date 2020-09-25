<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));

echo $this->route;
?>

	<div class="row">
		<?php echo $form->label($equipo,'ideq'); ?>
		<?php echo $form->textField($equipo,'ideq'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
