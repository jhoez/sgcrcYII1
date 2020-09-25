<?php
/* @var $this RealaumController */
/* @var $model Realaum */

$this->breadcrumbs=array(
	'Realaums'=>array('index'),
	$model->idra,
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue'))
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Detalle de Realidad Aumentada #<?php echo $model->idra; ?></h4>

<div class="valign-wrapper row">
	<div class="col s12 pull-l4 l4">
		<div class="col">
			<div class="card">
				<div class="card-image">
					<?php echo CHtml::image(Yii::app()->baseUrl.$model->raimag->ruta.$model->raimag->nombimg, 'banner'/*, array('style' => 'width:130px; height:130px;')*/); ?>
				</div>
				<div class="card-content">
					<p class="center-left" style="overflow:hidden;">
						<?php echo "<a class='blue-text'>Patron de RA: </a>". CHtml::encode($model->rapro->nombpro);?>
					</p>
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
        echo CHtml::link( $libros, array("/realaum/index") );
        ?>
    </div>
</div>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('raC')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('raC')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
