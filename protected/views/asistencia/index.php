<?php
/* @var $this AsistenciaController */
/* @var $model Asistencia */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Asistencia'=>array('index'),
	'Administrar asistencia',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>assignment</i>", 'url'=>array('reporteAsistencia'),'linkOptions'=>array('class'=>'btn-floating cyan darken-4')),
        array('label'=>"<i class='small material-icons'>add_circle_outline</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
    );
}

?>

<h4 class="center-align">Administrar Asistencia</h4>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>"asistencia-grid",
	'dataProvider'=>$asistencia->search(),
	'filter'=>$asistencia,
	'htmlOptions'=>array('class'=>'highlight'),
	'columns'=>array(
		array(
			'header' => 'Usuario',
			'name' => 'asisuser',
			'value' => '$data->asisuser->username',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Fecha',
			'name' => 'fecha',
			'value' => '$data->fecha',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Hora Entrada',
			'name' => 'horain',
			'value' => '$data->horain',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Hora Salida',
			'name' => 'horaout',
			'value' => '$data->horaout',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Observación',
			'name' => 'observacion',
			'value' => '$data->observacion',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','¿Esta seguro de eliminar la asistencia?'),
			'header'=>Yii::t('app','Acciones'),
			//'afterDelete'=>'js:alertD()',// me da error al usarla
			'template'=>'{view}{delete}',
			//'template'=>'{view}{update}{delete}{pdf}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idasis))',
				),
				/*'update'=>array(
					'label'=>Yii::t('app','Update'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idasis))',
				),*/
				'delete'=>array(
					'label'=>Yii::t('app','Delete'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->idasis))',
				),
				/*'pdf'=>array(
					'label'=>'PDF',
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pdf_file.svg",
					'url'=>'Yii::app()->controller->createUrl("viewpdf", array("id"=>$data->idlib))',
					//'visible'=>'Yii::app()->user->getIdCustomer() == "1"'
				),*/
			),
		),// FIN ACCIONES
	),
)); ?>
