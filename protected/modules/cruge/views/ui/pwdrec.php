<h4 class="center-align"><?php echo CrugeTranslator::t("Recuperar la clave"); ?></h4>

<?php if(Yii::app()->user->hasFlash('pwdrecflash')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('pwdrecflash'); ?>
</div>
<?php else: ?>
	<div class="valign-wrapper row">
		<div class="col s10 pull-l3 l6">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'pwdrcv-form',
				"enableClientValidation"=>true,
			    "clientOptions"=>array(
			        "validateOnSubmit"=>true,
			        "validateOnChange"=>true,
			        //"validateOnType"=>true
			    ),
			)); ?>

				<div class="row">
					<div class="input-field col s12">
						<?php echo $form->labelEx($model,'username'); ?>
						<?php echo $form->textField($model,'username'); ?>
						<?php echo $form->error($model,'username'); ?>
					</div>
				</div>

				<?php if(CCaptcha::checkRequirements()): ?>
				<div class="row">
					<?php echo $form->labelEx($model,'verifyCode'); ?>
					<div>
					<?php $this->widget('CCaptcha'); ?>
					<?php echo $form->textField($model,'verifyCode'); ?>
					</div>
					<div class="hint"><?php echo CrugeTranslator::t("Por favor ingrese los caracteres o digitos que vea en la imagen");?></div>
					<?php echo $form->error($model,'verifyCode'); ?>
				</div>
				<?php endif; ?>

				<div class="center-align">
					<div class="btn waves-effect waves-light">
						<?php Yii::app()->user->ui->tbutton("Recuperar la Clave"); ?>
					</div>
				</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
<?php endif; ?>
