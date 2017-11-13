<?php

namespace app\controllers;

use Yii;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actionSearch()
	{
		return $this->render('search');
	}

	public function actionAbout()
	{
		if (!\Yii::$app->user->can('about')) {
			throw new ForbiddenHttpException('Access denied');
		}
		return $this->render('about');
	}

	public function actionError()
	{
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			return $this->render('error', ['message' => $exception]);
		}
	}

}