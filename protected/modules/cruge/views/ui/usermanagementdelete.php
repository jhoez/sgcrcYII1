<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("eliminar usuario"));?></h4>
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>

<div class="valign-wrapper row">
    <div class="col s12">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'crugestoreduser-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
        )); ?>

        <?php echo $form->errorSummary($model); ?>

        <h6 class="center-align">
            <?php echo "Usuario: ".$model->username;  echo ", Email: ".$model->email; ?>
        </h6>

        <div class="row center-align">
            <?php echo ucfirst(CrugeTranslator::t("marque la casilla para confirmar la eliminacion")); ?>
            <div class="switch">
                <label>
                    No
                    <?php echo $form->checkBox($model,'deleteConfirmation'); ?>
                    <span class="lever"></span>
                    Si
                </label>
            </div>
            <?php echo $form->error($model,'deleteConfirmation'); ?>
        </div>

        <div class="center-align">
            <div class="center-left">
                <div class="col s6">
                    <div class="btn waves-effect waves-ligh">
                        <?php Yii::app()->user->ui->tbutton("Eliminar"); ?>
                    </div>
                </div>
            </div>

            <div class="center-align">
            	<div class="col s6">
            		<div class="btn waves-effect waves-ligh red accent-5">
            			<?php //Yii::app()->user->ui->bbutton("Volver",'Cancelar'); ?>
            			<?php echo CHtml::Button('Volver', array('class'=>'white-text','onclick' => 'js:document.location.href="../../../ui/usermanagementadmin"')); ?>
            		</div>
            	</div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

</div><!-- form -->
