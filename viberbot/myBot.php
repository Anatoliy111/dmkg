<?php



//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');

use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use yii\bootstrap\Html;

//echo "sdgsdgsd\n";



$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE

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
                    ->setText('you press the button and you ID '.$receiverId)
                    ->setKeyboard(getRahMenu())
            );
        })

        ->onText('|back|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('click on button');
            $receiverId = $event->getSender()->getId();
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setReceiver($receiverId)
                 //   ->setText('')
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
                    ->setKeyboard(getRahMenu())
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
               ->setBgColor("#f7bb3f")
                ->setText('Інформація по ос.рахунках'),
               // ->setImage("https://dmkg.com.ua/uploads/plus.png"),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
              //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('regular')
                ->setActionType('reply')
                ->setActionBody('rah-menu')
                ->setBgColor("#f7bb3f")
               // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('<font color=\"#494E67\">Операції з ос.рахунками</font>'),

            (new \Viber\Api\Keyboard\Button())
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                ->setText('Операції з ос.рахунками')
                ->setImage("https://dmkg.com.ua/uploads/viber_p24.jpg"),
        ]);

}

function getRahMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('large')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Додати рахунок до бота'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Видалити рахунок з бота'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('back')
                ->setText('< Назад'),

        ]);

}