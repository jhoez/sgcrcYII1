<?php
/* @var $this LibrosController */
/* @var $data Libros */
//echo "<pre>";var_dump($libros[0]['nivel']);die;
?>
<div class="divider"></div>

<div class="row">
	<h4 class="center">Coleccion Bicentenaria Media</h4>
	<?php foreach ($libros as $value) { ?>
		    <?php if($value->nivel == 'media'){	?>
		        <div class="col m3">
		            <div class="card">
		                <div class="card-image">
		                    <?php
		                        echo CHtml::image(Yii::app()->baseUrl.$value->libimg->ruta.$value->libimg->nombimg, 'banner', array('id' => ''));
		                    ?>
		                </div>
		                <div class="card-content">
		                    <p class="center-align" style="overflow:hidden; font-size:14px;">
		                        <?php echo CHtml::encode($value->nomblib);?>
		                    </p>
		                </div>
		                <div class="card-action">
							<?php echo CHtml::link(
								"ver Libro",
								array("/libros/viewpdf"),
								array(
									'submit'=>array("/libros/viewpdf"),
									'params'=>array('p'=>"$value->idlib"),//no es necesario
									'target'=>'_blank',
									//'id'=>'btnpdfs',
									'class'=>'green-text'
								)
							);?>
		                </div>
		            </div>
		        </div>
		    <?php }	?>
	<?php } ?>
</div>
