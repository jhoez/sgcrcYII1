<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("operaciones"));?></h4>

<div class='row'>
	<div class="center-left">
		<div class="col s6">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::link(
					CrugeTranslator::t("Crear Operacion"),
					Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_OPERATION),
					array('class'=>'white-text')
				);?>
			</div>
		</div>
	</div>
</div>

<?php
	echo CrugeTranslator::t("Filtrar por Controlador:");
	$ar = array(
		'0'=>CrugeTranslator::t('Ver Todo'),
		'1'=>CrugeTranslator::t('Otras'),
		'2'=>CrugeTranslator::t('Cruge'),
		//'3'=>CrugeTranslator::t('Controladoras'),
	);
	foreach(Yii::app()->user->rbac->enumControllers() as $c)
		$ar[$c] = $c;
	// build list
	echo "
	<div class='row'>
	<a class='dropdown-trigger btn cyan' href='#' data-target='dropdown2'>
		lista de opciones<i class='material-icons right'>arrow_drop_down</i>
	</a>
	";
	echo "<ul id='dropdown2' class='dropdown-content'>";
	foreach($ar as $filter=>$text)
		echo "<li>".CHtml::link($text, array('/cruge/ui/rbaclistops','filter'=>$filter))."</li>";
	echo "
	</ul>
	</div>
	";
?>

<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>
