<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


use app\models\Viber;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../viberbot/botMenu.php');
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/web.php';
new yii\web\Application($yiiConfig);
require_once(__DIR__ . '\dmkgMenuSend.php');


$apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742'; //dmkgBot
//$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';  //myBot
//$apiKey = '4d098f46d267dd30-1785f1390be821c1-7f30efd773daf6d2';  //kpBot


//$message = <<<EOD
//Доброго дня! MyBot до якого ви підписались є тестовий бот.
//Виникла помилка при тестуванні кабінета споживача і сформувалось неправильне посилання на MyBot.
//Перереєструйтесь на DmkgBot Долинського Міськомунгоспу за посиланням
//viber://pa?chatURI=dmkgBot або заново виконайте підключання до вайбербота в кабінеті споживача на сайті dmkg.com.ua (вхід за ел.поштою),
//і відпишіться та видаліть MyBot зі своєї Viber програми.
//Вибачте за незручності!!!
//EOD;

//$receivid = 'gN0uFHnqvanHwb17QuwMaQ='; //myBot
$receivid = '78QXYFX3IiSsRdaPuPtF7Q=='; //dmkgBot


$botSender = new Sender([
    'name' => 'MyBot',
    'avatar' => '',
]);

// log bot interaction
$log = new Logger('bot');
$log->pushHandler(new StreamHandler(__DIR__ .'/../viberbot/tmp/bot.log'));


$period=Yii::$app->dolgdb->createCommand('select first 1 period from period order by period desc')->QueryAll()[0]["period"];
$lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll()[0]['yearmon'];

$FindEmailSchet = Viber::find()->where(['viber.api_key' => $apiKey])
    ->select('viber.id_receiver,viber.id_abonent,ut_abonkart.schet,ut_abonent.fio')
    ->innerJoin('ut_abonent','ut_abonent.id = viber.id_abonent')
    ->innerJoin('ut_abonkart','ut_abonent.id = ut_abonkart.id_abon')
    ->andwhere(['<>', 'viber.id_abonent',0])
    ->orderBy('viber.id')
    ->asArray()->all();

$id_reciv = '';
$fl_mes = true;
$kol = 0;

foreach ($FindEmailSchet as $abon) {
    if ($abon['id_receiver'] == $receivid) {
        $Receiv = Viber::findOne(['api_key' => $apiKey,'id_receiver' => $abon['id_receiver']]);
        if ($Receiv != null) {
            if ($id_reciv <> $abon['id_receiver']) $fl_mes = true;
            $schet1251 = trim(iconv('UTF-8', 'windows-1251', $abon['schet']));
            $hv = Yii::$app->dolgdb->createCommand('select * from vw_obkr where period=\'' . $period . '\' and schet=\'' . $schet1251 . '\' and wid=\'hv\'')->QueryAll();
            if ($hv != null) {
                $pokazold = Yii::$app->hvddb->createCommand('select * from pokazn where yearmon<>\'' . $lasdatehvd . '\' and schet=\'' . $schet1251 . '\' order by id desc')->QueryAll();
                if (count($pokazold) <> 0) {
                    $pokaz = Yii::$app->hvddb->createCommand('select * from pokazn where yearmon=\'' . $lasdatehvd . '\' and schet=\'' . $schet1251 . '\' order by id desc')->QueryAll();
                    if (count($pokaz) == 0) {
                        if ($fl_mes) {
                            $mess = 'Доброго дня ' . $abon['fio'] . '! Нагадуємо вам про здачу показників водопостачання по вашим під"єднаним рахункам!!!' . "\r\n";
                            $mess = $mess . 'Подати показник ви можете за допомогою вайбербота або в кабінеті споживача на сайті dmkg.com.ua (вхід за ел.поштою) або за телефонами:' . "\n";
                            $mess = $mess . '(066)128-11-85 (Viber)' . "\n";
                            $mess = $mess . '(095)791-32-62' . "\n";
                            getDmkgSend($mess,$Receiv);
                            $fl_mes = false;
                            $kol = $kol + 1;
                        }
                        $mess = 'Особовий рахунок - ' . $abon['schet'] . "\n";
                        $mess = $mess . trim(iconv('windows-1251', 'UTF-8', $hv[0]['fio'])) . "\n";
                        $mess = $mess . 'Останній показник по воді :' . "\n";
                        $mess = $mess . "Дата показника: " . date('d.m.Y', strtotime($pokazold[0]['date_pok'])) . "\n";
                        $mess = $mess . 'Показник: ' . $pokazold[0]['pokazn'] . "\n";
                        getDmkgSend($mess,$Receiv);
                    }
                }
            }
        }
        $id_reciv = $abon['id_receiver'];
    }
}

echo $kol;






