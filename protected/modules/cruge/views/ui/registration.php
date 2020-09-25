<div class="valign-wrapper row">
    <div class="col s12 pull-l3 l6">
        <h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("registrate"));?></h4>
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'registration-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<h6 class="row"><?php echo ucfirst(CrugeTranslator::t("Datos de la cuenta"));?></h6>
<div class='row'>
<?php
    foreach (CrugeUtil::config()->availableAuthModes as $authmode){
        echo "<div class='input-field col s12'>";
        echo $form->labelEx($model,$authmode,array('class'=>'black-text'));
        echo $form->textField($model,$authmode);
        echo $form->error($model,$authmode,array('class'=>'red-text darken-3'));
        echo "</div>";
    }
?>

<div class='item'>
    <div class='input-field col s12'>
        <?php echo $form->labelEx($model,'newPassword',array('class'=>'black-text')); ?>
        <?php echo $form->textField($model,'newPassword'); ?>
    </div>

    <div class="col s12">
        <div class="btn waves-effect waves-ligh grey">
            <?php echo CHtml::ajaxbutton(
                CrugeTranslator::t("Generar una nueva clave"),
                Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                array(
                    'success'=>new CJavaScriptExpression('fnSuccess'),
                    'error'=>new CJavaScriptExpression('fnError')
                )
            ); ?>
        </div>
    </div>

    <p class='hint col'>
        <?php echo CrugeTranslator::t(
            "Use letras, mayusculas, digitos y caracteres especiales @#$%. minimo 6 simbolos."
        );?>
    </p>
    <?php echo $form->error($model,'newPassword',array('class'=>'red-text darken-3')); ?>
</div>
</div>

<script>
    function fnSuccess(data){
        $('#CrugeStoredUser_newPassword').val(data);
    }
    function fnError(e){
        alert("error: "+e.responseText);
    }
</script>

<!-- inicio de campos extra definidos por el administrador del sistema -->
<?php
	if(count($model->getFields()) > 0){
		echo "<div class='row form-group-vert'>";
		echo "<h6 class='center-align'>".ucfirst(CrugeTranslator::t("perfil"))."</h6>";
		foreach($model->getFields() as $f){
			// aqui $f es una instancia que implementa a: ICrugeField
			echo "<div class='input-field col s12'>";
			echo Yii::app()->user->um->getLabelField($f);
			echo Yii::app()->user->um->getInputField($model,$f);
			echo $form->error($model,$f->fieldname);
			echo "</div>";
		}
		echo "</div>";
	}
?>
<!-- fin de campos extra definidos por el administrador del sistema -->


<!-- inicio - terminos y condiciones -->
<?php
	if(Yii::app()->user->um->getDefaultSystem()->getn('registerusingterms') == 1)
	{
?>
<div class='form-group-vert'>
	<h6 class="center-align"><?php echo ucfirst(CrugeTranslator::t("Terminos y condiciones"));?></h6>
	<?php echo CHtml::textArea(
        'terms',
        Yii::app()->user->um->getDefaultSystem()->get('terms'),
        array('readonly'=>'readonly','rows'=>5,'cols'=>'80%','class'=>'materialize-textarea')
    ); ?>
    <div>
        <span class='required'>*</span>
        <?php echo CrugeTranslator::t(Yii::app()->user->um->getDefaultSystem()->get('registerusingtermslabel')); ?>
    </div>
    <div class="row">
		<?php echo $form->labelEx($model,'terminosYCondiciones',array('class'=>'black-text')); ?>
		<div class="switch">
			<label>
				No
                <?php echo $form->checkBox($model,'terminosYCondiciones'); ?>
				<span class="lever"></span>
				Si
			</label>
		</div>
        <?php echo $form->error($model,'terminosYCondiciones',array('class'=>'red-text darken-3')); ?>
	</div>
</div>
<!-- fin - terminos y condiciones -->
<?php } ?>



<!-- inicio pide captcha -->
<?php if(Yii::app()->user->um->getDefaultSystem()->getn('registerusingcaptcha') == 1) { ?>
<div class='form-group-vert'>
	<h6 class="center-align"><?php echo ucfirst(CrugeTranslator::t("Codigo de seguridad"));?></h6>
	<div class="row">
		<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?php echo CrugeTranslator::t("Por favor ingrese los caracteres o digitos que vea en la imagen");?></div>
		<?php echo $form->error($model,'verifyCode',array('class'=>'red-text darken-3')); ?>
	</div>
</div>
<?php } ?>
<!-- fin pide captcha-->

<div class="center-align">
    <div class="col s12">
        <div class="btn waves-effect waves-ligh">
            <?php Yii::app()->user->ui->tbutton("Registrarse"); ?>
            <i class="material-icons right">send</i>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

</div>
</div>
