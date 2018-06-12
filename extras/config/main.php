<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cancelomideuda.com',
    'language'=>'es',
    'sourceLanguage'=>'es',
    'charset'=>'utf-8',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
	    'application.components.*',
	    'application.modules.cruge.components.*',
	    'application.modules.cruge.extensions.crugemailer.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	    'cruge'=>array(
    	        'tableprefix'=>'cruge_',
    	        // para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
    	        //
    	        // en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
    	        // para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDe
    	        //
    	        'availableAuthMethods'=>array('default'),
    	        'availableAuthModes'=>array('username','email'),
    	        // url base para los links de activacion de cuenta de usuario
    	        'baseUrl'=>'http://localhost/',
    	        // NO OLVIDES PONER EN FALSE TRAS INSTALAR
    	        'debug'=>false,
    	        'rbacSetupEnabled'=>true,
    	        'allowUserAlways'=>false,
    	        // MIENTRAS INSTALAS..PONLO EN: false
    	        // lee mas abajo respecto a 'Encriptando las claves'
    	        //
    	        'useEncryptedPassword' => true,
    	        // Algoritmo de la función hash que deseas usar
    	        // Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
    	        'hash' => 'sha512',
    	        // Estos tres atributos controlan la redirección del usuario. Solo serán son usados si no
    	        // hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un filtr
    	        // lee en la wiki acerca de:
    	        // "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
    	        //
    	        // ejemplo:
    	        // 'afterLoginUrl'=>array('/site/welcome'), ( !!! no olvidar el slash inici
    	        // 'afterLogoutUrl'=>array('/site/page','view'=>'about'),
    	        //
    	    'afterLoginUrl'=>array('/site/index'),
    	    'afterLogoutUrl'=>array('/site/login'),
    	    'afterSessionExpiredUrl'=>array('/site/login'),
    	    // manejo del layout con cruge.
    	    //
    	    'loginLayout'=>'//layouts/main',
    	    'registrationLayout'=>'//layouts/columnadminnew',
    	    'activateAccountLayout'=>'//layouts/columnadminnew',
    	    'editProfileLayout'=>'//layouts/columnadminnew',
    	    // en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
    	    // de fabrica, es basico pero funcional. si pones otro valor considera que cruge
    	    // requerirá de un portlet para desplegar un menu con las opciones de administrador.
    	    //
    	    'generalUserManagementLayout'=>'ui',
    	    // permite indicar un array con los nombres de campos personalizados,
    	    // incluyendo username y/o email para personalizar la respuesta de una consulta a:
    	    // $usuario->getUserDescription();
    	    'userDescriptionFieldsArray'=>array('email'),
    	),
	),

	// application components
	'components'=>array(

	    
	    'user'=>array(
	        'allowAutoLogin'=>true,
	        'class' => 'application.modules.cruge.components.CrugeWebUser',
	        'loginUrl' => array('/site/login'),
	    ),
	    'authManager' => array(
	        'class' => 'application.modules.cruge.components.CrugeAuthManager',
	    ),
	    'crugemailer'=>array(
	        'class' => 'application.modules.cruge.components.CrugeMailer',
	        'mailfrom' => 'edwin.zapata@contactogarantido.com',
	        'subjectprefix' => 'Tu Encabezado del asunto - ',
	        'debug' => true,
	    ),
	    'datosmailer'=>array(
	        'class' => 'application.components.CanceloCrugeMailer',
	    ),
	    'format' => array(
	        'datetimeFormat'=>"d M, Y h:m:s a",
	    ),
	    'urlManager'=>array(
	        'urlFormat'=>'path',
	        'showScriptName'=>false,
	        'caseSensitive'=>true,
	    ),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	    'webRoot' => dirname(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'),
	),
);
