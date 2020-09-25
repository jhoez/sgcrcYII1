<?php
/* @var $this FormatoController */
/* @var $dataProvider CActiveDataProvider */
?>

<h5 class="center-align">Actas descargables</h5>

<div class="valign-wrapper row">
    <div class="col s10 pull-l3 l6">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'actas-form',
            'action'=>Yii::app()->createUrl("/formato/descargaF"),
            "enableClientValidation"=>true,
            "clientOptions"=>array(
                "validateOnSubmit"=>true,
            ),
        )); ?>
        <?php echo $form->errorSummary($formato);?>
        <div class="row">
            <?php echo $form->labelEx($formato,'idf',array('class'=>'black-text')); ?>
            <?php echo $form->dropDownList(
                $formato,'idf',
				CHtml::listData($formato::model()->findAll( array('condition'=>"opcion='acta' AND update_at=1 ") ),'idf', 'nombf'),
				array(
					'prompt'=>'Seleccione el Acta',
					'options' => array('Seleccione'=>array('selected'=>true)),
					'class'=>'browser-default'
				)
            );?>
            <?php echo $form->error($formato,'idf',array('class'=>'red-text darken-3')); ?>
        </div>

        <div class="row center-align">
    		<div class="col s12">
    			<div class="btn waves-effect waves-ligh">
    				<?php echo CHtml::submitButton($formato->isNewRecord ? 'Descargar' : 'Actualizar'); ?>
    				<i class="material-icons right">get_app</i>
    			</div>
    		</div>
    	</div>

        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="divider"></div>

<h5 class='center-align'>Registros</h5>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'formato-grid',
	'dataProvider'=>$formato2->search(),
	'filter'=>$formato2,
	'itemsCssClass'=>'highlight',
	'columns'=>array(
		array(
			'header' => 'ID',
            'name' => 'idf',
            'value' => '$data->idf',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador'),
			'filter' => false,
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'F subido',
            'name' => 'create_at',
            'value' => '$data->create_at',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Opcion',
            'name' => 'opcion',
            'value' => '$data->opcion',
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Por ver/Visto',
            'name' => 'nombf',
            'value' => '$data->nombf',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Extensión',
            'name' => 'extens',
            'value' => '$data->extens',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Tamaño File',
            'name' => 'tamanio',
            'value' => '$data->tamanio',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Status',
            'name' => 'status',
            'value' => '$data->status == true ? "Visto" : "Por ver" ',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor'),
			'filter' =>	array('0'=>'Por ver','1'=>'Visto'),
            'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','Esta seguro de elimiar el Registro...'),
			'header'=>Yii::t('app','Acción'),
			'template'=>'{view}{update}{delete}{download}{marcar}',
			'visible' => Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador'),
			'buttons'=>array(
				'view'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("/formato/view", array("id"=>$data->idf))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'update'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("/formato/update", array("id"=>$data->idf))',
					//'click'=>"function(){//obtener valor del campo entregado para evitar que marque otra vez}",
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'delete'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("/formato/delete", array("id"=>$data->idf))',
					'visible' => "Yii::app()->user->checkAccess('admin')"
				),
				'download'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/download.svg",
					'url'=>'Yii::app()->controller->createUrl("/formato/verformato", array("id"=>$data->idf))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')",
					//'options'=>array("target"=>"_blank"),
					//'url'=>"CHtml::normalizeUrl(array('generarpdf', 'id'=>\$data->ideq))",
				),
				'marcar'=>array(
					'imageUrl'=>Yii::app()->baseUrl."/fonts/checked.svg",
					'url'=>'Yii::app()->controller->createUrl("/formato/updatestatus", array("id"=>$data->idf))',
					'visible'=>"Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
			),
		),// FIN ACCIONES
	),
)); ?>
