<?php
/* @var $this LibrosController */
/* @var $model Libros */

$this->breadcrumbs=array(
	'Lista de libros'=>array('index'),
	'Administrar libros',
);

switch ($tab){
    case 1:
        echo "<h4 align='center'>Coleccion Bicentenaria educacion inicial</h4>";
        break;
    case 2:
        echo "<h4 align='center'>Coleccion Bicentenaria educacion primaria</h4>";
        break;
    case 3:
        echo "<h4 align='center'>Coleccion Bicentenaria educacion media</h4>";
        break;
	case 4:
		echo "<h4 align='center'>Coleccion Maestros</h4>";
		break;
	case 5:
		echo "<h4 align='center'>Lectura sugerida</h4>";
		break;
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>"$idGrid",
	'dataProvider'=>$libros->search(),
	'filter'=>$libros,
	'htmlOptions'=>array('class'=>'highlight'),
	'columns'=>array(
		array(
			'header' => 'ID',
			'name' => 'idlib',
			'value' => '$data->idlib',
			'filter'=>false,
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Archivo',
			'name' => 'nomblib',
			'value' => '$data->nomblib',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Imagen',
			'name' => 'libimg',
			'value' => '$data->libimg->nombimg',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'header' => 'Colección',
			'name' => 'coleccion',
			'value' => '$data->coleccion',
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(// ACCIONES
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','¿Esta seguro de eliminar el Libro?'),
			'header'=>Yii::t('app','Acciones'),
			//'afterDelete'=>'js:alertD()',// me da error al usarla
			'template'=>'{view}{update}{delete}',
			//'template'=>'{view}{update}{delete}{pdf}',
			'buttons'=>array(
				'view'=>array(
					'label'=>Yii::t('app','View'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/view.svg",
					'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->idlib))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador') || Yii::app()->user->checkAccess('tutor')"
				),
				'update'=>array(
					'label'=>Yii::t('app','Update'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/pencil.svg",
					'url'=>'Yii::app()->controller->createUrl("update", array("id"=>$data->idlib))',
					'visible' => "Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')"
				),
				'delete'=>array(
					'label'=>Yii::t('app','Delete'),
					'imageUrl'=>Yii::app()->baseUrl."/fonts/delete.svg",
					'url'=>'Yii::app()->controller->createUrl("delete", array("id"=>$data->idlib))',
					'visible' => "Yii::app()->user->checkAccess('admin')"
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
));

?>

<script type="text/javascript">
	document.addEventListener('load', function(){
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
