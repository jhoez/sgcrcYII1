<?php
	/* formulario de edicion de CrugeSystem

		argumento:

		$model: instancia de ICrugeSession
	*/
?>

<?php
	if(Yii::app()->user->hasFlash('systemFormFlash'))  {
		echo "<div class='flash-success'>";
		echo Yii::app()->user->getFlash('systemFormFlash');
		echo "</div>";
	}
?>

<div class="valign-wrapper row">
	<div class="col s12">
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'CrugeSystem-Form',
	    'enableAjaxValidation'=>false,
	    'enableClientValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row form-group">
		<h6 class="center-align"><?php echo ucwords(CrugeTranslator::t("opciones de Sesion"));?></h6>
		<div class="row">
			<?php echo $form->labelEx($model,'systemdown',array('class'=>'black-text')); ?>
			<div class="switch">
				<label>
					No
					<?php echo $form->checkBox($model,'systemdown'); ?>
					<span class="lever"></span>
					Si
				</label>
			</div>
			<?php echo $form->error($model,'systemdown',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'systemnonewsessions',array('class'=>'black-text')); ?>
			<div class="switch">
				<label>
					No
					<?php echo $form->checkBox($model,'systemnonewsessions'); ?>
					<span class="lever"></span>
					Si
				</label>
			</div>
			<?php echo $form->error($model,'systemnonewsessions',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class='row'>
			<?php echo $form->labelEx($model,'sessionmaxdurationmins'); ?>
			<?php echo $form->textField($model,'sessionmaxdurationmins',array('size'=>5,'maxlength'=>4,'placeholder'=>'Tiempo de session maximo')); ?>
			<?php echo $form->error($model,'sessionmaxdurationmins'); ?>
		</div>
	</div>
	<div class="row form-group">
		<h6 class="center-align"><?php echo ucwords(CrugeTranslator::t("opciones de registro de usuarios"));?></h6>
		<div class="row">
			<?php echo $form->labelEx($model,'registerusingcaptcha',array('class'=>'black-text')); ?>
			<div class="switch">
				<label>
					No
					<?php echo $form->checkBox($model,'registerusingcaptcha'); ?>
					<span class="lever"></span>
					Si
				</label>
			</div>
			<?php echo $form->error($model,'registerusingcaptcha',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class='row'>
			<?php echo $form->labelEx($model,'registerusingactivation',array('class'=>'black-text')); ?>
			<?php echo $form->dropDownList(
				$model,
				'registerusingactivation',
				Yii::app()->user->um->getUserActivationOptions(),
				array('class'=>'browser-default')
			); ?>
			<?php echo $form->error($model,'registerusingactivation',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class='row'>
			<?php echo $form->labelEx($model,'defaultroleforregistration'); ?>
			<?php echo $form->dropDownList(
				$model,
				'defaultroleforregistration',
				Yii::app()->user->rbac->getRolesAsOptions(CrugeTranslator::t("--no asignar ningun rol--")),
				array('class'=>'browser-default')
			); ?>
			<?php echo $form->error($model,'defaultroleforregistration'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'registrationonlogin',array('class'=>'black-text')); ?>
			<div class="switch">
				<label>
					No
					<?php echo $form->checkBox($model,'registrationonlogin'); ?>
					<span class="lever"></span>
					Si
				</label>
			</div>
			<?php echo $form->error($model,'registrationonloginn',array('class'=>'red-text darken-3')); ?>
		</div>
	</div>

	<div class="row form-group">
		<h6><?php echo ucwords(CrugeTranslator::t("terminos y condiciones de registro"));?></h6>
		<div class="row">
			<?php echo $form->labelEx($model,'registerusingterms',array('class'=>'black-text')); ?>
			<div class="switch">
				<label>
					No
					<?php echo $form->checkBox($model,'registerusingterms'); ?>
					<span class="lever"></span>
					Si
				</label>
			</div>
			<?php echo $form->error($model,'registerusingterms',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class='row'>
			<?php echo $form->labelEx($model,'registerusingtermslabel',array('class'=>'black-text')); ?>
			<?php echo $form->textField($model,'registerusingtermslabel',array('size'=>45,'maxlength'=>100,'placeholder'=>'Etiqueta','class'=>'materialize-textarea')); ?>
			<?php echo $form->error($model,'registerusingtermslabel',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class='row'>
			<?php echo $form->labelEx($model,'terms',array('class'=>'black-text')); ?>
			<?php echo $form->textArea($model,'terms',array('rows'=>10,'cols'=>50,'placeholder'=>'Terminos y condiciones','class'=>'materialize-textarea')); ?>
			<?php echo $form->error($model,'terms',array('class'=>'red-text darken-3')); ?>
		</div>
		<div class="center-align">
			<div class="col s12">
				<div class="btn waves-effect waves-ligh">
					<?php Yii::app()->user->ui->tbutton("Actualizar"); ?>
					<i class="material-icons right">update</i>
				</div>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
