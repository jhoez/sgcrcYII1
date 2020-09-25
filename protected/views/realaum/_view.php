<?php
/* @var $this RealaumController */
/* @var $data Realaum */
?>

<div class="col s12 m3">
	<div class="card">
		<div class="card-image">
			<?php
			echo CHtml::image(Yii::app()->baseUrl.$data->raimag->ruta.$data->raimag->nombimg, 'banner', array('' => ''));
			?>
		</div>
		<div class="card-content">
			<div class="center-align" style="overflow:hidden;">
				<p><?php echo "<a class='blue-text'>Nombre del Proyecto: </a>".CHtml::encode($data->rapro->nombpro);?></p>
				<p><?php echo "<a class='blue-text'>Creador: </a>".CHtml::encode($data->rapro->creador);?></p>
			</div>
		</div>
		<div class="card-action">
			<?php echo CHtml::link(
				"ver Realidad Aumentada",
				array(
					'realaum/verra',
					'id'=>$data->idra
				),
				array('target'=>'_blank','class'=>'')
			); ?>
		</div>
	</div>
</div>
