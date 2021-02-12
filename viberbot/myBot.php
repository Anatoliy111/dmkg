<?php



//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');

use app\models\UtKart;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtAbonkart;
use app\poslug\models\Viber;
use app\poslug\models\ViberAbon;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use yii\bootstrap\Html;

//echo "sdgsdgsd\n";



$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
$org = 'dmkg';

// ��� ����� ��������� ��� ��� (��� � ������ - ����� ������)
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
    $bot
        // first interaction with bot - return "welcome message"
        ->onConversation(function ($event) use ($bot, $botSender, $log) {
            $log->info('onConversation handler');

            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.')
                ->setKeyboard(getMainMenu());
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log) {
            $receiverId = $event->getSender()->getId();
            $log->info('onSubscribe handler');
            $this->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
                    ->setKeyboard(getMainMenu())
            );
        })
        ->onText('|info-click|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('click on button');
            $receiverId = $event->getSender()->getId();
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setReceiver($receiverId)
                    ->setText('you press the button and you ID '.$receiverId)
                    ->setKeyboard(getMainMenu())
            );
        })

        ->onText('|rah-menu|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('click on button');
            $receiverId = $event->getSender()->getId();
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setReceiver($receiverId)
                    ->setMinApiVersion(7)
                    ->setText('you press the button and you ID '.$receiverId)
                    ->setKeyboard(getRahMenu())
            );
        })

        ->onText('|MainMenu|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('click on button');
            $receiverId = $event->getSender()->getId();
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setMinApiVersion(7)
                    ->setReceiver($event->getSender()->getId())
                    ->setText('Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.')
                    ->setKeyboard(getMainMenu())
            );
        })

        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('onText ' . var_export($event, true));
            // .* - match any symbols
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setReceiver($event->getSender()->getId())
                    ->setText('Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.')
                    ->setKeyboard(getMainMenu())
            );
        })
        ->run();
} catch (Exception $e) {
    $log->warning('Exception: ' . $e->getMessage());
    if ($bot) {
        $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
        $log->warning('Actual body: ' . $bot->getInputBody());
    }
}

function getMainMenu(){

   return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
               // ->setTextSize('small')
                ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('bottom')
                ->setActionType('reply')
                ->setActionBody('info-click')
               ->setBgColor("#75C5F3")
                ->setText('Інформація по ос.рахунках')
                ->setImage("https://dmkg.com.ua/uploads/home_small.ico"),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
              //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('regular')
                ->setActionType('reply')
                ->setActionBody('rah-menu')
                ->setBgColor("#75C5F3")
               // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('Операції з ос.рахунками'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('regular')
                ->setActionType('reply')
                ->setActionBody('rah-menu')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/p242.jpg"),
        ]);

}



function getRahMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#75F3AE')
                // ->setTextSize('small')
              //  ->setTextSize('large')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Додати рахунок до бота'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                  ->setBgColor('#F39175')
                ->setTextHAlign('center')
              //  ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Видалити рахунок з бота'),

            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(4)
//                ->setRows(2)
                  ->setBgColor('#75C5F3')
              //  ->setTextSize('large')
                ->setTextSize('regular')
                ->setTextHAlign('left')
                ->setTextVAlign('top')
                ->setActionType('reply')
                ->setActionBody('MainMenu')
           //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню')

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
                //->setText('Головне меню')
               // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

        ]);

}

function verifyReceiver($receiverId, $apiKey, $org){

    $FindModel = Viber::findOne(['api_key' => $apiKey,'id_receiver' => $receiverId]);
    if ($FindModel== null)
    {
        $model = new Viber();
        $model->api_key = $apiKey;
        $model->id_receiver = $receiverId;
        $model->org = $org;
        if ($model->validate() && $model->save())
        {
            return $model->id;
        }
        else
        {
            $messageLog = [
                'status' => 'Помилка додавання в підписника',
                'post' => $model->errors
            ];

            Yii::error($messageLog, 'viber_err');

            return false;

        }
    }
    else return $FindModel->id;

}


function verifyAbon($apiKey,$id_viber,$schet, $org){

    $FindAbon = UtAbonent::findOne(['schet' => $schet]);
    if ($FindAbon<>null)
    {
        $FindKart = UtKart::findOne(['id' => $FindAbon->id_kart]);

        $FindModel = ViberAbon::findOne(['id_viber' => $apiKey,'id_utkart' => $FindKart]);
        if ($FindModel== null)
        {
            $model = new ViberAbon();
            $model->id_viber = $id_viber;
            $model->id_utkart = $FindKart;
            $model->org = $org;
            if ($model->validate() && $model->save())
            {
                return $model->id;
            }
            else
            {
                $messageLog = [
                    'status' => 'Помилка додавання абонента',
                    'post' => $model->errors
                ];

                Yii::error($messageLog, 'viber_err');

                return false;

            }
        }
        else return $FindModel->id;
    }
    else return 'Рахунок не знайдено';





}

