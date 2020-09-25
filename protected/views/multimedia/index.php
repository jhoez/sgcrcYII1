<?php
/* @var $this MultimediaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Proyectos digitales',
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
		array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green'))
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>photo</i>", 'url'=>array('/imagen/create'),'linkOptions'=>array('class'=>'btn-floating purple')),
        array('label'=>"<i class='small material-icons'>list</i>", 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>library_add</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green')),
    );
}

?>

<div class="row">
	<h4 class="center">Lista de Proyectos Digitales</h4>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
		'id' => 'multimedia_form_varios',
		'tabs' => array(
			'Video'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewv",array('multimedia'=>$multimedia),true)
			),
			'Audio Radial'=>array(
				//'id' => 'nombreid',
				'content' => $this->renderPartial("_viewa",array('multimedia'=>$multimedia),true)
			)
		),
		'htmlOptions'=>array('style'=>'display: none'),  // INVISIBLE..
		//'options' => array('collapsible' => false,'cookie' => 9000,'event'=>'mouseover'),// additional javascript options for the tabs plugin
	));

	// VISIBLE solo cuando cargue todo..
	Yii::app()->getClientScript()->registerScript(
		"multimedia_form_varios", // un ID unico tambien
		"$('#multimedia_form_varios').show();" ,
		CClientScript::POS_LOAD
	);// el ID del tab
	?>
</div>
