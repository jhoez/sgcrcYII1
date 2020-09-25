<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>

<div class="row">
    <h4 class="row center-align">Fundabit Distrito Capital</h4>
    <div class="col s12 l8">
        <div class="carousel carousel-slider">
            <?php foreach($imagen as $value) { ?>
                <a class="carousel-item" href="#one!">
                    <?php echo CHtml::image(Yii::app()->request->baseUrl.$value->ruta.$value->nombimg,'carousel'); ?>
                </a>
            <?php } ?>
        </div>
        <h5 class="black-text">
            Fundación Bolivariana de Informática y Telemática,
            ente adscrito al MPPE Impulsamos las políticas del
            Sistema Educativo Nacional a través del uso de las TIC.
        </h5>
    </div>
    <div class="col s12 l4">
        <a class="twitter-timeline" href="https://twitter.com/FundabitOficial" data-widget-id="302069386464870402">Tweets por @FundabitOficial</a>
    </div>
</div>

<script type="text/javascript">
// twitter
document.addEventListener('DOMContentLoaded', function() {
    !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0];
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;
            js.src="//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document,"script","twitter-wjs");
});

/********************************
            CAROUSEL
********************************/
document.addEventListener('DOMContentLoaded', function() {
    var elem = document.querySelector('.carousel');
    var instance = M.Carousel.init(elem,{
        indicators: true,
        duration: 300,
    });

    setInterval(()=>{
      //console.log(instance.pressed);
      if(!instance.pressed){
        instance.next();
      }
  },4500);
});

</script>
