<?php
/* @var $this LibrosController */
/* @var $libros Libros */

$this->breadcrumbs=array(
	'Colección Bicentenaria'=>array('index'),
	'Actualizar',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu = array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu = array(
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center-align">Actualizar Libro "<?php echo $libros->nomblib; ?>"</h4>

<?php $this->renderPartial('_form', array(
	'libros'=>$libros,
	'img'=>$img
)); ?>
