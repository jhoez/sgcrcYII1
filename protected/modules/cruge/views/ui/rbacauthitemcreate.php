<?php
	/*
		$model:  es una instancia que implementa a CrugeAuthItemEditor
	*/

?>
<h4 class="center-align"><?php echo ucwords(CrugeTranslator::t("creando")." ".CrugeTranslator::t($model->categoria));?></h4>
<?php $this->renderPartial('_authitemform',array('model'=>$model),false);?>
