<?php

switch ($tab){
    case 1:
        echo "<h4 align='center'>Asistencia Entrada</h4>";
        break;
    case 2:
        echo "<h4 align='center'>Asistencia Salida</h4>";
        break;
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>"$idGrid",
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
			'header' => 'Hora marcada',
			'name' => 'horainout',
			'value' => '$data->horainout',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Status',
			'name' => 'status',
			'value' => '$data->status',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','¿Esta seguro de eliminar la asistencia?'),
			'header'=>Yii::t('app','Acciones'),
			//'afterDelete'=>'js:alertD()',// me da error al usarla
			'template'=>'{view}{update}{delete}',
			//'template'=>'{view}{update}{delete}{pdf}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idasis))',
				),
				'update'=>array(
					'label'=>Yii::t('app','Update'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idasis))',
				),
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
