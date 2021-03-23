<?php

require(__DIR__ . '/kpcentrBot.php');

use app\poslug\models\Viber;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Viber\Api\Sender;
use Viber\Bot;


$mes = '';
if (Yii::$app->request->isPost) {
    $res = Yii::$app->request->post();

   // $res = json_decode($res['data'], true);


    $apiKey = '4d098f46d267dd30-1785f1390be821c1-7f30efd773daf6d2';
    $message = $res['mess'];
    $model = Viber::find()
        ->where(['api_key' => $apiKey, 'org' => 'kpcentr'])->asArray()->all();
    $menu = getMainMenu();

    $botSender = new Sender([
        'name' => 'KPCentrBot',
        'avatar' => '',
    ]);


    if (($message <> '') && ($model <> null)) {

        $log = new Logger('bot');
        $log->pushHandler(new StreamHandler(__DIR__ . '/tmp/bot.log'));

        try {
            // create bot instance

            foreach ($model as $reciv) {

                $bot = new Bot(['token' => $apiKey]);
                $bot->getClient()->sendMessage(
                    (new \Viber\Api\Message\Text())
                        ->setSender($botSender)
                        ->setReceiver($reciv['id_receiver'])
                        ->setText($message)
                        ->setKeyboard($menu)
                );
            }

            $mes = 'OK';

        } catch (Exception $e) {
            $log->warning('Exception: ' . $e->getMessage());
            if ($bot) {
                $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
                $log->warning('Actual body: ' . $bot->getInputBody());
            }
            $mes = $e->getMessage();
        }
    }
}

return $mes;