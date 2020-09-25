<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Colección Bicentenaria'=>array('index'),
	'Subir libro',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>picture_as_pdf</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center">Subir Libro</h4>

<?php $this->renderPartial('_form', array('libros'=>$libros,'img'=>$img)); ?>
