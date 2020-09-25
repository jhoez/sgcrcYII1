<div class="form">
<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t('admin', 'gestion de Usuarios'));?></h4>
<?php
/*
	para darle los atributos al CGridView de forma de ser consistente con el sistema Cruge
	es mejor preguntarle al Factory por los atributos disponibles, esto es porque si se decide
	cambiar la clase de CrugeStoredUser por otra entonces asi no haya dependenci directa a los
	campos.
*/
$cols = array();

// presenta los campos de ICrugeStoredUser
foreach(Yii::app()->user->um->getSortFieldNamesForICrugeStoredUser() as $key=>$fieldName){
	$value=null; // default
	$filter=null; // default, textbox
	$type='text';
	if($fieldName == 'state'){
		$value = '$data->getStateName()';
		$filter = Yii::app()->user->um->getUserStateOptions();
	}
	if($fieldName == 'logondate'){
		$type='datetime';
	}
	$cols[] = array('name'=>$fieldName,'value'=>$value,'filter'=>$filter,'type'=>$type);
}

$cols[] = array(
	'class'=>'CButtonColumn',
	'template' => '{update} {eliminar}',
	'deleteConfirmation'=>CrugeTranslator::t('admin', 'Esta seguro de eliminar este Usuario'),
	'afterDelete'=>'js:alertD();',
	'buttons' => array(
		'update'=>array(
			'label'=>CrugeTranslator::t('admin', 'Actualizar Usuario'),
			'url'=>'array("usermanagementupdate","id"=>$data->getPrimaryKey())',
			'imageUrl'=>Yii::app()->user->ui->getResource("pencil.svg"),
		),
		'eliminar'=>array(
			'label'=>CrugeTranslator::t('admin', 'Eliminar Usuario'),
			'imageUrl'=>Yii::app()->user->ui->getResource("delete.svg"),
			'url'=>'array("usermanagementdelete","id"=>$data->getPrimaryKey())',
			'options' => array('class' => 'delete')
		),
	),
);
$this->widget(Yii::app()->user->ui->CGridViewClass,array(
	'dataProvider'=>$dataProvider,
	'columns'=>$cols,
	'filter'=>$model,
	'itemsCssClass'=>'highlight',
));

?>
</div>

<script type="text/javascript">
	window.addEventListener('load', function(){
		function alertD(){
			Swal.fire({
				icon: 'success',
				title: "Usuario eliminado",
				showConfirmButton: false,
				timer: 2500 // es ms (mili-segundos)
			});
		}
	});
</script>
