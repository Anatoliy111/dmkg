<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once(__DIR__ . '/../vendor/autoload.php');
//require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
//$yiiConfig = require __DIR__ . '/../app/config/web.php';
//new yii\web\Application($yiiConfig);
//require_once(__DIR__ . '\dmkgMenuSend.php');


//$apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742'; //dmkgBot
//$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';  //myBot
$apiKey = '4d098f46d267dd30-1785f1390be821c1-7f30efd773daf6d2';  //kpBot

$botSender = new Sender([
    'name' => 'KpCentrBot',
    'avatar' => '',
]);

// log bot interaction
$log = new Logger('bot');
$log->pushHandler(new StreamHandler(__DIR__ .'/tmp/bot.log'));

//$message='Доброго дня! Повідомляємо що з  01.12.2023р. вайбербот KPCentrBot припинить працювати. Для подачі показників по воді реєструйтесь у вайберботі ДМКГ DmkgBot натиснувши на посилання viber://pa?chatURI=dmkgBot або реєструйтесь в кабінеті споживача на сайті dmkg.com.ua. При виникненні проблем з реєстрацією звертайтесь в кабінет ЕКОНОМІСТИ в приміщенні Долинського Міськомунгоспу за адресою м.Долинська вул.Нова 80-а. До кінця листопада 2023, бот буде ПРАЦЮВАТИ та приймати показники!!!';

$message = <<<EOD
Доброго дня! Повідомляємо що з  01.12.2023р. вайбербот "KPCentrBot" припинить працювати.
Для подачі показників по воді реєструйтесь у вайберботі ДМКГ DmkgBot натиснувши на посилання
viber://pa?chatURI=dmkgBot або реєструйтесь в кабінеті споживача на сайті dmkg.com.ua (вхід за ел.поштою).
При виникненні проблем з реєстрацією звертайтесь в кабінет ЕКОНОМІСТИ в приміщенні Долинського Міськомунгоспу за адресою м.Долинська вул.Нова 80-а.
До кінця листопада 2023, бот "KpCentrBot" буде ПРАЦЮВАТИ та приймати показники!!!
EOD;

try {
    // create bot instance
    $bot = new Bot(['token' => $apiKey]);
    $bot->getClient()->sendMessage(
        (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setReceiver('WhD/fEV4c9rtUBGOAihTqA==')
            ->setText($message)
    );

} catch (Exception $e) {
    $log->warning('Exception: ' . $e->getMessage());
    if ($bot) {
        $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
        $log->warning('Actual body: ' . $bot->getInputBody());
    }
}






