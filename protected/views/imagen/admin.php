<?php
/* @var $this ImagenController */
/* @var $imagen Imagen */

$this->breadcrumbs=array(
	'Proyectos Digitales'=>array('/multimedia/index'),
	'Carousel'=>array('index'),
	'Imagenes subidas',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>insert_photo</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
		array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}

?>

<h4 class="center-align">Administrar Imagenes del carousel</h4>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imagen-grid',
	'dataProvider'=>$imagen->search(),
	'filter'=>$imagen,
	'htmlOptions'=>array('class'=>'highlight'),
	'columns'=>array(
		array(
			'header' => 'ID',
			'name' => 'idimag',
			'value' => '$data->idimag',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Imagen',
			'name' => 'nombimg',
			'value' => '$data->nombimg',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header'	=> 'Carpeta',
			'name'		=> 'ruta',
			'value'		=> '$data->ruta',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador'),
			'htmlOptions' => array('style'=>'text-align:center')
		),
		array(
			'header' => 'Tamaño',
			'name' => 'tamanio',
			'value' => '$data->tamanio',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','¿Esta seguro de eliminar el Libro?'),
			'header'=>Yii::t('app','Acciones'),
			//'afterDelete'=>'js:alertD();',
			'template'=>'{view}{delete}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idimag))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'update'=>array(
					'label'=>Yii::t('app','Update'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idimag))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'delete'=>array(
					'label'=>Yii::t('app','Delete'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->idimag))',
					'visible'=>"Yii::app()->user->checkAccess('admin')"
				),
			),
		),// FIN ACCIONES
	),
)); ?>
