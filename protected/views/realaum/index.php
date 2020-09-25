<?php
/* @var $this RealaumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Realidad Aumentada',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
		array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green'))
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
    );
}
?>

<div class="row">
	<h4 class="center">Proyectos de Realidad Aumentada</h4>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
</div>
