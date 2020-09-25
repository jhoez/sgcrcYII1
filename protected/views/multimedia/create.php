<?php
/* @var $this MultimediaController */
/* @var $model Multimedia */

$this->breadcrumbs=array(
	'Proyecto digital'=>array('index'),
	'Crear proyecto',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Crear Proyecto Digital</h4>

<?php $this->renderPartial('_form', array(
	'proyecto'=>$proyecto,
	'multimedia' => $multimedia
)); ?>
