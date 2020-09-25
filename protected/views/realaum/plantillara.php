<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/aframe.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/aframe-ar.js"></script>

<body style='margin : 0px; overflow: hidden;'>
    <a-scene embedded arjs>
        <a-entity scale=".03 .03 .03">
        <a-entity gltf-model="<?php echo Yii::app()->request->baseUrl.$realidadaumentada->ruta.$realidadaumentada->nra; ?>" scale=".1 .1 .1"  position = "0 0 0" crossOrigin="anonymous" animation="property: rotation; to: rotation 360 0; loop: true; dur: 10000"></a-entity>
        <a-marker-camera preset='hiro'></a-marker-camera>
        </a-entity>
    </a-scene>
</body>
