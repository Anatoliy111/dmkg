<?php

namespace app\controllers;
//require_once(__DIR__ . '/vendor/autoload.php');

use Exception;
use Viber\Bot;
use Viber\Client;
use Viber\Api\Sender;



class ViberController extends \yii\web\Controller
{



    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionSetup()
    {
        $apiKey = '4cc2a5b34ba7d2bf-ad220322f4f8ca5b-dd7d0419116d069a'; // <- PLACE-YOU-API-KEY-HERE
        $webhookUrl = 'https://dmkg.com.ua/viber/bot'; // <- PLACE-YOU-HTTPS-URL
        try {
            $client = new Client(['token' => $apiKey]);
            $result = $client->setWebhook($webhookUrl);
            echo "Success!\n";
        } catch (Exception $e) {
             echo "Error: ". $e->getMessage() ."\n";
           // echo "Error: " . "\n";
        }

    }

    public function actionBot()
    {


        $apiKey = '4cc2a5b34ba7d2bf-ad220322f4f8ca5b-dd7d0419116d069a';

// так будет выглядеть наш бот (имя и аватар - можно менять)
        $botSender = new Sender([
            'name' => 'Whois bot',
            'avatar' => 'https://dmkg.com.ua/uploads/images/icon_16.png',
        ]);

        try {
            $bot = new Bot(['token' => $apiKey]);
            $bot
                ->onConversation(function ($event) use ($bot, $botSender) {
                    // это событие будет вызвано, как только пользователь перейдет в чат
                    // вы можете отправить "привествие", но не можете посылать более сообщений
                    return (new \Viber\Api\Message\Text())
                        ->setSender($botSender)
                        ->setText("Can i help you?");
                })
                ->onText('|whois .*|si', function ($event) use ($bot, $botSender) {
                    // это событие будет вызвано если пользователь пошлет сообщение
                    // которое совпадет с регулярным выражением
                    $bot->getClient()->sendMessage(
                        (new \Viber\Api\Message\Text())
                            ->setSender($botSender)
                            ->setReceiver($event->getSender()->getId())
                            ->setText("I do not know )")
                    );
                })
                ->run();
        } catch (Exception $e) {
            // todo - log exceptions
        }
    }
}
