<?php
/* @var $this FormatoController */
/* @var $formato Formato */

$this->breadcrumbs=array(
	'Equipo'=>array('/equipo/index'),
	'Formato'=>array('index'),
	'Actualizar formato',
);

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('administrador')) {
    $this->menu=array(
        array('label'=>"<i class='small material-icons'>home</i>", 'url'=>array('index'),'linkOptions'=>array('class'=>'btn-floating blue')),
    );
}
?>

<h4 class="center-align">Actualizar Formato "<?php echo $formato->nombf; ?>"</h4>

<?php $this->renderPartial('_form', array('formato'=>$formato)); ?>
