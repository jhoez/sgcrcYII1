<?php
	/*
		$model:
			es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()

		$boolIsUserManagement:
			true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
	*/
?>
<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t(
	$boolIsUserManagement ? "editando usuario" : "editando tu perfil"
));?></h4>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
<div class="row form-group">

	<div class='field-group'>
		<h6 class="center-align"><?php echo ucfirst(CrugeTranslator::t("datos de la cuenta"));?></h6>
		<div class='row'>
			<div class="input-field col s12">
	            <i class="material-icons prefix">perm_identity</i>
				<?php echo $form->textField($model,'username', array('placeholder' => 'User' )); ?>
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->error($model,'username',array('class'=>'red-text darken-3')); ?>
			</div>
		</div>
		<div class='row'>
			<div class="input-field col s12">
	            <i class="material-icons prefix">email</i>
				<?php echo $form->textField($model,'email', array('placeholder' => 'Email' )); ?>
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->error($model,'email',array('class'=>'red-text darken-3')); ?>
			</div>
		</div>
		<div class='row'>
			<div class="input-field col s12">
				<?php echo $form->textField($model,'newPassword',array('size'=>10, 'placeholder' => 'Password')); ?>
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
								array('success'=>new CJavaScriptExpression('fnSuccess'),
								'error'=>new CJavaScriptExpression('fnError')),
								array('id' => 'gnc', 'class'=>'white-text')
							); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class='field-group'>

		<div class='col textfield-readonly'>
			<div class="row">
				<?php echo $form->labelEx($model,'regdate'); ?>
				<?php echo $form->textField($model,'regdate',
					array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->regdate),
					)
				); ?>
			</div>
		</div>
		<div class='col textfield-readonly'>
			<div class="row">
				<?php echo $form->labelEx($model,'actdate'); ?>
				<?php echo $form->textField($model,'actdate',
					array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->actdate),
					)
				); ?>
			</div>
		</div>
		<div class='col textfield-readonly'>
			<div class="row">
				<?php echo $form->labelEx($model,'logondate'); ?>
				<?php echo $form->textField($model,'logondate',
					array(
						'readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->logondate),
					)
				); ?>
			</div>
		</div>

	</div>
</div>

<!-- inicio de campos extra definidos por el administrador del sistema -->
<?php
	if(count($model->getFields()) > 0){
		echo "<div class='row form-group'>";
		echo "<h6 class='center-align'>".ucfirst(CrugeTranslator::t("perfil"))."</h6>";
		foreach($model->getFields() as $f){
			// aqui $f es una instancia que implementa a: ICrugeField
			echo "<div class='row'>";
			echo Yii::app()->user->um->getLabelField($f);
			echo Yii::app()->user->um->getInputField($model,$f);
			echo $form->error($model,$f->fieldname);
			echo "</div>";
		}
		echo "</div>";
	}
?>
<!-- fin de campos extra definidos por el administrador del sistema -->




<!-- inicio de opciones avanazadas, solo accesible bajo el rol 'admin' -->

<?php
	if($boolIsUserManagement)
	if(Yii::app()->user->checkAccess('edit-advanced-profile-features',__FILE__." linea ".__LINE__))
		$this->renderPartial('_edit-advanced-profile-features',array('model'=>$model,'form'=>$form),false);
?>

<!-- fin de opciones avanazadas, solo accesible bajo el rol 'admin' -->

<div class="center-align">
	<div class="col s12">
		<div class="btn waves-effect waves-ligh">
			<?php Yii::app()->user->ui->tbutton("Guardar"); ?>
		</div>
	</div>
</div>
<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>
