<?php if(Yii::app()->user->hasFlash('loginflash')): ?>
	<div class="flash-error">
		<?php echo Yii::app()->user->getFlash('loginflash'); ?>
	</div>
<?php else: ?>
	<!--<div class="col card hoverable s10 pull-s1 m6 pull-m3 l4 pull-l4">-->
<br>
	<div class="valign-wrapper row">
		<div class="col s10 pull-s1 pull-l3 l6">
			<h4 class="center-align">Inicio de Session</h4>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'',
				'enableClientValidation'=>false,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			));?>
			<div class="card-content">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">perm_identity</i>
						<?php echo $form->textField($model,'username',array('class'=>'validate')); ?>
						<?php echo $form->labelEx($model,'username'); ?>
					</div>
					<?php echo $form->error($model,'username',array('class'=>'red-text darken-3')); ?>
					<div class="input-field col s12">
						<i class="material-icons prefix">lock_outline</i>
						<?php echo $form->passwordField($model,'password',array('class'=>'validate')); ?>
						<?php echo $form->labelEx($model,'password'); ?>
					</div>
					<?php echo $form->error($model,'password',array('class'=>'red-text darken-3')); ?>
				</div>
			</div>

			<div class="card-action center-align">
				<div class="btn waves-effect waves-light">
					<?php Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Entrar")); ?>
					<i class="material-icons right">send</i>
				</div>
				<div class="">
					<?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
				</div>
				<div class="">
					<?php
					//if(Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1)
					//echo Yii::app()->user->ui->registrationLink;
					?>
				</div>
			</div>

			<?php
			//	si el componente CrugeConnector existe lo usa:
			if(Yii::app()->getComponent('crugeconnector') != null){
				if(Yii::app()->crugeconnector->hasEnabledClients){
					?>
					<div class='crugeconnector'>
						<span><?php echo CrugeTranslator::t('logon', 'You also can login with');?>:</span>
						<ul>
							<?php
							$cc = Yii::app()->crugeconnector;
							foreach($cc->enabledClients as $key=>$config){
								$image = CHtml::image($cc->getClientDefaultImage($key));
								echo "<li>".CHtml::link($image,$cc->getClientLoginUrl($key))."</li>";
							}
							?>
						</ul>
					</div>
				<?php }} ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>
<?php endif; ?>
