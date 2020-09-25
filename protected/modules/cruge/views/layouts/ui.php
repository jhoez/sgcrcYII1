<?php
/*
	aqui: $this->beginContent('//layouts/main'); indica que este layout se amolda
	al layout que se haya definido para todo el sistema, y dentro de el colocara
	su propio layout para amoldar a un CPortlet.

	esto es para asegurar que el sistema disponga de un portlet,
	esto es casi lo mismo que haber puesto en UiController::layout = '//layouts/column2'
	a diferencia que aqui se indica el uso de un archivo CSS para estilos predefinidos

	Yii::app()->layout asegura que estemos insertando este contenido en el layout que
	se ha definido para el sistema principal.
*/
?>
<?php $this->beginContent('//layouts/'.Yii::app()->layout); ?>

<?php
	if(Yii::app()->user->isSuperAdmin) echo Yii::app()->user->ui->superAdminNote();
?>
<div class="container">
	<?php if(Yii::app()->user->checkAccess('administrador') || Yii::app()->user->isSuperAdmin) { ?>
		<a class='dropdown-trigger btn cyan' href='#' data-target='dropdown1'>
			Menu opciones<i class="material-icons right">arrow_drop_down</i>
		</a>
		<?php
		//$this->widget('application.extensions.mbmenu.MbMenu', array(
		$this->widget('zii.widgets.CMenu', array(
			'id' => 'dropdown1',//id del ul
			//'items'=>Yii::app()->user->ui->adminItemsAlternative,
			'items'=>Yii::app()->user->ui->adminItems,
			'htmlOptions'=>array('class'=>'dropdown-content'),
		));
		?>
		<div id="col s12">
			<?php echo $content; ?>
		</div>
	<?php } ?>
</div>
<?php $this->endContent(); ?>
