<?php
/* @var $this FormatoController */
/* @var $model Formato */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Formato'=>array('index'),
	'Subir formato'
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
    	array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Subir Formatos</h4>

<?php $this->renderPartial('_form', array('formato'=>$formato)); ?>
