<?php
/* @var $this AsistenciaController */
/* @var $asistencia Asistencia */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asistencia-form',
	"enableClientValidation"=>true,
	"clientOptions"=>array(
        "validateOnSubmit"=>true,
    ),
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	var_dump( date( "h:i:s", time() ) );
	echo $form->errorSummary(array($asistencia),null,null,array('class'=>'red-text darken-3'));
	$hora	= date("h:i:s",time());// OBTIENE HORA ACTUAL DE MI MAQUINA

	if ( $hora >= $this->horaE && $hora <= $this->horaS ) {
		echo $form->hiddenField($asistencia,'horain',array('value' => $hora));
	}elseif ( $hora >= $this->horaS ) {
		echo $form->hiddenField($asistencia,'horaout',array('value' => $hora));
	}
	?>

	<?php if ($hora >= $this->horaS): ?>
		<div class="row">
			<?php echo $form->labelEx($asistencia,'observacion',array('class'=>'black-text')); ?>
			<?php echo $form->textArea($asistencia,'observacion',array('size'=>60,'maxlength'=>255,'placeholder'=>'Observación','class'=>'materialize-textarea')); ?>
			<?php echo $form->error($asistencia,'observacion',array('class'=>'red-text darken-3')); ?>
		</div>
	<?php endif; ?>

	<div class="center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php
					if ( $hora >= $this->horaE && $hora <= $this->horaS ) {
						echo CHtml::submitButton($asistencia->isNewRecord ? 'registrar entrada' : 'Actualizar',array('class' => 'white-text') );
						echo "<i class='material-icons right'>send</i>";
					}elseif ( $hora >= $this->horaS ) {
						echo CHtml::link(
                            "registrar salida <i class='small material-icons right'>send</i>",
                            array("/asistencia/marcarSalida"),
                            array(
                                'submit'=>array("/asistencia/marcarSalida"),
                                //'params'=>array('frecepcion'=>'$equipo->frecepcion','fentrega'=>'$equipo->fentrega'),//no es necesario
                                //'target'=>'_blank',
                                //'id'=>'btnpdfs',
                                'class'=>'white-text'
                            )
                        );
					}
				?>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>

<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('nma')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'success',
				title: "<?php echo Yii::app()->user->getFlash('nma')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
