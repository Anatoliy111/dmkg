<?php

//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');

use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE

$botSender = new Sender([
    'name' => 'bondyukViberBot',
    'avatar' => '',
]);

// log bot interaction
$log = new Logger('bot');
$log->pushHandler(new StreamHandler('/tmp/bot.log'));

try {
    // create bot instance
    $bot = new Bot(['token' => $apiKey]);
    $bot->getClient()->sendMessage(
        (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setReceiver('gN0uFHnqvanHwb17QuwMaQ==')
            ->setText('you press the button and you ID')
    );

} catch (Exception $e) {
    $log->warning('Exception: ' . $e->getMessage());
    if ($bot) {
        $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
        $log->warning('Actual body: ' . $bot->getInputBody());
    }
}