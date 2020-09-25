<?php
/* @var $this FormatoController */
/* @var $formato Formato */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Formato'=>array('index'),
	'Detalles del formato'
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Detalle del Formato #<?php echo $formato->nombf; ?></h4>

<div class="row">
	<div class="col s12">
		<table class="highlight" cellpadding="7">
    		<thead>
    			<tr>
    				<th>ID</th>
    				<th>Formato</th>
    				<th>Nomb. Formato</th>
    				<th>Tamaño</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td><?=$formato->idf;?></td>
    				<td><?=$formato->opcion;?></td>
    				<td><?=$formato->nombf;?></td>
    				<td><?=$formato->tamanio;?></td>
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
        echo CHtml::link( $image, array("/equipo/index") );
        ?>
    </div>
</div>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('formatoC')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('formatoC')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
