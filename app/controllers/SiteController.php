<?php

namespace app\controllers;



use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use app\models\UtPay;
use DateTime;
use Throwable;
use Yii;
use yii\base\ErrorException;
use yii\bootstrap\Alert;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

require_once(Yii::getAlias('@webroot'). '/viberbot/mySendBot.php');



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

		//
		$mes='ok';
		if (Yii::$app->request->isPost) {
				$res = Yii::$app->request->post();

			  //  $res = json_decode($res['data'],true);

            $kol = 0;
			if ($res['model']=='kpobor') KpcentrObor::deleteAll('status = :status', [':status' => 0]);
			if ($res['model']=='kppokazn') KpcentrPokazn::deleteAll('status = :status', [':status' => 0]);

			if (count($res['data'])!=0) {
				$transaction = Yii::$app->db->beginTransaction();
				foreach ($res['data'] as $k1 => $v1) {

					try {

						if ($res['model']=='kpobor') $model = new KpcentrObor();
						if ($res['model']=='kppokazn') $model = new KpcentrPokazn();

                       $model->period = date('Y-m-d',strtotime( $res['period']));
						foreach ($v1 as $k2 => $v2){
							$type = $model->getTableSchema()->getColumn($k2);
							if ($type->dbType == 'date') {
								$model->$k2 = date('Y-m-d',strtotime($v2));
							}
							elseif ($type->dbType == 'string')  {
								$model->$k2 = encodestr($v2);
							}
							else $model->$k2 = $v2;
						}
                        if ($model->validate()){
							$model->save();
						}
						else {
							$errAll = $model->getErrors();
							$meserr='Error import json '.$res['model'].' '.$v1['schet'].' ';
							foreach ($errAll as $err){
								$meserr=$meserr.implode(",", $err);
							}
							Yii::error($meserr, 'json_import');
							getSend($meserr);
							return implode($meserr);
						}
						if ($kol % 1000 === 0) {
							$transaction->commit();
							$transaction = Yii::$app->db->beginTransaction();
						}

					} catch (Throwable $e) {
						$messageLog = [
							'status' => 'Помилка імпорту, запис в базу даних ',
							'model' => $res['model'],
							'post' => $e
						];

						Yii::error($messageLog, 'json_import');

						getSend($e);
					}

					++$kol;
				}
				$transaction->commit();
				if (intval($res['kol'])!=$kol)
					$mes = 'Error!!! Json model '.$res['model'].' kol='.$res['kol'].' > save base kol='.$kol;
				else $mes = 'Export '.$res['model'].' is good!!!';
			}
			else $mes = 'Error!!! Count Json = 0';

		}
		else $mes = "Error!!! Post Json is null";

		$pos = strpos($mes, 'Error!!!');
		if ($pos === 0) {

			$messageLog = [
				'status' => 'Помилка імпорту '.$res['model'],
				'model' => $res['model'],
				'post' => $mes
			];

			Yii::error($messageLog, 'json_import');

			getSend(implode(",", $messageLog));
		}
		else {
			$model->deleteAll('status = :status', [':status' => 1]);
			$model->updateAllCounters(['status' => 1]);
//			KpcentrObor::updateAll(['status' => 1], ['like', 'email', '@example.com']);
		}


		return $mes;
	}

	function is_Date($str){
		return is_numeric(strtotime($str));
	}

	function object_to_array($data){
		if(is_array($data) || is_object($data))
		{
			$result = array();

			foreach($data as $key => $value) {
				$result[$key] = $this->object_to_array($value);
			}

			return $result;
		}

		return $data;
	}

	public function actionImptest()
	{

		//
		$mes='ok';
		if (Yii::$app->request->isPost) {
			$res5 = Yii::$app->request->post();
//			$json = json_decode($res['data'],true);
//			try {

			$res1 = Yii::$app->getRequest();
//			$json = json_decode($res,true);

//			if (is_null($res))$mes='res is null';
//			if (count($res['parsers'])!=0) $mes=count($res['parsers']);
//			$res = $this->object_to_array($res1);
//			$pars = $res['_bodyParams'];
//			$json = $pars['application/json'];
			//$array = json_decode(json_encode($res), true);
			if (count($res5)!=0) $mes=count($res5);
			$mes= $mes.'/'.gettype($res5);
//			$mes= $mes.'/'.$_POST;
//			if (count($array['parsers'])!=0) $mes=count($array['parsers']);
//            $pars = $res['parsers'];
//			$json = $pars['application/json'];
//			$mes= $pars;
//
			foreach($res5 as $key=>$value)
			{
				$mes= $mes.'/'.$key;
//			$mes= gettype($value);
			}
//			$mes= gettype($res['parsers']);

//			$keys = array_keys($res);
//			$mes= $keys[0];
////
//			if (count($res)!=0) $mes=array_key_first($res);

//			$mes = strtotime($res['kol']);
////			$json = json_decode($res, true);
//			} catch (Throwable $e) {
//						$messageLog = [
//							'status' => 'Помилка імпорту, запис в базу даних ',
//							'org' => 'kpcentr',
//							'post' => $e
//						];
//
//						Yii::error($messageLog, 'json_import');
//
//						getSend($e);
//					}
//
//
		}


		return $mes;
	}

	/**
	 * @param $data
	 * @return array
     */



	public function beforeAction($action)
	{
		if($action->id=="impjson")
		{
			$this->enableCsrfValidation=false;
		}

		if($action->id=="imptest")
		{
			$this->enableCsrfValidation=false;
		}

		if(!parent::beforeAction($action)) {
			return false;
		}

		return true;
	}



	function encodestr($str)
	{
		$patterns[0] = "/H/";
		$patterns[1] = "/h/";
		$patterns[2] = "/C/";
		$patterns[3] = "/c/";
		$patterns[4] = "/I/";
		$patterns[5] = "/i/";

		$replacements[0] = "Н";
		$replacements[1] = "н";
		$replacements[2] = "С";
		$replacements[3] = "с";
		$replacements[4] = "І";
		$replacements[5] = "і";

		ksort($patterns);
		ksort($replacements);

		return preg_replace($patterns, $replacements, $str);

	}



}

