<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php if (!Yii::app()->user->isGuest): ?>
	<div class="s2" style="height:56px;">
		<div class="action-btn-wrapper">
			<div class="fixed-action-btn my-custom-btn horizontal">
				<?php if (!Yii::app()->user->isGuest): ?>
					<a class="btn-floating btn-large cyan"><i class="small material-icons">menu</i></a>
					<?php $this->widget('zii.widgets.CMenu', array(
						'id' => '',
						'encodeLabel'=>false,
						'items'=>$this->menu,
						//'htmlOptions'=>array('class'=>''),
					));?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
