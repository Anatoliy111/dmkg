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
//			$res = Yii::$app->request->post();

//			$r1 = json_decode($res);
//			$r2 = current($rres);
			$r3 = Yii::$app->getRequest()->getRawBody();
			$r323 = Yii::$app->getRequest()->getBodyParams();
//            $r323 = Yii::$app->getRequest()['json'];
//			$r123 = json_decode($r3);
		//	$r33 = gettype($r323);
		//	$r4 = current($r323);
			$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
//            $rr = json_decode($json);
//			$rrr = current($rr);
//			$res2 = $res['phone'];
//			$res1 = json_decode($res['data']);

			$mes = $r3 ;//. $r33; //. $r4;
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