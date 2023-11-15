<?php

//require_once("../vendor/autoload.php");


require_once(__DIR__ . '/../vendor/autoload.php');

use app\models\ViberAbon;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


function getDmkgMenuOS($Receiv){

    if ($Receiv!=null) $FindModels = ViberAbon::find()->where(['id_viber' => $Receiv->id]);

    if ($Receiv == null) {
        return (new \Viber\Api\Keyboard())
            ->setButtons([

                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    //  ->setBgColor('#2fa4e7')
                    ->setTextHAlign('center')
                    ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('Kontakt-button')
                    ->setBgColor("#aafdc8")
                    // ->setBgColor("#F3DD27")
                    // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                    ->setText('📬 Контактна інформація'),

                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    //  ->setBgColor('#2fa4e7')
                    ->setTextHAlign('center')
                    ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('Auth-button')
                    ->setBgColor("#fdbdaa")
                    // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                    ->setText('Авторизація/Реєстрація'),

//                (new \Viber\Api\Keyboard\Button())
////                ->setColumns(6)
//                    ->setActionType('open-url')
//                    ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
//                    ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
////                ->setTextSize('regular')
////                ->setTextHAlign('left')
////                ->setText('Оплата'),
            ]);
    }
    else {
        if ($Receiv->id_abonent == null) {


            return (new \Viber\Api\Keyboard())
                ->setButtons([

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //->setBgColor('#8074d6')
                        // ->setTextSize('small')
                        ->setTextSize('regular')
                        ->setTextHAlign('center')
//                ->setTextVAlign('center')
                        ->setActionType('reply')
                        ->setActionBody('Infomenu-button')
                        ->setBgColor("#fdaafc")
                        ->setText('📊  Інформація по рахунках'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Pokazmenu-button')
                        ->setBgColor("#75C5F3")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📟  Подати показники (вода)'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Rahmenu-button')
                        ->setBgColor("#F2F3A7")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('⚙ Додати/видалити рахунок'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Kontakt-button')
                        ->setBgColor("#aafdc8")
                        // ->setBgColor("#F3DD27")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📬 Контактна інформація'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        ->setActionType('open-url')
                        ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                        ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
//                ->setTextSize('regular')
//                ->setTextHAlign('left')
//                ->setText('Оплата'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Auth-button')
                        ->setBgColor("#fdbdaa")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('Авторизація/Реєстрація'),
                ]);
        }
        else
        {
            return (new \Viber\Api\Keyboard())
                ->setButtons([

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //->setBgColor('#8074d6')
                        // ->setTextSize('small')
                        ->setTextSize('regular')
                        ->setTextHAlign('center')
//                ->setTextVAlign('center')
                        ->setActionType('reply')
                        ->setActionBody('Infomenu-button')
                        ->setBgColor("#fdaafc")
                        ->setText('📊  Інформація по рахунках'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Pokazmenu-button')
                        ->setBgColor("#75C5F3")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📟  Подати показники (вода)'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Rahmenu-button')
                        ->setBgColor("#F2F3A7")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('⚙ Додати/видалити рахунок'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Kontakt-button')
                        ->setBgColor("#aafdc8")
                        // ->setBgColor("#F3DD27")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📬 Контактна інформація'),

                    (new \Viber\Api\Keyboard\Button())
//                ->setColumns(6)
                        ->setColumns(3)
                        ->setActionType('open-url')
                        ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                        ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
//                ->setTextSize('regular')
//                ->setTextHAlign('left')
//                ->setText('Оплата'),
                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Exit-button')
                        ->setBgColor("#fdbdaa")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('Вихід з кабінета'),
                ]);


        }

    }

}


function getDmkgSend($message,$Receiv)
{



    $apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE

    $botSender = new Sender([
        'name' => 'bondyukViberBot',
        'avatar' => '',
    ]);

// log bot interaction
    $log = new Logger('bot');
    $log->pushHandler(new StreamHandler(__DIR__ .'/tmp/bot.log'));

    try {
        // create bot instance
        $bot = new Bot(['token' => $apiKey]);
        $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setReceiver($Receiv->id_receiver)
                ->setText($message)
                ->setKeyboard(getDmkgMenuOS($Receiv))
        );

    } catch (Exception $e) {
        $log->warning('Exception: ' . $e->getMessage());
        if ($bot) {
            $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
            $log->warning('Actual body: ' . $bot->getInputBody());
        }
    }

    return '';
}


