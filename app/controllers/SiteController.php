<?php

namespace app\controllers;

use app\models\UtPay;
use Yii;
use yii\bootstrap\Alert;
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

	public function actionSaveperioddom()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			Yii::$app->session['perioddom']=$data['period'];

		}



	}

	public function actionSaveperiodkab()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			Yii::$app->session['periodkab']=$data['period'];

		}



	}

	public function actionOfferta()
	{
		return $this->render('offerta');
	}

	public function actionImpjson()
	{
		if (Yii::$app->request->isPost){
			$res = Yii::$app->request->post();

			$r1 = json_decode($res['data'],true);
			$r2 = current($r1);
			$r3 = current($r2);
			$r4 = current($r3);

			$keys = array_keys($r1);

			foreach ($r1[$keys[0]] as $k1=>$v1){
				$mes = $k1;
			}


//			$res = Yii::$app->getRequest()->getRawBody();
//			$r1 = json_decode($res);
//			$r2 = current($r1);
//			$r3 = current($r2);
//			$r4 = current($r3);


//			$mes = $key1;//. $r33; //. $r4;
			return $mes;

//			if(!empty($rres))
//			{
//				$current_date=date("Y-m-d H:i:s");
//				//$str = implode(',', array_column($res1, 'data'));
//				return $rres;
//			}
//			else return "res is null222";
		}
		else return "post is null";

	}

	public function beforeAction($action)
	{
		if($action->id=="impjson")
		{
			$this->enableCsrfValidation=false;
		}

		if(!parent::beforeAction($action)) {
			return false;
		}

		return true;
	}

}