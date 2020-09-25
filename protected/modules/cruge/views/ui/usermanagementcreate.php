<h4 class="center-align" ><?php echo ucwords(CrugeTranslator::t("crear Usuario"));?></h4>
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row form-group">
	<div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">perm_identity</i>
            <?php echo $form->textField($model,'username', array('placeholder' => 'User' )); ?>
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->error($model,'username',array('class'=>'red-text darken-3')); ?>
        </div>
	</div>
	<div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <?php echo $form->textField($model,'email', array('placeholder' => 'Email' )); ?>
            <?php echo $form->labelEx($model,'email'); ?>
    		<?php echo $form->error($model,'email',array('class'=>'red-text darken-3')); ?>
        </div>
	</div>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">perm_identity</i>
            <?php echo $form->textField($model,'cedula', array('placeholder' => 'Cedula' )); ?>
            <?php echo $form->labelEx($model,'cedula'); ?>
    		<?php echo $form->error($model,'cedula',array('class'=>'red-text darken-3')); ?>
        </div>
	</div>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">work</i>
            <?php echo $form->textField($model,'cbit', array('placeholder' => 'Cbit al que pertenece' )); ?>
            <?php echo $form->labelEx($model,'cbit'); ?>
    		<?php echo $form->error($model,'cbit',array('class'=>'red-text darken-3')); ?>
        </div>
	</div>
	<div class="row">
        <div class="input-field col s12">
            <?php echo $form->passwordField($model,'newPassword', array('placeholder' => 'Password' )); ?>
            <?php echo $form->labelEx($model,'newPassword'); ?>
    		<?php echo $form->error($model,'newPassword',array('class'=>'red-text darken-3')); ?>

    		<script>
    			function fnSuccess(data){
    				$('#CrugeStoredUser_newPassword').val(data);
    			}
    			function fnError(e){
    				alert("error: "+e.responseText);
    			}
    		</script>
            <div class="row">
                <div class="col s6">
                    <div class="btn waves-effect waves-ligh">
                        <?php echo CHtml::ajaxbutton(
                			CrugeTranslator::t("Generar una nueva clave"),
                            Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                            array('success'=>'js:fnSuccess','error'=>'js:fnError'),
                            array('id' => 'gnc','class'=>'white-text')
                		); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="center-align">
        <div class="col s12">
            <div class="btn waves-effect waves-ligh">
                <?php Yii::app()->user->ui->tbutton("Crear Usuario"); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
</div>
