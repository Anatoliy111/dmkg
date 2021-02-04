<?php



//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');

use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
            $buttons = [];
            for ($i = 0; $i <= 8; $i++) {
                $buttons[] =
                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(1)
                        ->setActionType('reply')
                        ->setActionBody('k' . $i)
                        ->setText('k' . $i);
            }
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText("Hi, you can see some demo: send 'k1' or 'k2' etc.")
                ->setKeyboard(
                    (new \Viber\Api\Keyboard())
                        ->setButtons($buttons)
                );
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log) {
            $receiverId = $event->getSender()->getId();
            $log->info('onSubscribe handler');
            $this->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setText('Thanks for subscription!')
            );
        })
        ->onText('|btn-click|s', function ($event) use ($bot, $botSender, $log) {
            $log->info('click on button');
            $receiverId = $event->getSender()->getId();
            $bot->getClient()->sendMessage(
                (new \Viber\Api\Message\Text())
                    ->setSender($botSender)
                    ->setReceiver($receiverId)
                    ->setText('you press the button and you ID '.$receiverId)
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
        ->onText('|k\d+|is', function ($event) use ($bot, $botSender, $log) {
            $caseNumber = (int)preg_replace('|[^0-9]|s', '', $event->getMessage()->getText());
            $log->info('onText demo handler #' . $caseNumber);
            $client = $bot->getClient();
            $receiverId = $event->getSender()->getId();
            switch ($caseNumber) {
                case 0:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Text())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setText('Basic keyboard layout')
                            ->setKeyboard(
                                (new \Viber\Api\Keyboard())
                                    ->setButtons([
                                        (new \Viber\Api\Keyboard\Button())
                                            ->setActionType('reply')
                                            ->setActionBody('btn-click')
                                            ->setText('Tap this button')
                                    ])
                            )
                    );
                    break;
                //
                case 1:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Text())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setText('More buttons and styles')
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 2:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Contact())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setName('Novikov Bogdan')
                            ->setPhoneNumber('+380000000000')
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 3:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Location())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setLat(48.486504)
                            ->setLng(35.038910)
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 4:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Sticker())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setStickerId(114408)
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 5:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Url())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setMedia('https://hcbogdan.com')
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 6:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Picture())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setText('some media data')
                            ->setMedia('https://developers.viber.com/img/devlogo.png')
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 7:
                    $client->sendMessage(
                        (new \Viber\Api\Message\Video())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setSize(2 * 1024 * 1024)
                            ->setMedia('http://techslides.com/demos/sample-videos/small.mp4')
                            ->setKeyboard(getMainMenu())
                    );
                    break;
                //
                case 8:
                    $client->sendMessage(
                        (new \Viber\Api\Message\CarouselContent())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setButtonsGroupColumns(6)
                            ->setButtonsGroupRows(6)
                            ->setBgColor('#FFFFFF')
                            ->setButtons([
                                (new \Viber\Api\Keyboard\Button())
                                    ->setColumns(6)
                                    ->setRows(3)
                                    ->setActionType('open-url')
                                    ->setActionBody('https://www.google.com')
                                    ->setImage('https://i.vimeocdn.com/portrait/58832_300x300'),

                                (new \Viber\Api\Keyboard\Button())
                                    ->setColumns(6)
                                    ->setRows(3)
                                    ->setActionType('reply')
                                    ->setActionBody('https://www.google.com')
                                    ->setText('<span style="color: #ffffff; ">Buy</span>')
                                    ->setTextSize("large")
                                    ->setTextVAlign("middle")
                                    ->setTextHAlign("middle")
                                    ->setImage('https://s14.postimg.org/4mmt4rw1t/Button.png')
                            ])
                    );
                    break;
            }
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
                ->setBgColor('#8074d6')
                ->setTextSize('small')
                ->setTextHAlign('right')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Button 1'),

            (new \Viber\Api\Keyboard\Button())
                ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Button 2'),

            (new \Viber\Api\Keyboard\Button())
                ->setBgColor('#555555')
                ->setTextSize('large')
                ->setTextHAlign('left')
                ->setActionType('reply')
                ->setActionBody('btn-click')
                ->setText('Button 3'),
        ]);

}