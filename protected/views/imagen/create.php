<?php
/* @var $this ImagenController */
/* @var $model Imagen */

$this->breadcrumbs=array(
	'Proyectos Digitales'=>array('/multimedia/index'),
	'Carousel'=>array('index'),
	'Subir Imagen',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>photo_library</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Subir Imagen del carousel</h4>

<?php $this->renderPartial('_form', array('imag'=>$imag)); ?>
