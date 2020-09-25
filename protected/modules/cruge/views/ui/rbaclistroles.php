<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("roles"));?></h4>

<div class='row'>
	<div class="center-left">
		<div class="col s6">
			<div class="btn waves-effect waves-ligh">
				<?php
				echo CHtml::link(
					//CrugeTranslator::t("Crear Rol"),
					"Crear rol <i class='small material-icons right'>perm_identity</i>",
					Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_ROLE),
					array('class'=>'white-text')
				);
				?>
			</div>
		</div>
	</div>
</div>

<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>
