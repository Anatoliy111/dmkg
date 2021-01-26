<?php

	use kartik\grid\GridView;
	use kartik\mpdf\Pdf;

	$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
	'homeUrl' => '/',
    'id' => 'app',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
	'aliases' => [
		'@poslug' => $webroot . '/app/poslug',
	],
    'language' => 'uk-UA',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'd3nJy8BE2jOgBK3yTQtr0KZ3xm04n-mS',
        ],
//        'user' => [
//            'identityClass' => 'app\models\UserIdentity',
//			'enableAutoLogin'=> true,
//        ],
		'cache' => [
			'class' => 'yii\caching\FileCache',

		],
		'parsers' => [
			'application/json' => 'yii\web\JsonParser'
		],
//		'users' => [
//			'class' => 'yii\web\User',
//			'identityClass' => 'app\models\SearchUtKart',
//			'enableAutoLogin' => true,
//			'authTimeout' => 86400,
//		],
		'pdf' => [
			'class' => Pdf::classname(),
			'format' => Pdf::FORMAT_A4,
			'orientation' => Pdf::ORIENT_PORTRAIT,
			'destination' => Pdf::DEST_BROWSER,
			// refer settings section for all configuration options
		],
		'formatter' => [
			'dateFormat' => 'MM.yyyy',
			'thousandSeparator' => ' ',
			'decimalSeparator' => ',',
			],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'urlManager' => [
//			'enablePrettyUrl' => true,
//			'showScriptName' => false,
            'rules' => [
//				'ut-kart/<uri>' => 'ut-kart/kabinet',
//				'ut-kart/<kabinet:[-_a-z]+>_<id:\d+>'=>'ut-kart/kabinet',
//				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
				'<controller:\w+>/kabinet/<id:[\w-]+>' => '<controller>/kabinet',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//				'<controller:\w+>/kabinet/<action:\w+>' => '<controller>/kabinet',
                '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
				'poslug/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>',
				'poslug/:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>'
            ],
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [YII_DEBUG ? 'jquery.js' : 'jquery.min.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
				[
					'class' => 'yii\log\FileTarget', //в файл
					'categories' => ['payment_fail'], //категория логов
					'logFile' => '@runtime/logs/payfail.log', //куда сохранять
					'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
				],
				[
					'class' => 'yii\log\FileTarget', //в файл
					'categories' => ['payment_success'], //категория логов
					'logFile' => '@runtime/logs/pay.log', //куда сохранять
					'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
				],
				[
					'class' => 'yii\log\FileTarget', //в файл
					'categories' => ['import_err'], //категория логов
					'logFile' => '@runtime/logs/import.log', //куда сохранять
					'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
				],

            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,

	'modules' => [
	'poslug' => [

			'class' => 'app\poslug\module',
			'controllerNamespace' => 'app\poslug\controllers',
			'layout' => '@poslug/views/layouts/main',
		],
	'gridview' =>  [
		'class' => '\kartik\grid\Module',


		// enter optional module parameters below - only if you need to
		// use your own export download action or custom translation
		// message source
//		'downloadAction' => 'gridview/export/download',
		// 'i18n' => []
	],
	'datecontrol' =>  [
	'class' => 'kartik\datecontrol\Module',


	// enter optional module parameters below - only if you need to
	// use your own export download action or custom translation
	// message source
//		'downloadAction' => 'gridview/export/download',
	// 'i18n' => []
    ]
	],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

return array_merge_recursive($config, require($webroot . '/vendor/noumo/easyii/config/easyii.php'));