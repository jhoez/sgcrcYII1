<?php
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipo-form',
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
    ),
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	echo $form->errorSummary(array(
		$estado,
		$municipio,
		$parroquia,
		$sedeciat,
		$insteduc,
		$representante,
		$estudiante,
		$niveleduc,
		$equipo,
		$fsoftware,
		$fpantalla,
		$ftarjetamadre,
		$fteclado,
		$fcarga,
		$fgeneral
	),null,null,array('class'=>'red-text darken-3'));

	$fecha = date( "Y-m-d",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA
	//$fecha = date( "Y-m-d h:i:s",time() );// OBTIENE HORA ACTUAL DE MI MAQUINA
	echo $form->hiddenField($equipo,'frecepcion',array('value' => $fecha));
	?>
	<!------------------------------------------------------------------------->
	<!-- DATOS DEL ESTADO MUNICIPIO PARROQUIA-->
	<h5 class="center-align">Dirección</h5>
	<div class="row">
		<?php echo $form->labelEx($estado,'idesta',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$estado,'idesta',
			CHtml::listData($estado::model()->findAll(),'idesta', 'nombest'),
			array(
				'prompt'=>'Seleccione Estado',
				'ajax' => array(
					'type' => 'POST',
					'url' => Yii::app()->controller->createUrl('equipo/muncall'),
					'update' => '#'.CHtml::activeId($municipio,'idmunc'),
					'beforeSend' => "function(){
						$('#Municipio_idmunc').find('option').remove();
						$('#Parroquia_idpar').find('option').remove();
					}",
				)
			)
		);?>
		<?php echo $form->error($estado,'idesta',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($municipio,'idmunc',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$municipio,'idmunc',
			CHtml::listData($municipio::model()->findAll(),'idmunc', 'municipio'),
			array(
				'prompt'=>'Seleccione Municipio',
				'ajax' => array(
					'type' => 'POST',
					'url' => Yii::app()->controller->createUrl('equipo/parrall'),
					'update' => '#'.CHtml::activeId($parroquia,'idpar'),
					'beforeSend' => "function(){
						$('#Parroquia_idpar').find('option').remove();
					}",
				)
			)
		);?>
		<?php echo $form->error($municipio,'idmunc',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($parroquia,'idpar',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$parroquia,'idpar',
			CHtml::listData($parroquia::model()->findAll(),'idpar', 'parroquia'),
			array('prompt'=>'Seleccione Parroquia')
		);?>
		<?php echo $form->error($parroquia,'idpar',array('class'=>'red-text darken-3')); ?>
	</div>

	<h5 class="center-align">Institutos</h5>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($sedeciat,'sede',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->labelEx($sedeciat,'sede'/*,array('class'=>'black-text')*/); ?>
		</div>
		<?php echo $form->error($sedeciat,'sede',array('class'=>'red-text darken-3')); ?>
	</div>

	<!------------------------------------------------------------------------->
	<!-- DATOS DEL INSTITUTO -->
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($insteduc,'nombinst',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->labelEx($insteduc,'nombinst'); ?>
		</div>
		<?php echo $form->error($insteduc,'nombinst',array('class'=>'red-text darken-3')); ?>
	</div>

	<!------------------------------------------------------------------------->
	<!-- DATOS DEL REPRESENTATE -->
	<h5 class="center-align">Representante o Docente</h5>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($representante,'nombre',array('size'=>50,'maxlength'=>50, 'onkeypress'=>'js:return soloLetras(event)', 'onblur'=>'js:limpiaNumeros()')); ?>
			<?php echo $form->labelEx($representante,'nombre'); ?>
		</div>
		<?php echo $form->error($representante,'nombre',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($representante,'cedula',array('size'=>8,'maxlength'=>8)); ?>
			<?php echo $form->labelEx($representante,'cedula'); ?>
		</div>
		<?php echo $form->error($representante,'cedula',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($representante,'telf',array('size'=>12,'maxlength'=>12)); ?>
			<?php echo $form->labelEx($representante,'telf'); ?>
		</div>
		<?php echo $form->error($representante,'telf',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($representante,'docente',array('class'=>'black-text')); ?>
		<div class="switch">
			<label>
				No
				<?php echo $form->checkBox($representante,'docente'/*,array('checked'=>'checked')*/); ?>
				<span class="lever"></span>
				Si
			</label>
		</div>
		<?php echo $form->error($representante,'docente',array('class'=>'red-text darken-3')); ?>
	</div>

	<!-- DATOS DEL ESTUDIANTE -->
	<h5 class="center-align">Estudiante</h5>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($estudiante,'nombestu',array('size'=>60,'maxlength'=>255, 'onkeypress'=>'js:return soloLetras(event)', 'onblur'=>'js:limpiaNumeros()')); ?>
			<?php echo $form->labelEx($estudiante,'nombestu'); ?>
		</div>
		<?php echo $form->error($estudiante,'nombestu',array('class'=>'red-text darken-3')); ?>
	</div>
	<!------------------------------------------------------------------------->
	<!-- NIVEL EDUCATIVO -->
	<div class="row">
		<?php echo $form->labelEx($niveleduc,'nivel',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$niveleduc,'nivel',
			array(
				'primero'	=>	'primero',
				'segundo'	=>	'segundo',
				'tercero'	=>	'tercero',
				'cuarto'	=>	'cuarto',
				'quinto'	=>	'quinto',
				'sexto'		=>	'sexto',
				'1er año'	=>	'1er año',
				'2do año'	=>	'2do año',
				'3er año'	=>	'3er año',
				'4to año'	=>	'4to año',
				'5to año'	=>	'5to año',
				'6to año'	=>	'6to año',
			),
			array(
				'prompt'=>'Seleccione Nivel',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		); ?>
		<?php echo $form->error($niveleduc,'nivel',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($niveleduc,'graduado',array('class'=>'black-text')); ?>
		<div class="switch">
			<label>
				No
				<?php echo $form->checkBox($niveleduc,'graduado'/*,array('checked'=>'checked')*/); ?>
				<span class="lever"></span>
				Si
			</label>
		</div>
		<?php echo $form->error($niveleduc,'graduado',array('class'=>'red-text darken-3')); ?>
	</div>
	<!------------------------------------------------------------------------->
	<!-- DATOS DEL EQUIPO -->
	<h5 class="center-align">Datos del Equipo</h5>
	<div class="row">
		<?php echo $form->labelEx($equipo,'eqversion',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$equipo,'eqversion',
			array(
				'V1'		=> 'V1',
				'V2'		=> 'V2',
				'V3'		=> 'V3',
				'V4'		=> 'V4',
				'V5'		=> 'V5',
				'V6'		=> 'V6',
				'Tablet'	=> 'Tablet',
			),
			array(
				'prompt'=>'Seleccione Version del Equipo',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		); ?>
		<?php echo $form->error($equipo,'eqversion',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<div class="input-field">
			<?php echo $form->textField($equipo,'eqserial',array('maxlength'=>125)); ?>
			<?php echo $form->labelEx($equipo,'eqserial'); ?>
		</div>
		<?php echo $form->error($equipo,'eqserial',array('class'=>'red-text darken-3')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($equipo,'eqstatus',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$equipo,'eqstatus',
			array(
				'operativo'		=>	'Operativo',
				'inoperativo'	=>	'Inoperativo'
			),
			array(
				'prompt'=>'Seleccione Status del Equipo',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		); ?>
		<?php echo $form->error($equipo,'eqstatus',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textArea($equipo,'diagnostico',array('class'=>'materialize-textarea')); ?>
			<?php echo $form->labelEx($equipo,'diagnostico'); ?>
		</div>
		<?php echo $form->error($equipo,'diagnostico',array('class'=>'red-text darken-3')); ?>
	</div>

	<div class="row">
		<div class="input-field">
			<?php echo $form->textArea($equipo,'observacion',array(/*'placeholder'=>'Observación acerca del Equipo recibido',*/ 'class'=>'materialize-textarea')); ?>
			<?php echo $form->labelEx($equipo,'observacion'); ?>
		</div>
		<?php echo $form->error($equipo,'observacion',array('class'=>'red-text darken-3')); ?>
	</div>
	<!------------------------------------------------------------------------->
	<!-- FALLA DE SOFTWARE -->
	<h5 class="center-align">Fallas del Equipo</h5>
	<div class="row">
		<?php echo $form->labelEx($fsoftware,'fsoft',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$fsoftware,'fsoft',
			array(
				'Actualizacion'		=> 'Actualizacion',
				'Posee windows'		=> 'Posee windows',
				'No carga el S.O'	=> 'No carga el S.O',
				'Revisar disco'		=> 'Revisar disco',
				'Grub rescue'		=> 'Grub rescue',
			),
			array(
				'prompt'=>'Seleccione Falla de software',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		); ?>
		<?php echo $form->error($fsoftware,'fsoft',array('class'=>'red-text darken-3')); ?>
	</div>
	<!-- FALLA DE PANTALLA -->
	<div class="row">
		<?php echo $form->labelEx($fpantalla,'fpant',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$fpantalla,'fpant',
			array(
				'Pantalla partida'						=> 'Pantalla partida',
				'Pixelada'								=> 'Pixelada',
				'Pantalla despegada'					=> 'Pantalla despegada',
				'Pantalla de cristal líquido dañada'	=> 'Pantalla de cristal líquido dañada',
				'Flex dañado'							=> 'Flex dañado'
			),
			array(
				'prompt'=>'Seleccione Falla de pantalla',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		);?>
		<?php echo $form->error($fpantalla,'fpant',array('class'=>'red-text darken-3')); ?>
	</div>
	<!-- FALLA DE TARJETAMADRE -->
	<div class="row">
		<?php echo $form->labelEx($ftarjetamadre,'ftarj',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$ftarjetamadre,'ftarj',
			array(
				'Procesador dañado'			=> 'Procesador dañado',
				'Tarj de video dañada'		=> 'Tarj de video dañada',
				'Tarj de red dañada'		=> 'Tarj de red dañada',
				'Tarj de sonido dañada'		=> 'Tarj de sonido dañada',
				'Pila de bios'				=> 'Pila de bios',
				'Configuracion del bios'	=> 'Configuracion del bios',
				'Bios bloqueada'			=> 'Bios bloqueada',
				'Corto circuito'			=> 'Corto circuito',
				'Procesador dañado'			=> 'Procesador dañado'
			),
			array(
				'prompt'=>'Seleccione Falla de tarjeta madre',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		);?>
		<?php echo $form->error($ftarjetamadre,'ftarj',array('class'=>'red-text darken-3')); ?>
	</div>
	<!-- FALLA DE TECLADO -->
	<div class="row">
		<?php echo $form->labelEx($fteclado,'ftec',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$fteclado,'ftec',
			array(
				'Teclado dañado'	=> 'Teclado dañado',
				'Faltan teclas'		=> 'Faltan teclas',
				'No marcan teclas'	=> 'No marcan teclas'
			),
			array(
				'prompt'=>'Seleccione Falla del teclado',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		);?>
		<?php echo $form->error($fteclado,'ftec',array('class'=>'red-text darken-3')); ?>
	</div>
	<!-- FALLA DE CARGA -->
	<div class="row">
		<?php echo $form->labelEx($fcarga,'fcarg',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$fcarga,'fcarg',
			array(
				'Pin de carga'		=> 'Pin de carga',
				'Bateria dañada'	=> 'Bateria dañada',
				'Cargador dañado'	=> 'Cargador dañado'
			),
			array(
				'prompt'=>'Seleccione Falla de carga',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		);?>
		<?php echo $form->error($fcarga,'fcarg',array('class'=>'red-text darken-3')); ?>
	</div>
	<!-- FALLA GENERAL -->
	<div class="row">
		<?php echo $form->labelEx($fgeneral,'fgen',array('class'=>'black-text')); ?>
		<?php echo $form->dropDownList(
			$fgeneral,'fgen',
			array(
				'Mouse dañado'				=> 'Mouse dañado',
				'Disco duro dañado'			=> 'Disco duro dañado',
				'Momoria ram dañada'		=> 'Momoria ram dañada',
				'Fan cooler dañado'			=> 'Fan cooler dañado',
				'Boton encendido dañado'	=> 'Boton encendido dañado',
				'Camara dañada'				=> 'Camara dañada',
				'Equipo inoperativo'		=> 'Equipo inoperativo'
			),
			array(
				'prompt'=>'Seleccione Falla general',
				'options' => array('Seleccione'=>array('selected'=>true)),
				'class'=>'browser-default'
			)
		);?>
		<?php echo $form->error($fgeneral,'fgen',array('class'=>'red-text darken-3')); ?>
	</div>

	<!-- BOTONES NEXT AND PREVIEW
	<div class="">
		<?php //echo CHtml::htmlButton('Ant',array('id' => 'prevBtn','onclick'=>'nextPrev(-1)')); ?>
		<?php //echo CHtml::htmlButton('Sig',array('id' => 'nextBtn','onclick'=>'nextPrev(1)')); ?>
	</div>
	-->

	<div class="center-align">
		<div class="center-left">
			<div class="col s6">
				<div class="btn waves-effect waves-ligh">
					<?php echo CHtml::submitButton(
						$equipo->isNewRecord ? 'Registrar' : 'Actualizar',
						array(
							'class' => 'white-text',
                            //'onclick'=>"this.disabled=true; value='enviando'; this.form.submit();"
						)
					); ?>
					<i class="material-icons right">laptop</i>
				</div>
			</div>
		</div>

		<div class="center-right">
			<div class="col s6">
				<div class="btn waves-effect waves-ligh red accent-5">
					<?php echo CHtml::Button('Cancelar', array('class'=>'white-text','onclick' => 'js:document.location.href="../equipo/index"'));// button con link array('onclick' => 'js:document.location.href="controller/action"') ?>
					<i class="material-icons right">cancel</i>
				</div>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
