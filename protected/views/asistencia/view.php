<?php
/* @var $this AsistenciaController */
/* @var $asistencia Asistencia */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Asistencia'=>array('index'),
	'Asistencia creada'
);

if (Yii::app()->user->checkAccess('tutor')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('/equipo/index'),'linkOptions'=>array('class'=>'btn-floating cyan darken-4')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"home", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating green')),
    );
}
?>

<h4 class="center-align">Detalle de Asistencia #<?php echo $asistencia->asisuser->username; ?></h4>

<div class="row">
	<div class="col s12">
		<table class="highlight" cellpadding="7">
    		<thead>
    			<tr>
    				<th>ID</th>
    				<th>Cedula</th>
    				<th>Fecha</th>
    				<th>Hora Entrada</th>
					<th>Hora Salida</th>
					<th>Observación</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td><?=$asistencia->idasis;?></td>
    				<td><?=$asistencia->asisuser->username;?></td>
    				<td><?=$asistencia->fecha;?></td>
    				<td><?=$asistencia->horain;?></td>
    				<td><?=$asistencia->horaout;?></td>
					<td><?=$asistencia->observacion;?></td>
    			</tr>
    		</tbody>
    	</table>
	</div>
</div>

<div class="row">
    <div class="center-align">
        <?php

        $image = CHtml::image(
            Yii::app()->request->baseUrl.'/fonts/left2.svg',
            'left',
            array('id'=>'regresar','width'=>'35px','title'=>'regresar','class'=>'arrow-left')
        );
        echo CHtml::link( $image, array("/asistencia/create") );
        ?>
    </div>
</div>


<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('asistenciaES')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('asistenciaES')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
