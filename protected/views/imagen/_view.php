<?php
/* @var $this ImagenController */
/* @var $data Imagen */
?>

<div class="col s12 m3">
	<div class="card">
		<div class="card-image">
			<?php
			echo CHtml::image(Yii::app()->baseUrl.$data->ruta.$data->nombimg, 'banner', array(''=>''));
			?>
		</div>
		<div class="card-content">
			<p class="center-align" style="overflow:hidden;">
				<?php echo CHtml::encode($data->nombimg);?>
			</p>
		</div>
	</div>
</div>
