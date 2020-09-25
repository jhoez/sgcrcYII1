<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
    'Equipos'=>array('index'),
    $equipo->ideq=>array('view','id'=>$equipo->ideq),
    'Update',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons right'>insert_drive_file</i>", 'url'=>array('/formato/create'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons right'>assignment</i>", 'url'=>array('reportespdf'),'linkOptions'=>array('class'=>'btn-floating cyan darken-4')),
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center-align">Actualizar Registro del Equipo "Serial( <?php echo $equipo->eqserial;?> )"</h4>

<?php $this->renderPartial('_form', array(
	'estado'		=>	$estado,
	'municipio'    	=>	$municipio,
	'parroquia'    	=>	$parroquia,
	'sedeciat'      =>	$sedeciat,
	'insteduc'	    =>	$insteduc,
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
