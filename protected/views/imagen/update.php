<?php
/* @var $this ImagenController */
/* @var $imagen Imagen */

$this->breadcrumbs=array(
	'Proyectos Digitales'=>array('/multimedia/index'),
	'Carousel'=>array('index'),
	'Actualizar imagen',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>insert_photo</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
		array('label'=>"<i class='small material-icons'>photo_library</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Actualizar Imagen #<?php echo $imag->idimag; ?></h4>

<?php $this->renderPartial('_form', array('imag'=>$imag)); ?>
