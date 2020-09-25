<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
    'Equipos'=>array('index'),
    'Registrar Canaimita',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
    	array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons right'>assignment</i>", 'url'=>array('reportespdf'),'linkOptions'=>array('class'=>'btn-floating grey')),
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center-align">Registrar de las Canaimitas</h4>

<?php $this->renderPartial('_form', array(
	'estado'		=>	$estado,
	'municipio'		=>	$municipio,
	'parroquia'		=>	$parroquia,
	'sedeciat'      =>	$sedeciat,
	'insteduc'      =>	$insteduc,
	'representante'	=>	$representante,
	'estudiante'	=>	$estudiante,
	'niveleduc'		=>	$niveleduc,
	'equipo'		=>	$equipo,
	'fsoftware'		=>	$fsoftware,
	'fpantalla'		=>	$fpantalla,
	'ftarjetamadre'	=>	$ftarjetamadre,
	'fteclado'		=>	$fteclado,
	'fcarga'		=>	$fcarga,
	'fgeneral'		=>	$fgeneral,
)); ?>
