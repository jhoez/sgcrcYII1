<?php
/* @var $this MultimediaController */
/* @var $model Multimedia */

$this->breadcrumbs=array(
	'Proyecto digital'=>array('index'),
	'Proyectos registrados',
);

if (Yii::app()->user->checkAccess('tutor')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Administrar Proyectos digitales</h4>

<div class="row">
	<div class="col s12">
		<ul class="tabs cyan">
			<li class="tab col s3"><a aria-controls="video" class="active white-text" href="#video">Video</a></li>
			<li class="tab col s2"><a aria-controls="audio" class="white-text" href="#audio">Audio</a></li>
		</ul>
	</div>
	<div id="video" class="col s12">
		<?php
		$multimedia->dbCriteria->condition="tipomult='video'";
		$this->renderPartial("_multimedia",array("multimedia"=>$multimedia,'idGrid'=>'grid-video','tab'=>1));
		?>
	</div>
	<div id="audio" class="col s12">
		<?php
		$multimedia->dbCriteria->condition="tipomult='audio'";
		$this->renderPartial("_multimedia",array("multimedia"=>$multimedia,'idGrid'=>'grid-audio','tab'=>2));
		?>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('load', function(){
		function alertD(){
			Swal.fire({
				icon: 'success',
				title: "Registro eliminado",
				showConfirmButton: false,
				timer: 2500 // es ms (mili-segundos)
			});
		}
	});
</script>
