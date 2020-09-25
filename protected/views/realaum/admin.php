<?php
/* @var $this RealaumController */
/* @var $model Realaum */

$this->breadcrumbs=array(
	'Realidad Aumentada'=>array('index'),
	'Proyectos RA registrados',
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

<h4 class="center-align">Administrar Realidad Aumentada</h4>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'realaum-grid',
	'dataProvider'=>$realidadaumentada->search(),
	'filter'=>$realidadaumentada,
	'htmlOptions'=>array('class'=>'highlight'),
	'columns'=>array(
		array(
			'header' => 'Creador',
            'name' => 'creador',
            'value' => '$data->rapro->creador',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Nomb. proyecto',
            'name' => 'nombpro',
            'value' => '$data->rapro->nombpro',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Colaboración',
            'name' => 'rapro',
            'value' => '$data->rapro->colaboracion',
			'filter'=>false,
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'F Creado',
            'name' => 'rapro',
            'value' => '$data->rapro->create_at',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','DeleteSocialApplicantion'),
			'header'=>Yii::t('app','Acciones'),
			//'afterDelete'=>'js:alertD();',
			'template'=>'{view}{update}{delete}{ra}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','Ver registro'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idra))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				'update'=>array(
					'label'=>Yii::t('app','Actualizar registro'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idra))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				'delete'=>array(
					'label'=>Yii::t('app','Eliminar registro'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->idra))',
					'visible' => "Yii::app()->user->checkAccess('admin')"
				),
				'ra'=>array(
					'label'=>Yii::t('app','Ver Realidad Aumentada'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/ra1.png",
					'url'=>'Yii::app()->controller->createUrl("verra", array("id" => $data->idra))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')",
					'options'=>array("target"=>"_blank"),
				),
			),
		),// FIN ACCIONES
	),
)); ?>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('raD')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('raD')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>

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
