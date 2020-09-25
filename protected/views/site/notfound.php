<br>
<div class="valign-wrapper row">
	<div class="col s6 pull-m3 red darken-3">
		<p class="flow-text">ERROR AL MANIPULAR LA DATA!!<i class="medium material-icons right">error_outline</i></p>
	</div>
</div>
<script type="text/javascript">
	<?php if(Yii::app()->user->hasFlash('error')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'error',
				title: "<?php echo Yii::app()->user->getFlash('error')?>",
                //text: "<?php //echo Yii::app()->user->getFlash('error')?>",
				showConfirmButton: false,
				timer: 3500 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
