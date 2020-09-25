<?php
	/* formulario comun para create y update

		argumento:

		$model: instancia de CrugeAuthItemEditor
	*/
?>

<div class="valign-wrapper row">
    <div class="col s12">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'authitem-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
        )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row form-group">
        	<div class='row'>
                <div class="input-field col s12">
                    <?php echo $form->textField($model,'name',array('size'=>64,'maxlength'=>64, 'id' => 'iauthitem') ); ?>
                    <?php echo $form->labelEx($model,'name', array('id' => 'lauthitem') ); ?>
                    <?php echo $form->error($model,'name',array('class'=>'red-text darken-3')); ?>
                </div>
        	</div>
        	<div class='row'>
                <div class="input-field col s12">
                    <?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>100, 'id' => 'iauthitem') ); ?>
                    <?php echo $form->labelEx($model,'description', array('id' => 'lauthitem') ); ?>
                    <?php echo $form->error($model,'description',array('class'=>'red-text darken-3')); ?>
                </div>
                <?php if($model->categoria  == "tarea") { ?>
                    <div class='hint'>Tip: precede este valor con un ":" para que la tarea sea exportada como un menuitem al usar<br/> <span class='code'>
                        Yii::app()->user->rbac->getMenu();</span> y finalizala con un {nombremenuitem} para que quede dentro de un -nombremenuitem-.
                        ejemplo: <span class='code'>":Edita tu Perfil{menuprincipal}"</span>
                    </div>
                <?php } ?>
        	</div>
        	<div class='row'>
                <div class="input-field col s12">
                    <?php echo $form->textField($model,'businessRule',array('size'=>50,'maxlength'=>512, 'id' => 'iauthitem') ); ?>
                    <?php echo $form->labelEx($model,'businessRule', array('id' => 'lauthitem') ); ?>
                    <?php echo $form->error($model,'businessRule',array('class'=>'red-text darken-3')); ?>
                </div>
        		<p class='hint'>
        			<?php echo CrugeTranslator::t("Define una regla de negocio que sera ejecutada cada vez que este item sea evaluado mediante una llamada a checkAccess, el argumento params es entregado a checkAccess de forma opcional:"); ?>
        			<br/>
        			<?php echo CrugeTranslator::t("Regla de ejemplo:"); ?>
        			<br/>
        			<div class='code'>return Yii::app()->user->id==$params["post"]->authID;</div>
        			<br/>
        			<div class='code'>
        				$params = ...<?php echo CrugeTranslator::t("Cualquier cosa"); ?>...;<br/>
        				if(Yii::app()->user->checkAccess('<?php echo $model->name;?>', $params)){ ... }
        			</div>
        			<br/>
        		</p>
        	</div>

            <div class="center-align">
                <div class="center-left">
                    <div class="col s6">
                        <div class="btn waves-effect waves-ligh">
                            <?php Yii::app()->user->ui->tbutton(($model->isNewRecord ? 'Crear' : 'Actualizar')); ?>
                        </div>
                    </div>
                </div>

                <div class="center-right">
                    <div class="col s6">
                        <div class="btn waves-effect waves-ligh red accent-5">
                            <?php Yii::app()->user->ui->bbutton("Volver",'Cancelar'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
<?php $this->endWidget(); ?>
</div>
</div>
