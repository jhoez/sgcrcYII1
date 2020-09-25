<div id="snackbartoast" class="black-text"><?php echo Yii::app()->user->getFlash('librocreado')?></div>
<script type="text/javascript">
// SNACKBAR TOAST
	function snackbartoast() {
		var x = document.getElementById("snackbartoast");
		x.className = "showst";
		setTimeout(function(){
			x.className = x.className.replace("showst", "");
		}, 3000);
	}
	<?php if(Yii::app()->user->hasFlash('librocreado')){ ?>
			snackbartoast();
	<?php  } ?>
</script>
