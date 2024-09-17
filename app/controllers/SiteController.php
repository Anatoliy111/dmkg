<?php

namespace app\controllers;



use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use app\models\KpcentrViberpokazn;
use app\models\UtAbonpokazn;
use app\models\UtPay;
use app\poslug\models\Viber;
use app\poslug\models\ViberAbon;
use DateTime;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use silentlun\qrcode\QrCode;
use Throwable;
use Viber\Api\Sender;
use Viber\Bot;
use Yii;
use yii\base\ErrorException;
use yii\bootstrap\Alert;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

require (Yii::getAlias('@webroot'). '/viberbot/mySendBot.php');
require (Yii::getAlias('@webroot'). '/viberbot/botMenu.php');
//require (Yii::getAlias('@webroot'). '/viberbot/kpcentrBot.php');
//require (Yii::getAlias('@webroot'). '/viberbot/kpcentrBot.php');



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
        return '';
	}

	public function actionSaveperioddom()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			$session=Yii::$app->session;
            $session['perioddom']=$data['period'];

		}
	}

	public function actionSaveperiodkab()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
            $session=Yii::$app->session;
            $session['periodkab']=$data['period'];

		}
	}

    public function actionQrcode($code_url)
    {
        return QRcode::png($code_url);
    }

	public function actionOfferta()
	{
		return $this->render('offerta');
	}


	/**
	 * @return string
	 * @throws \yii\db\Exception
     */
	public function actionImpjson()
	{

		//
		$mes='ok';
		$mesALL='';
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
							if ($type->type == 'date') {
								$model->$k2 = date('Y-m-d',strtotime($v2));
							}
							elseif ($type->type == 'string')  {
								$model->$k2 = ukrencodestr($v2);
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
                            $mesALL=$mesALL.' '.$meserr;
							//return implode($meserr);
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

        if ($mesALL<>'') {
            $mes = $mesALL;
        }
		return $mes;
	}

	public function actionExpjson()
	{
		$mes = '';
		if (Yii::$app->request->isPost) {
			$res = Yii::$app->request->post();

		//	$res = json_decode($res['data'], true);

			if (($res['model']=='kpviberpokazn')) {
				$findpokaz = KpcentrViberpokazn::find()
				->Where(['in','`id`',KpcentrViberpokazn::find()->select('max(id)')->where(['>','id',$res['lastid']])->groupBy('schet')])
//				->Where(['=','`id`','(select max(kp2.id) from kpcentr_viberpokazn kp2 where kp2.id > '.$res['lastid'].' and kp2.schet=kpcentr_viberpokazn.schet)'])
				->asArray()->all();
				if ($findpokaz!=null){
					$mes = json_encode($findpokaz);

				}
			}
            if (($res['model']=='sitepokazn')) {
                $findpokaz = UtAbonpokazn::find()->where(['>','id',$res['lastid']])->orderBy('id')->asArray()->all();
//                    ->Where(['in','`id`',KpcentrViberpokazn::find()->select('max(id)')->where(['>','id',$res['lastid']])->groupBy('schet')])
//				->Where(['=','`id`','(select max(kp2.id) from kpcentr_viberpokazn kp2 where kp2.id > '.$res['lastid'].' and kp2.schet=kpcentr_viberpokazn.schet)'])
//                    ->asArray()->all();
                if ($findpokaz!=null){
                    $mes = json_encode($findpokaz);
                }
            }

		}

		return $mes;

	}

    public function actionSendmess()
    {
        $mes = '';
        if (Yii::$app->request->isPost) {
            $res = Yii::$app->request->post();

            //$res = json_decode($res['data'], true);
            $apiKey = '';
            $message = '';
            $model = null;
            $botSender = null;
            $menu = null;
            if ($res['org'] == 'kpcentr') {

                $apiKey = '4d098f46d267dd30-1785f1390be821c1-7f30efd773daf6d2';
                $message = $res['mess'];

                $menu = getKpMenu();

                $botSender = new Sender([
                    'name' => 'KPCentrBot',
                    'avatar' => '',
                ]);
            }

            if ($res['org'] == 'dmkg') {

                $apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742';
                $message = $res['mess'];

                $menu = getDmkgMenu();

                $botSender = new Sender([
                    'name' => 'dmkgBot',
                    'avatar' => '',
                ]);
            }

            if ($res['vidmess'] == 'mess') {

                $model = Viber::find()
                    ->where(['api_key' => $apiKey, 'org' => $res['org'], 'id'=>69])->asArray()->all();



                if (($apiKey <> '') && ($message <> '') && ($model <> null)) {

                    $log = new Logger('bot');
                    $log->pushHandler(new StreamHandler(__DIR__ . '/tmp/bot.log'));

                    try {
                        // create bot instance

                        foreach ($model as $reciv) {

                            $bot = new Bot(['token' => $apiKey]);

//                            $bot->getClient()->sendMessage(
//                                (new \Viber\Api\Message\Text())
//                                    ->setSender($botSender)
//                                    ->setReceiver($reciv['id_receiver'])
//                                    ->setText($message)
//                                    ->setKeyboard($menu)
//                            );

                        }

//                        $mes = 'OK';
                        $mes = $menu;

                    } catch (Exception $e) {
                        $log->warning('Exception: ' . $e->getMessage());
//                        if ($bot) {
//                            $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
//                            $log->warning('Actual body: ' . $bot->getInputBody());
//                        }
                    }

                    //return $mes;
                   // $mes = 'log';
                }
            }

            if ($res['vidmess'] == 'info') {

                $model = Viber::find()
                    ->where(['api_key' => $apiKey, 'org' => $res['org']])->asArray()->all();


                if (($apiKey <> '') && ($message <> '') && ($model <> null)) {

                    $log = new Logger('bot');
                    $log->pushHandler(new StreamHandler(__DIR__ . '/tmp/bot.log'));

                    try {
                        // create bot instance

                        foreach ($model as $reciv) {

                            $Abons = ViberAbon::find()
                                ->where(['id_viber' => $reciv['id']])->asArray()->all();

                            foreach ($Abons as $schet) {

                                if ($res['org'] == 'dmkg') $message=infoDmkgSchet($schet['schet']);
                                if ($res['org'] == 'kpcentr') $message=infoKpSchet($schet['schet']);

                                $bot = new Bot(['token' => $apiKey]);
                                $bot->getClient()->sendMessage(
                                    (new \Viber\Api\Message\Text())
                                        ->setSender($botSender)
                                        ->setReceiver($reciv['id_receiver'])
                                        ->setText($message)
                                        ->setKeyboard($menu)
                                );

                            }


                        }

                        $mes = 'OK';

                    } catch (Exception $e) {
                        $log->warning('Exception: ' . $e->getMessage());
                        if ($bot) {
                            $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
                            $log->warning('Actual body: ' . $bot->getInputBody());
                        }
                    }

                    return $mes;
                }


            }


        }


        return $mes;

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





	public function beforeAction($action)
	{
		if(($action->id=="impjson") || ($action->id=="expjson") || ($action->id=="sendmess"))
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







}

