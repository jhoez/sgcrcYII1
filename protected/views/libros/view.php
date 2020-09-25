<?php
/* @var $this LibrosController */
/* @var $libros Libros */

$this->breadcrumbs=array(
	'Colección Bicentenaria'=>array('index'),
	'Detalle del Libro',
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



<h4 class="center-align">Detalle del Libro "<?php echo $libros->nomblib; ?>"</h4>

<div class="valign-wrapper row">
	<div class="col s12 pull-l4 l4">

		<div class="col">
			<div class="card">
				<div class="card-image">
					<?php echo CHtml::image(Yii::app()->baseUrl.$libros->libimg->ruta.$libros->libimg->nombimg, 'imagen'/*, array('style' => 'width:130px; height:130px;')*/); ?>
				</div>
				<div class="card-content">
					<p class="center-left" style="overflow:hidden;">
						<?php echo "<a class='blue-text'>Libro: </a>". CHtml::encode($libros->nomblib);?>
					</p>
					<p class="center-left" style="overflow:hidden;">
						<?php echo "<a class='blue-text'>Coleccion: </a>". CHtml::encode($libros->coleccion);?>
					</p>
					<p class="center-left" style="overflow:hidden;">
						<?php echo "<a class='blue-text'>Nivel: </a>". CHtml::encode($libros->nivel);?>
					</p>
				</div>
				<div class="card-action">
					<?php echo CHtml::link(
						"ver Libro",
						array("/libros/viewpdf"),
						array(
							'submit'=>array("/libros/viewpdf"),
							'params'=>array('p'=>"$libros->idlib"),//no es necesario
							'target'=>'_blank',
							//'id'=>'btnpdfs',
							'class'=>'green-text'
						)
					);?>
				</div>
			</div>
		</div>

</div>
</div>


<div class="row">
    <div class="center-align">
        <?php
        $libros = CHtml::image(
            Yii::app()->request->baseUrl.'/fonts/left2.svg',
            'left',
            array('id'=>'regresar','width'=>'35px','title'=>'regresar','class'=>'arrow-left')
        );
        echo CHtml::link( $libros, array("/libros/index") );
        ?>
    </div>
</div>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('libroC')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('libroC')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
