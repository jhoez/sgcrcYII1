<?php
/* @var $this AsistenciaController */
/* @var $model Asistencia */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Asistencia'=>array('index'),
	'Marcar asistencia',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
    	array('label'=>"<i class='small material-icons'>laptop</i>", 'url'=>array('/equipo/index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons right'>laptop</i>", 'url'=>array('/equipo/index'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons right'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

// hora de entrada y salida del personal
$hora	= date("h:i:s",time()); // OBTIENE HORA ACTUAL DE MI MAQUINA

if ( $hora >= $this->horaE && $hora <= $this->horaS ) {
	echo "<h4 class='center-align'>Registrar Entrada</h4>";
}elseif ( $hora >= $this->horaS ) {
	echo "<h4 class='center-align'>Registrar Salida</h4>";
}
?>

<div class='row'>
	<?php
	$this->renderPartial('_form', array(
		'asistencia'=>$asistencia
	));
	?>
</div>
