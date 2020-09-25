<?php
/* @var $this ImagenController */
/* @var $imag Imagen */

$this->breadcrumbs=array(
	'Proyectos Digitales'=>array('/multimedia/index'),
	'Carousel'=>array('index'),
	'Imagen subida',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>insert_photo</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating green')),
	);
}
?>

<h4 class="center-align">Detalles de la Imagen "<?php echo $imag->nombimg; ?>"</h4>

<div class="valign-wrapper row">
	<div class="col s12 pull-l4 l4">
		<div class="card">
			<div class="card-image">
				<?php echo CHtml::image(Yii::app()->baseUrl.$imag->ruta.$imag->nombimg, 'banner'/*, array('style' => 'width:130px; height:130px;')*/); ?>
			</div>
			<div class="card-content">
				<p class="center-left" style="overflow:hidden;">
					<?php echo "<a class='blue-text'>Imagen: </a>". CHtml::encode($imag->nombimg);?>
				</p>
			</div>
		</div>

		<div class="center-align">
	        <?php
	        $image = CHtml::image(
	            Yii::app()->request->baseUrl.'/fonts/left2.svg',
	            'regresar',
	            array('id'=>'regresar','width'=>'35px','title'=>'regresar','class'=>'')
	        );
	        echo CHtml::link( $image, array("/imagen/index") );
	        ?>
	    </div>
	</div>
</div>
