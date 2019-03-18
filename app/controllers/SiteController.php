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


	public function actionCallback()
	{

		$pay = new UtPay();
		$post = Yii::$app->request->post();

		if( isset($post['data']) && isset($post['signature'])){
			$public_key = 'i26177975911';
			$private_key = 'MRRWK7Ao9WlfTPO2TR5tRf8ciXv8OM73dqGHCjZQ';

			$sign = base64_encode( sha1(
				$private_key .
				$post['data'] .
				$private_key
				, 1 ));

			if ($post['signature']==$sign ){
				$result= json_decode( base64_decode($post['data']) );
				// данные вернуться в base64 формат JSON
				$pay->findOne($result->order_id);

				$pay->status = $result->status;
				$pay->datestat = new \DateTime("now", new \DateTimeZone('Europe/Kiev'));;
				$pay->save();
				$messageLog = [
					'status' => 'Платеж прошел.',
					'post' => $post,
					'payment' =>$pay->id.' '.$pay->status,
				];

				Yii::info($messageLog, 'payment_success');

			}
		}
		else{
			$messageLog = [
				'status' => 'Платеж не прошел.',
				'post' => $post
			];

			Yii::error($messageLog, 'payment_fail');
		}


//		return $this->redirect('/ut-kart');
//		if (isset($_POST["operation_xml"]) && !empty($_POST["operation_xml"])) {

//			$xml = base64_decode($_POST['operation_xml']);
//			$signature = $_POST['signature'];
//
//// Выбираем из xml нужные данные
//			$order_id = intval(get_tag_val($xml, 'order_id'));
//			$merchant_id = get_tag_val($xml, 'merchant_id');
//			$amount = get_tag_val($xml, 'amount');
//			$currency_code = get_tag_val($xml, 'currency');
//			$status = get_tag_val($xml, 'status');
//
//			if ($status !== 'success')
//				exit();
//
//////////////////////////////////////////////////
//// Выберем заказ из базы
//////////////////////////////////////////////////
//			$order = $simpla->orders->get_order(intval($order_id));
//			if (empty($order))
//				die('Оплачиваемый заказ не найден');
//
//////////////////////////////////////////////////
//// Выбираем из базы соответствующий метод оплаты
//////////////////////////////////////////////////
//			$method = $simpla->payment->get_payment_method(intval($order->payment_method_id));
//			if (empty($method))
//				die("Неизвестный метод оплаты");
//
//			$settings = unserialize($method->settings);
//			$payment_currency = $simpla->money->get_currency(intval($method->currency_id));
//
//// Проверяем контрольную подпись
//			$mysignature = base64_encode(sha1($settings['liqpay_sign'] . $xml . $settings['liqpay_sign'], 1));
//			if ($mysignature !== $signature)
//				die("bad sign");
//
//// Нельзя оплатить уже оплаченный заказ
//			if ($order->paid)
//				die('Этот заказ уже оплачен');
//
//			if ($amount != round($simpla->money->convert($order->total_price, $method->currency_id, false), 2) || $amount <= 0)
//				die("incorrect price");
//
//			if ($currency_code != $payment_currency->code)
//				die("incorrect currency");
//
//// Установим статус оплачен
//			$simpla->orders->update_order(intval($order->id), array('paid' => 1));
//
//// Отправим уведомление на email
//			$simpla->notify->email_order_user(intval($order->id));
//			$simpla->notify->email_order_admin(intval($order->id));
//
//// Спишем товары
//			$simpla->orders->close(intval($order->id));
//
//			function get_tag_val($xml, $name) {
//				preg_match("/<$name>(.*)<\/$name>/i", $xml, $matches);
//				return trim($matches[1]);
//			}
//
//		} else {
//
//			header('Location: ' . $simpla->request->root_url . '/order/');
//			exit();
//
//		}
	}


	public function actionSaveperiodkab()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			Yii::$app->session['periodkab']=$data['period'];

		}



	}

}