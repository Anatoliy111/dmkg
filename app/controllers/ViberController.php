<?php

namespace app\controllers;
//require_once(__DIR__ . '/vendor/autoload.php');

use Exception;
use Viber\Client;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Yii;
use yii\web\Controller;

//use yii\rest\Controller;

class ViberController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionWebhook()
    {
        return $this->render('webhook');

    }

    public function actionBot()
    {


        return $this->render('bot');

    }

    public function actionSendbot()
    {
        return $this->render('sendbot');
    }


//    public function beforeAction($action) {
//        if($action->id === 'bot'){
//            Yii::$app->controller->enableCsrfValidation = false;
//        }
//    }

}
