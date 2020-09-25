<?php
/* @var $this LibrosController */
/* @var $libros Libros */
/* @var $form CActiveForm */
//var_dump(Yii::app()->user->getId(),Yii::app()->user->getName());
?>

<div class="valign-wrapper row">
<div class="col s10 pull-l3 l6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'libros-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	"enableClientValidation"=>true,
    "clientOptions"=>array(
        "validateOnSubmit"=>true,
        //"validateOnChange"=>true,
        //"validateOnType"=>true
    ),
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php
	echo $form->errorSummary(array($libros,$img));
	?>

	<?php if(!$libros->isNewRecord){
		$select = array(
			'prompt'=> 'Seleccione colección',
			'options' => array('Seleccione'=>array('selected'=>true)),
			'class'=>'browser-default'
		);
	}else {
		$select = array(
			'prompt'=> 'Seleccione colección',
			'options' => array('Seleccione'=>array('selected'=>true)),
			'onchange' => 'js:obtenerValorForUpdate()',
			'class'=>'browser-default'
		);
	} ?>

	<div class="row">
	    <div class="col s12">
	        <?php echo $form->labelEx($libros,'coleccion',array('class'=>'black-text')); ?>
	        <?php echo $form->dropDownList(
	            $libros,'coleccion',
	            array(
	                'coleccionBicentenaria'		=>	'Coleccion Bicentenaria',
	                'coleccionMaestros'			=>	'Coleccion Maestro',
	                'lectura'					=>	'Lectura Sugerida'
	            ),
				$select
	        ); ?>
	        <?php echo $form->error($libros,'coleccion',array('class'=>'red-text darken-3')); ?>
	    </div>
	</div>

	<div class="row" id="selectlist" style="display:none">
	    <div class="col s12">
	        <?php echo $form->labelEx($libros,'nivel',array('class'=>'black-text')); ?>
	        <?php echo $form->dropDownList(
	            $libros,'nivel',
	            array(
	                'inicial'	=>	'Inicial',
	                'primaria'	=>	'Primaria',
	                'media'		=>	'Media'
	            ),
	            array(
	                'prompt'=>'Seleccione nivel',
	                'options' => array('Seleccione'=>array('selected'=>true)),
	                'class'=>'browser-default'
	            )
	        ); ?>
	        <?php echo $form->error($libros,'nivel',array('class'=>'red-text darken-3')); ?>
	    </div>
	</div>

	<!-- IMAGEN -->
	<div class="row">
		<div class="col s12">
			<?php echo $form->labelEx($img,'imagen',array('class'=>'black-text')); ?>
			<?php	if (!$img->isNewRecord) {?>
				<div class="row">
						<?php echo "Portada a ser reemplazada: " . $img->nombimg;?>
				</div>
			<?php } ?>
			<div class="file-field input-field">
				<div class="btn">
					<span>Imagen png</span>
					<?php echo $form->FileField($img,'imagen'); ?>
					<i class="material-icons right">file_upload</i>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Nombre de imagen">
					<?php echo $form->error($img,'imagen',array('class'=>'red-text darken-3')); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- ARCHIVO PDF -->
	<div class="row">
		<div class="col s12">
			<?php echo $form->labelEx($libros,'files',array('class'=>'black-text')); ?>
			<?php	if (!$img->isNewRecord) {?>
				<div class="row">
						<?php	echo "Libro a ser reemplazado: " . $libros->nomblib;?>
				</div>
			<?php } ?>
			<div class="file-field input-field">
				<div class="btn">
					<span>Archivo PDF</span>
					<?php echo $form->FileField($libros,'files'); ?>
					<i class="material-icons right">file_upload</i>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Nombre del archivo">
				</div>
			</div>
			<?php echo $form->error($libros,'files',array('class'=>'red-text darken-3')); ?>
		</div>
	</div>
	<div class="row center-align">
		<div class="col s12">
			<div class="btn waves-effect waves-ligh">
				<?php echo CHtml::submitButton($libros->isNewRecord ? 'Subir Archivo' : 'Actualizar', array('class'=>'white-text') ); ?>
				<i class="material-icons right">send</i>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>

<script type="text/javascript">
	function obtenerValorForUpdate(){
		var select = document.getElementById('Libros_coleccion');
		var valor = select.options[select.selectedIndex].value;
		//alert(valor);
		//var valor = select.options[select.selectedIndex].innerText;// devuelve la opción del select no el valor
		if (valor == 'coleccionBicentenaria') {
			document.getElementById('selectlist').style.display = 'block';
		}else {
			document.getElementById('selectlist').style.display = 'none';
		}
	}

	window.addEventListener('load',function(){
		var select = document.getElementById('Libros_coleccion');
		var valor = select.options[select.selectedIndex].value;
		//alert(valor);
		//var valor = select.options[select.selectedIndex].innerText;// devuelve la opción del select no el valor
		if (valor == 'coleccionBicentenaria') {
			document.getElementById('selectlist').style.display = 'block';
		}else {
			document.getElementById('selectlist').style.display = 'none';
		}
	});

	<?php if(Yii::app()->user->hasFlash('notfound')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'error',
				title: "<?php echo Yii::app()->user->getFlash('notfound')?>",
				showConfirmButton: false,
				timer: 3000 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
