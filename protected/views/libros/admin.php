<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Colección Bicentenaria'=>array('index'),
	'Libros Almacenados',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center">Libros registrados</h4>

<div class="row">
	<div class="col s12">
		<ul class="tabs cyan">
			<li class="tab col s3"><a aria-controls="inicial" class="active white-text" href="#inicial">Inicial</a></li>
			<li class="tab col s2"><a aria-controls="primaria" class="white-text" href="#primaria">Primaria</a></li>
			<li class="tab col s2"><a aria-controls="media" class="white-text" href="#media">Media</a></li>
			<li class="tab col s2"><a aria-controls="maestro" class="white-text" href="#maestro">Maestro</a></li>
			<li class="tab col s3"><a aria-controls="lectura" class="white-text" href="#lectura">Lectura</a></li>
		</ul>
	</div>
	<div id="inicial" class="col s12">
		<?php
		$libros->dbCriteria->condition="nivel='inicial'";
		$this->renderPartial("_ipm",array("libros"=>$libros,'idGrid'=>'grid-inicial','tab'=>1));
		?>
	</div>
	<div id="primaria" class="col s12">
		<?php
		$libros->dbCriteria->condition="nivel='primaria'";
		$this->renderPartial("_ipm",array("libros"=>$libros,'idGrid'=>'grid-primaria','tab'=>2));
		?>
	</div>
	<div id="media" class="col s12">
		<?php
		$libros->dbCriteria->condition="nivel='media'";
		$this->renderPartial("_ipm",array("libros"=>$libros,'idGrid'=>'grid-media','tab'=>3));
		?>
	</div>
	<div id="maestro" class="col s12">
		<?php
		$libros->dbCriteria->condition="coleccion='coleccionMaestros'";
		$this->renderPartial("_ipm",array("libros"=>$libros,'idGrid'=>'grid-maestro','tab'=>4));
		?>
	</div>
	<div id="lectura" class="col s12">
		<?php
		$libros->dbCriteria->condition="coleccion='lectura'";
		$this->renderPartial("_ipm",array("libros"=>$libros,'idGrid'=>'grid-lectura','tab'=>5));
		?>
	</div>
</div>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('libroD')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('libroD')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
