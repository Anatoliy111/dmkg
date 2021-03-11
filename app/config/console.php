<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

return [
    'id' => 'app-console',
    'basePath' => $basePath,
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@webroot' => $webroot,
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'd3nJy8BE2jOgBK3yTQtr0KZ3xm04n-mS',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget', //в файл
                    'categories' => ['viber_err'], //категория логов
                    'logFile' => '@runtime/logs/viber.log', //куда сохранять
                    'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
                ],
            ],
        ],
		'authManager' => [
			'class' => 'yii\rbac\PhpManager',
		],
        'db' => $db,
    ],
    'params' => $params,
];

