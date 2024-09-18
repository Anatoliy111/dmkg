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


require_once (__DIR__ .'/dmkgMenuSend.php');
require_once(__DIR__ . '/../vendor/autoload.php');
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/web.php';
new yii\web\Application($yiiConfig);



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
//    ->andwhere(['=', 'viber.id_receiver','78QXYFX3IiSsRdaPuPtF7Q=='])
//    ->orwhere(['=', 'viber.id_receiver','TDts4sPNiTEJS/Y6WkPVQg=='])
    ->orderBy('viber.id')
    ->asArray()->all();


$id_reciv = '';
$countSend = 0;
$countAbon= 0;
$fio = '';
$messschet = '';
$errmess = '';

foreach ($FindEmailSchet as $abon) {
    try {
//        if ($abon['id_receiver'] == $receivid) {
                if ($id_reciv <> $abon['id_receiver']) {
                    $countSend = send($period,$apiKey,$id_reciv,$fio,$messschet,$countSend);
                    $countAbon = $countAbon + 1;
                    $messschet='';
                }
        $messschet = infoSchetOS($messschet,$abon['schet'],$period);
//        }
        $fio = $abon['fio'];
        $id_reciv = $abon['id_receiver'];

    }
    catch (Exception $e) {
        $mess = $e->getMessage();
        $mess = $mess.'--sendpokazn';
        if ($abon<>null) $mess = $mess.'--idreceiver--'.$abon->id_receiver;
        $errmess = $errmess.$mess. "\n";
      //  getMySend($mess,null);
    }
}


$countSend = send($period,$apiKey,$id_reciv,$fio,$messschet,$countSend);

$FindNoEmailSchet = Viber::find()->where(['viber.api_key' => $apiKey])
    ->select('viber.id_receiver,viber_abon.schet,viber.name as fio')
    ->innerJoin('viber_abon','viber_abon.id_viber = viber.id')
    ->andwhere(['=', 'viber.id_abonent',0])
//    ->andwhere(['=', 'viber.id_receiver','78QXYFX3IiSsRdaPuPtF7Q=='])
//    ->orwhere(['=', 'viber.id_receiver','TDts4sPNiTEJS/Y6WkPVQg=='])
    ->orderBy('viber.id')
    ->asArray()->all();

$id_reciv = '';
$fio = '';
$messschet = '';

foreach ($FindNoEmailSchet as $abon) {
    try {
//        if ($abon['id_receiver'] == $receivid) {
        if ($id_reciv <> $abon['id_receiver']) {
            $countSend = send($period,$apiKey,$id_reciv,$fio,$messschet,$countSend);
            $countAbon = $countAbon + 1;
            $messschet='';
        }
//        $schet1251 = trim(iconv('UTF-8', 'windows-1251', $abon['schet']));
        $messschet = infoSchetOS($messschet,$abon['schet'],$period);
//        }
        $fio = $abon['fio'];
        $id_reciv = $abon['id_receiver'];

    }
    catch (Exception $e) {
        $mess = $e->getMessage();
        $mess = $mess.'--sendpokazn';
        if ($abon<>null) $mess = $mess.'--idreceiver--'.$abon->id_receiver;
        $errmess = $errmess.$mess. "\n";
       // getMySend($mess,null);
    }
}


$countSend = send($period,$apiKey,$id_reciv,$fio,$messschet,$countSend);

$senderr = 'countSend - '.$countSend."\n";
$senderr = $senderr.'countAbon - '.$countAbon."\n";
$senderr = $senderr.$errmess;

getMySend($senderr,null);


echo 'countSend - '.$countSend."\n";
echo 'countAbon - '.$countAbon."\n";

function send($period,$apiKey,$id_reciv,$fio,$messschet,$countSend){
    if ($messschet<>'') {
        $mess = 'Доброго дня ' . $fio . '! Нагадуємо вам про заборгованість по вашим під"єднаним рахункам на період' . "\r\n";
        $mess = $mess.Yii::$app->formatter->asDate($period, 'LLLL Y').'р.!!!'."\n";
        $mess = $mess.$messschet . "\r\n";
        $mess = $mess.'Шановні споживачі! Своєчасно сплачуйте за житлово-комунальні послуги, це надає можливість стабільної роботи підприємства!!!';
        $Receiv = Viber::findOne(['api_key' => $apiKey, 'id_receiver' => $id_reciv]);
        if ($Receiv != null) {
    //        getDmkgSend($mess, $Receiv);
//            getMySend($mess.$messschet,$Receiv);
            $countSend = $countSend + 1;
        }

    }

    return $countSend;

}

function infoSchetOS($messout,$schet,$period) {

    try {


        $schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));


        $dolg=Yii::$app->dolgdb->createCommand('select vw_obkr.*,round((dolg-fullopl),2) as dolgopl from vw_obkr where period=\''.$period.'\' and schet=\''.$schet1251.'\' order by npp')->QueryAll();

        $mess = '-----------------------------'. "\n";
        $mess = $mess . 'Особовий рахунок - '.$schet."\r\n";

        $fio = trim(iconv('windows-1251', 'UTF-8',$dolg[0]["fio"]));
        $mess = $mess.$fio . "\n";

        $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["ulnaim"])).' буд.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomdom"])).' '.(isset($dolg[0]["nomkv"])?'кв.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomkv"])):'')."\r\n";
//        $mess = $mess.'----------------------------'."\n";
//
//        $mess = $mess.Yii::$app->formatter->asDate($period, 'LLLL Y')."\n";
        $mess = $mess.'----------------------------'."\n";
        $mess = $mess.'Заборгованість по послугам:'."\n\r";
        $summa =0;
        foreach($dolg as $obb)
        {
            $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $obb['poslug'])).' '.$obb['dolgopl']."\n";

            if ($obb['dolgopl']>0)
            {
                $summa = $summa + $obb['dolgopl'];
            }
        }
        $mess = $mess.'----------------------------'."\n";

        $mess = $mess."\r".'Всього до сплати по рахунку '.$schet.' становить: '.$summa."\r\n";

        if ($summa<100) $mess='';

        $messout = $messout.$mess;
    }
    catch (\Exception $e) {
        $errmess = $e->getMessage();
        $errmess = $errmess.'--sendinfo';
//        if ($abon<>null) $errmess = $errmess.'--idreceiver--'.$abon->id_receiver;
     //   getMySend($errmess.$messout,null);
        $messout='';
    }

    return $messout;

}






