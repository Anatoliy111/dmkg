<?php

//require_once("../vendor/autoload.php");


require_once(__DIR__ . '/../vendor/autoload.php');

use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



function getSend($message)
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
                ->setReceiver('gN0uFHnqvanHwb17QuwMaQ==')
                ->setText($message)
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

/**
 * @param $str
 * @return mixed
 */
function ukrencodestr($str)
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
