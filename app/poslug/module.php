<?php

namespace app\poslug;
use Yii;

/**
 * poslug module definition class
 */
class module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\poslug\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();

        if(Yii::$app->user->isGuest){
            Yii::$app->user->setReturnUrl(Yii::$app->request->url);
            Yii::$app->getResponse()->redirect(['/admin/sign/in'])->send();
            return false;
        }

		// initialize the module with the configuration loaded from config.php
//		\Yii::configure($this, require(__DIR__ . '/config.php'));
//
//		\Yii::$app->setComponents([
//			'errorHandler' => [
//				'class' => 'yii\web\ErrorHandler',
//				'errorAction' => 'poslug/default/error',
//			], // set error action route - this to be error action in DefaultController
//		]);


		$handler = new \yii\web\ErrorHandler(['errorAction' => 'poslug/default/error']);
		Yii::$app->set('errorHandler', $handler);
		$handler->register();

//		$Url = new \yii\web\UrlManager([
//				'rules' => [
//					'poslug/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>',
//					'poslug/:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>'
//				],
//		]);
//		Yii::$app->set('urlManager', $Url);
//		$Url->rules;


//		'urlManager' => [
//		'enablePrettyUrl' => true,
//		'showScriptName' => false,
//		'rules' => [
//			'<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
//			'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//			'<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
//			'poslug/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>',
//			'poslug/:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'poslug/<controller>/<action>'
//		],
//	],

		// custom initialization code goes here
    }

}
