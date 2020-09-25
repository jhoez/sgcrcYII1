<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'theme'=>'classic',
	'name'=>'SGCEI',
	//'defaultController' => 'site/login',

	// preloading 'log' component
	//'preload'=>array('log','booster'),
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.controllers.*',
		'application.models.*',
		'application.components.*',
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
		'application.extensions.mediaElement.*',
		'application.extensions.evfeplayer.*',
		'application.extensions.videojs.*'
	),

	'timeZone' => 'America/Caracas',

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		// CRUGE
		'cruge'=>array(
			'superuserName'=>'jhon',
			'tableprefix'=>'sc.cruge_',
			// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php

			// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
			// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
			'availableAuthMethods'=>array('default'),
			'availableAuthModes'=>array('username','email'),
			// url base para los links de activacion de cuenta de usuario
			'baseUrl'=>'http://localhost/sgci/',
			// NO OLVIDES PONER EN FALSE TRAS INSTALAR
			'debug'=>false,
			'rbacSetupEnabled'=>true,
			'allowUserAlways'=>false,
			// MIENTRAS INSTALAS..PONLO EN: false
			// lee mas abajo respecto a 'Encriptando las claves'
			'useEncryptedPassword' => false, //esto va en TRUE en producción para que guarde las claves en md5
			// Algoritmo de la función hash que deseas usar
			// Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
			'hash' => 'md5',

			// a donde enviar al usuario tras iniciar sesion, cerrar sesion o al expirar la sesion.
			//
			// esto va a forzar a Yii::app()-eqversion>user->returnUrl cambiando el comportamiento estandar de Yii
			// en los casos en que se usa CAccessControl como controlador
			//
			// ejemplo:
			//		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
			//		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
			//
			'afterLoginUrl'=>array('/site/index'),
			'afterLogoutUrl'=>array('/site/logout'),
			//'afterSessionExpiredUrl'=>array('/cruge/ui/login'),
			'afterSessionExpiredUrl'=>array('/site/index'),
			// manejo del layout con cruge.
			'loginLayout'=>'//layouts/column2',
			'registrationLayout'=>'//layouts/column2',
			'activateAccountLayout'=>'//layouts/column2',
			'editProfileLayout'=>'//layouts/column2',
			// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
			// de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
			// requerirá de un portlet para desplegar un menu con las opciones de administrador.
			'generalUserManagementLayout'=>'ui',
			// permite indicar un array con los nombres de campos personalizados,
			// incluyendo username y/o email para personalizar la respuesta de una consulta a:
			// $usuario->getUserDescription();
			'userDescriptionFieldsArray'=>array('email'),
		),
	),

	// application components
	'components'=>array(
		/*'widgetFactory'=>array(
			'widgets'=>array(
				'CLinkPager'=>array(
					'maxButtonCount'=>5,
					'cssFile'=>false,
					'header'=>false,
				),
			),
		),*/
		/*'clientScript' => array(
	        'scriptMap' => array(
	            //'jquery.js'=>false, //disable default implementation of jquery
	            //'jquery.min.js'=>false, //desable any others default implementation
	            //'core.css'=>false, //disable
	            //'styles.css'=>false, //disable
	            //'pager.css'=>false, //disable
	            //'default.css'=>false, //disable
	        ),
			'packages' => array(
	            'jquery'=>array(// set the new jquery
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
	    ),*/
		'user'=>array(
			'allowAutoLogin'=>true,
			'class' => 'application.modules.cruge.components.CrugeWebUser',
			'loginUrl' => array('/cruge/ui/login'),
		),
		'authManager' => array(
			'class' => 'application.modules.cruge.components.CrugeAuthManager',
		),
		'crugemailer'=>array(
			'class' => 'application.modules.cruge.components.CrugeMailer',
			'mailfrom' => 'jhoezrr@gmail.com',
			'subjectprefix' => 'Tu Encabezado del asunto - ',
			'debug' => true,
		),
		'format' => array(
			//'datetimeFormat'=>"d M, Y h:m:s a",
			'datetimeFormat'=>"Y-M-d h:i:s",
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			//'urlSuffix'=>'.jsp',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',// si falla el primer parametro saltamos a la primera regla
				'<controller:\w+>/<action:\w+>/<id:\d+>/<id2:\w*[a-zA-Z0-9\-]*>'=>'<controller>/<action>',// si falla el tercer parametro saltamos a la siguiente regla
				'<controller:\w+>/<action:\w+>/<id:\d+>/<id2>'=>'<controller>/<action>',// si falla el segundo parametro saltamos a la siguiente regla
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db' => array(
            'connectionString' => 'pgsql:host=localhost;port=5432;dbname=SGL',
            'username' => 'postgres',
            'password' => 'indio765',
            'charset' => 'utf8'
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		// COMOPONENTE PARA PDF
		'ePdf' => array(
			'class'		=> 'ext.yii-pdf.EYiiPdf',
			'params'	=> array(
				'mpdf' => array(
					'librarySourcePath' => 'application.vendor.mpdf.src.*',
					'constants' => array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'Mpdf',
					'defaultParams' => array(
						//'mode' => '', //  This parameter specifies the mode of the new document.
						//'format' => 'A4',	// format A4, A5, ...
					),
				),
	            'HTML2PDF' => array(
	                'librarySourcePath' => 'application.vendor.html2pdf.*',
	                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
	                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
	                    'orientation' => 'P', // landscape or portrait orientation
	                    'format'      => 'A4', // format A4, A5, ...
	                    'language'    => 'es', // language: fr, en, it ...
	                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
	                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
	                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
	                )*/
	            )
	        ),
	    ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'jhoezrr@gmail.com',
	),
	'language' => 'es'
);
