<?php
/* @var $this MultimediaController */
/* @var $multimedia Multimedia */
?>

<h4 class="center">Audioradiales</h4>
	<div class="row">
		<div class="col m12">
			<?php
			foreach ($multimedia as $value) {
				if ($value->tipomult == 'audio') {
			?>
				<div class="col s6">
					<?php
					$this->widget('ext.mediaElement.MediaElementPortlet',array(
						'model' => $value,
						'url' => Yii::app()->request->baseUrl.$value->ruta.$value->nombmult,
						'mimeType' =>'audio/mp3',
						'autoplay'=>false,
					));
					?>
					<div class="center-align">
						<?php
						$image = CHtml::image(Yii::app()->baseUrl."/fonts/download.svg", 'link', array('title'=>'Descargar'));
						echo CHtml::link(
							"Descargar ". $image,
							array('/multimedia/descargar'),
							array(
								'submit'=>array('/multimedia/descargar'),
								'params'=>array('m'=>$value->idmult),//no es necesario
								'target'=>'_blank',
								//'id'=>'btnpdfs',
								'class'=>'green-text'
							)
						);?>
					</div>
					<div class="center-left">
						<p><?php echo "<a class='blue-text'>Nombre del Proyecto: </a>" . CHtml::encode($value->multpro->nombpro);?></p>
						<p><?php echo "<a class='blue-text'>Creador: </a>" . CHtml::encode($value->multpro->creador);?></p>
						<p><?php echo "<a class='blue-text'>Audio: </a>" . CHtml::encode($value->nombmult); ?></p>
					</div>
				</div>
			<?php
				}
			}
			?>
		</div>
	</div>
