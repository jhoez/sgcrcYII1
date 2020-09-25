<?php
/* @var $this ImagenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Proyectos Digitales'=>array('/multimedia/index'),
	'Carousel',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
		array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('/multimedia/index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Imagenes del carousel</h4>
<div class="row">
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
</div>
