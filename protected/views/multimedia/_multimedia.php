<?php

switch ($tab){
    case 1:
        echo "<h4 class='center-align'>Biblioteca de Videos</h4>";
        break;
    case 2:
        echo "<h4 class='center-align'>Biblioteca de Audioradiales</h4>";
        break;
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>"$idGrid",
	'dataProvider'=>$multimedia->search(),
	'filter'=>$multimedia,
	'htmlOptions'=>array('class'=>'highlight'),
	'columns'=>array(
		array(
			'header' => 'Nomb. Proyecto',
			'name' => 'nombpro',
			'value' => '$data->multpro->nombpro',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Nomb. Creador',
			'name' => 'creador',
			'value' => '$data->multpro->creador',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Nomb. multimedia',
			'name' => 'nombmult',
			'value' => '$data->nombmult',
            'filter'=>false,
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header'		=> 'audio o video',
			'name'			=> 'tipomult',
			'value'			=> '$data->tipomult == "video" ? "Video" : "Audioradiales" ',
			'filter'		=> array('video'=>'Video','audio'=>'Audioradiales'),
			'htmlOptions'	=> array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','¿Esta seguro de eliminar el proyecto?'),
			'header'=>Yii::t('app','Acciones'),
			'template'=>'{view}{update}{delete}{video}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idmult))',
                    'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				'update'=>array(
					'label'=>Yii::t('app','Update'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idmult))',
                    'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				'delete'=>array(
					'label'=>Yii::t('app','Delete'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->idmult))',
                    'visible' => "Yii::app()->user->checkAccess('admin')"
				),
				'video'=>array(
					'label'=>Yii::t('app','av'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/download.svg",
					'url'=>'Yii::app()->controller->createUrl("descargarwav", array("id"=>$data->idmult))',
                    'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')",
					'options'=>array('target'=>'_blank'),
				),
			),
		),// FIN ACCIONES
	),
)); ?>
