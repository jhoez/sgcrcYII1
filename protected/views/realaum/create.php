<?php
/* @var $this RealaumController */
/* @var $model Realaum */

$this->breadcrumbs=array(
	'Realidad Aumentada'=>array('index'),
	'Crear RA',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue'))
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>


<h4 class="center">Crear proyecto de Realidad Aumentada</h4>

<?php $this->renderPartial('_form', array(
	'realidadaumentada'=>$realidadaumentada,
	'proyecto'=>$proyecto,
	'imag'=>$imag
)); ?>
