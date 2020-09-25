<?php
'components'=>array(
    'clientScript' => array(
        'scriptMap' => array(
            'jquery.js'=>false, //disable default implementation of jquery
            'jquery.min.js'=>false, //desable any others default implementation
            'core.css'=>false, //disable
            'styles.css'=>false, //disable
            'pager.css'=>false, //disable
            'default.css'=>false, //disable
        ),
        'packages' => array(
            'jquery'=>array(
                // set the new jquery
                'baseUrl'=>'bootstrap/',
                'js'=>array('js/jquery-1.7.2.min.js'),
            ),
            'bootstrap'=>array(//set others js libraries
                'baseUrl'=>'bootstrap/',
                'js'=>array('js/bootstrap.min.js'),
                'css'=>array(// and css
                    'css/bootstrap.min.css',
                    'css/custom.css',
                    'css/bootstrap-responsive.min.css'
                ),
                'depends'=>array('jquery'),// cause load jquery before load this.
            ),
        ),
    ),
),
?>

Fuente: https://www.iteramos.com/pregunta/10926/incluir-cssjavascript-en-yii-framework
