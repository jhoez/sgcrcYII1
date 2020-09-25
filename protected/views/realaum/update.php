<?php
/* @var $this RealaumController */
/* @var $model Realaum */

$this->breadcrumbs=array(
	'Realidad Aumentada'=>array('index'),
	$realidadaumentada->idra=>array('view','id'=>$realidadaumentada->idra),
	'Actualizar',
);

if (Yii::app()->user->checkAccess('tutor')) {
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

<h4 class="center-align">Actualizar Realidad Aumentada "<?php echo $realidadaumentada->rapro->nombpro; ?>"</h4>

<?php $this->renderPartial('_form', array(
	'realidadaumentada'=>$realidadaumentada,
	'proyecto'=>$proyecto,
	'imag'=>$imag
)); ?>
