<?php
/* @var $this EquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Equipos'=>array('index'),
    'Canaimitas y Formatos'
);

if(Yii::app()->user->checkAccess('tutor')){
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>note_add</i>", 'url'=>array('/formato/create'),'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>schedule</i>", 'url'=>array('/asistencia/create'),'linkOptions'=>array('class'=>'btn-floating deep-purple darken-4')),
        array('label'=>"<i class='small material-icons'>add_to_queue</i>", 'url'=>array('create'),'linkOptions'=>array('class'=>'btn-floating green'))
    );
}

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>watch_later</i>", 'url'=>array('/asistencia/index'), 'linkOptions'=>array('class'=>'btn-floating deep-purple darken-4')),
        array('label'=>"<i class='Tiny material-icons'>note_add</i>", 'url'=>array('/formato/create'), 'linkOptions'=>array('class'=>'btn-floating blue')),
        array('label'=>"<i class='small material-icons'>assignment</i>", 'url'=>array('reportespdf'), 'linkOptions'=>array('class'=>'btn-floating cyan darken-4')),
        array('label'=>"<i class='small material-icons'>add_to_queue</i>", 'url'=>array('create'), 'linkOptions'=>array('class'=>'btn-floating green')),
    );
}

?>

<div class="row">
    <h4 class="center-align">Canaimitas / Formatos</h4>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
    	'id' => 'form_varios',
    	'tabs' => array(
    		"Canaimitas"=>array(
    			//'id' => 'eq',
    			'content' => $this->renderPartial("_view",array("equipo"=>$equipo),true)
    		),
            "Formatos"=>array(
    			//'id' => 'fo',
    			'content' => $this->renderPartial("_viewf",array(
                    "formato"=>$formato,
                    "formato2"=>$formato2
                ),true)
    		)
    	),
    	'htmlOptions'=>array('style'=>'display: none;'),  // INVISIBLE..
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
