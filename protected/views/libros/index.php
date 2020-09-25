<?php
/* @var $this LibrosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Colección Bicentenaria',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
    );
}
?>


<div class="row">
	<h4 class="center">Libros Coleccion Bicentenaria</h4>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
		'id' => 'form_varios',
		'tabs' => array(
			'Inicial'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewi",array('libros'=>$libros),true)
			),
			'Primaria'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewp",array('libros'=>$libros),true)
			),
			'Media'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewm",array('libros'=>$libros),true)
			),
			'Maestros'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewma",array('libros'=>$libros),true)
			),
			'Lectura'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewl",array('libros'=>$libros),true)
			),
		),
		'htmlOptions'=>array('style'=>'display: none'),  // INVISIBLE..
		//'options' => array('collapsible' => false,'cookie' => 9000,'event'=>'mouseover'),// additional javascript options for the tabs plugin
	));

	// VISIBLE solo cuando cargue todo..
	Yii::app()->getClientScript()->registerScript(
		"form_varios", // un ID unico tambien
		"$('#form_varios').show();" ,
		CClientScript::POS_LOAD
	);// el ID del tab
	?>
</div>
