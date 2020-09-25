<div class="form">
<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("sesiones de Usuario"));?></h4>
<?php
$this->widget(Yii::app()->user->ui->CGridViewClass, array(
    'dataProvider'=>$dataProvider,
    'filter'=>$model,
    'itemsCssClass'=>'centered',//'highlight'
    'columns'=>array(
        array(
            'header'=>'ID',
            'name'=>'idsession',
            'filter'=>false,
            'value'=>'$data->idsession'
        ),
		array('header'=>'ID User','name'=>'iduser','value'=>'$data->iduser'),
		array(
            'header'=>'Usuario',
            'name'=>'sessionname',
            'filter'=>'',
            'value'=>'$data->sessionname'
        ),
		array(
            'header'=>'Status',
            'name'=>'status',
            'filter'=>array(1=>'Activa',0=>'Cerrada'),
            'value'=>'$data->status==1 ? \'activa\' : \'cerrada\' '
        ),
		array('header'=>'Inicio session','name'=>'created','type'=>'datetime'),
		array('header'=>'Fin session','name'=>'lastusage','type'=>'datetime'),
		array('header'=>'Sessiones','name'=>'usagecount','type'=>'number'),
		//array('name'=>'expire','type'=>'datetime'),
        array(
            'header'=>'Dir. IP',
            'name'=>'ipaddress',
            'value'=>'$data->ipaddress'
        ),
		array(
            'header'=>'Acción',
			'class'=>'CButtonColumn',
			'template' => '{delete}',
			'deleteConfirmation'=>CrugeTranslator::t("Esta seguro de eliminar esta sesion?"),
			'buttons' => array(
                'delete'=>array(
                    'label'=>CrugeTranslator::t("Eliminar sesion"),
                    'imageUrl'=>Yii::app()->user->ui->getResource("delete.svg"),
                    'url'=>'array("sessionadmindelete","id"=>$data->getPrimaryKey())'
                ),
            ),
        )
    ),
));
?>
</div>
