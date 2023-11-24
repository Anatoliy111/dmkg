<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


use app\models\DolgKart;
use app\models\HVoda;
use app\models\Pokazn;
use app\models\UtAbonent;
use app\models\UtAbonpokazn;
use app\models\UtAuth;
use app\models\Viber;

require_once(__DIR__ . '/../../vendor/autoload.php');
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../../app/config/web.php';
new yii\web\Application($yiiConfig);
require_once(__DIR__ . '\botMenu.php');


$apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742';

$period=Yii::$app->dolgdb->createCommand('select first 1 period from period order by period desc')->QueryAll()[0]["period"];
$lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll()[0]['yearmon'];

$FindEmailSchet = Viber::find()->where(['viber.api_key' => $apiKey])
    ->select('viber.id_receiver,viber.id_abonent,ut_abonkart.schet,ut_abonent.fio')
    ->innerJoin('ut_abonent','ut_abonent.id = viber.id_abonent')
    ->innerJoin('ut_abonkart','ut_abonent.id = ut_abonkart.id_abon')
    ->andwhere(['<>', 'viber.id_abonent',0])
    ->orderBy('viber.id')
    ->asArray()->all();

$FindViberSchet = Viber::find()->where(['viber.api_key' => $apiKey])
    ->select('viber.id_receiver,viber_abon.schet')
    ->innerJoin('viber_abon','viber_abon.id_viber = viber.id')
    ->andwhere(['=', 'viber.id_abonent',0])
    ->orderBy('viber.id')
    ->asArray()->all();

$id_reciv = '';
$fl_mes = true;
$kol = 0;

foreach ($FindEmailSchet as $abon) {
    if ($id_reciv<>$abon['id_receiver']) $fl_mes = true;
    $schet1251 = trim(iconv('UTF-8', 'windows-1251', $abon['schet']));
    $hv=Yii::$app->dolgdb->createCommand('select * from vw_obkr where period=\''.$period.'\' and schet=\''.$schet1251.'\' and wid=\'hv\'')->QueryAll();
    if ($hv != null) {
        $pokazold = Yii::$app->hvddb->createCommand('select * from pokazn where yearmon<>\'' . $lasdatehvd . '\' and schet=\'' . $schet1251 . '\' order by id desc')->QueryAll();
        if (count($pokazold) <> 0) {
            $pokaz = Yii::$app->hvddb->createCommand('select * from pokazn where yearmon=\'' . $lasdatehvd . '\' and schet=\'' . $schet1251 . '\' order by id desc')->QueryAll();
            if (count($pokaz) == 0) {
                if ($fl_mes) {
                    $mess = 'Доброго дня! ' . $abon['fio'] . ' нагадуємо вам про здачу показників водопостачання по вашим під"єднаним рахункам!!!' . "\r\n";
                    $mess = $mess . 'Подати показник ви можете за допомогою вайбербота або в кабінеті споживача на сайті dmkg.com.ua (вхід за ел.поштою) або за телефонами:' . "\n";
                    $mess = $mess . '(066)128-11-85 (Viber)' . "\n";
                    $mess = $mess . '(095)791-32-62' . "\n";
                    $mess = $mess . '----------------------------' . "\n";
                    echo $mess;
                    $fl_mes = false;
                    $kol = $kol + 1;
                }
                $mess = 'Особовий рахунок - ' . $abon['schet'] . "\r\n";
                $mess = $mess . 'Останній зарахований показник по воді :' . "\n";
                $mess = $mess . "Дата показника: " . date('d.m.Y', strtotime($pokazold[0]['date_pok'])) . "\n";
                $mess = $mess . 'Показник: ' . $pokazold[0]['pokazn'] . "\n";
                $mess = $mess . '----------------------------' . "\n";
                echo $mess;
            }
        }
    }
    $id_reciv=$abon['id_receiver'];
}






echo 'ok-'.$kol;
////$schet='7020006а';
//preg_match_all('/([^#]+)/ui','start#bondyuk.a.g@gmail.com',$match);
//if (count($match[0])==2) $abon = UtAbonent::findOne(['email' => $match[0][1]]);
//$schet='0092124';
//$schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));
//$modelPokazn=Yii::$app->hvddb->createCommand('select first 1 * from pokazn where schet=\''.$schet1251.'\' order by id desc')->QueryAll();
//
//
////$session->destroy();
//$event='qwer3';
////$stat='add-abon#'.'email=qwe@qwe.com';
//$stat='add-abon#email=qwe@qwe.com#fio=qwerty#pass1=12345#pass2';
////$stat='add-abon#'.'email='.$modelemail->email.'#'.'fio='.$modelemail->fio.'#'.'pass1='.$modelemail->pass1.'#'.'pass2='.$modelemail->pass2;
//preg_match_all('/([^#]+)/ui',$stat,$match);
////echo addPokazn(802,'0092124','asfsadfasdf');
//
//$lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll()[0]['yearmon'];
//$period=Yii::$app->dolgdb->createCommand('select first 1 period from period order by period desc')->QueryAll()[0]["period"];
//
////echo infoSchetOS($schet,$period);
////echo infoPokazn($schet);
//$Receiv = Viber::findOne(2);
//
//echo addPokazn($Receiv,799,'0092124',$lasdatehvd)[1];
////$modelemail = UtAbonent::findOne(['id' => 2071]);
//$Receiv = Viber::findOne(['id' => 2]);
//Addabon($modelemail,$Receiv);

function addPokazn($Receiv,$pokazn, $schet, $lasdatehvd)
{

    $abonent = UtAbonent::findOne($Receiv->id_abonent);
    $nowdate = intval(date('Y').date('m'));
    if ($abonent!=null)
    if ($lasdatehvd<$nowdate) {
        $modelpokazn = new UtAbonpokazn();
        $modelpokazn->schet = trim($schet);
        $modelpokazn->name = $abonent->fio;
        $modelpokazn->id_abonent = $abonent->id;
        $modelpokazn->data = date("Y-m-d");
        $modelpokazn->pokazn = $pokazn;
        $modelpokazn->vid = 'viber';
        if ($modelpokazn->validate()) {
            $modelpokazn->save();
//            $meserr='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';
//            getDmkgSend($meserr,$Receiv);


            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';


            return $mess;
        }
        else {
            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $meserr = '';
            $errors = $modelpokazn->getErrors();
            foreach ($errors as $err) {
                $meserr = $meserr . implode(",", $err);
            }
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }
    }
    else {
        $modelpokazn = new Pokazn();
        $modelpokazn->schet = trim(iconv('UTF-8','windows-1251', $schet));
        $modelpokazn->yearmon =$nowdate;
        $modelpokazn->pokazn = $pokazn;
        $modelpokazn->date_pok = date("Y-m-d");
        $modelpokazn->vid_pok = 21;
        $modelpokazn->fio = $abonent->fio;
        if ($modelpokazn->validate()) {
            $modelpokazn->save();
            Yii::$app->hvddb->createCommand("execute procedure calc_pok(:schet)")->bindValue(':schet', $modelpokazn->schet)->execute();
            $voda = HVoda::find()->where(['schet' => $modelpokazn->schet])->orderBy(['kl' => SORT_DESC])->one();
//            $meserr='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води по рахунку '.$schet.' становить '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>';
//            $meserr=$meserr.'<h3 style="line-height: 1.5;">'.' Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';
//            getDmkgSend($meserr,$Receiv);
            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' зараховано! Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';


            return $mess;
        }
        else {
            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $meserr = '';
            $errors = $modelpokazn->getErrors();
            foreach ($errors as $err) {
                $meserr = $meserr . implode(",", $err);
            }
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }

    }

    return null;
}


function infoPokazn($schet){

    $mess='';
//    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    $schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));

    $modelPokazn=Yii::$app->hvddb->createCommand('select first 1 * from pokazn where schet=\''.$schet1251.'\' order by id desc')->QueryAll();

//    $modelPokazn = Pokazn::find()->where(['schet' => $schet1251])->orderBy(['id' => SORT_DESC])->one();
    if ($modelPokazn!=null){
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn[0]['date_pok']))."\n";
        $mess = $mess.'Показник: '.$modelPokazn[0]['pokazn']."\n";
    }
    else $mess = 'Ваш останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
//    $mess = $mess.'Увага!!! Обробка показників триває протягом 1-3 днів:'."\n";
//    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\n";

    return $mess;

}


function infoSchetOS($schet,$period) {

    $mess='';
    $mess2='';

    try {


        $schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));

//            if ($schet=='0030009м') {
//                if (function_exists('iconv')) {
//                    $mess2 = "iconv is installed and available.";
//                } else {
//                    $mess2 =  "iconv is not available.";
//                }
//                $tt = 'OS '.iconv('UTF-8', 'windows-1251', $schet);
//                return $tt;
//
//            }
//  $modelKart = DolgKart::findOne(['schet' => trim(iconv('UTF-8', 'windows-1251', $schet))]);
//  $modelKart = DolgKart::find()->where(['schet' => $schet1251])->all()[0];
//  $period=DolgPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one()->period;

        $dolg=Yii::$app->dolgdb->createCommand('select vw_obkr.*,round((dolg-fullopl),2) as dolgopl from vw_obkr where period=\''.$period.'\' and schet=\''.$schet1251.'\' order by npp')->QueryAll();
//
        $mess = 'Особовий рахунок - '.$schet."\r\n";

        $fio = trim(iconv('windows-1251', 'UTF-8',$dolg[0]["fio"]));
        $mess = $mess.$fio . "\n";

        $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["ulnaim"])).' буд.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomdom"])).' '.(isset($dolg[0]["nomkv"])?'кв.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomkv"])):'')."\r\n";
        $mess = $mess.'----------------------------'."\n";

        $mess = $mess.Yii::$app->formatter->asDate($period, 'LLLL Y')."\n";
        $mess = $mess.'----------------------------'."\n";
        $mess = $mess.'Ваша заборгованість по послугам:'."\n\r";
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

        $mess = $mess."\r".'Всього до сплати: '.$summa."\n";
    }
    catch(\Exception $e){
        $mess = $e->getMessage();
    }

    return $mess;

}


function Addabon($modelemail,$Receiv)
{

    $message = '';
//        $dataProviderEmail = $modelemail->searchemail(Yii::$app->request->bodyParams);
    $model = new UtAuth();
    $model->scenario = 'reg';
    $model->fio = $modelemail->fio;
    $model->email = $modelemail->email;
    $model->authtoken = md5($modelemail->email . time());
    $model->vid = 'authviber';
    $model->pass = $modelemail->passopen;
    $model->id_receiver = $Receiv->id_receiver;

    if ($model->validate()) {
        $model->save();

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'user-signupviber-comfirm-html'],
                ['model' => $model])
            ->setTo($model->email)
            ->setFrom('supportdmkg@ukr.net')
            ->setSubject('Реєстрація на вайберботі ДМКГ!')
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }



    return 'OK';
}



//function addPokazn($pokazn, $schet, $viber_name){
//
//    $lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll();
//    $nowdate = intval(date('Y').date('m'));
//
//    if ($lasdatehvd[0]['yearmon']<$nowdate) {
//        $modelabonpokazn = new UtAbonpokazn();
//        $modelabonpokazn->schet = $schet;
//        $modelabonpokazn->name = $viber_name;
//        $modelabonpokazn->id_abonent = 2071;
//        $modelabonpokazn->date_pok = date("Y-m-d");
//        $modelabonpokazn->pokazn = $pokazn;
//        $modelabonpokazn->vid = 'viber';
//        if ($modelabonpokazn->validate())
//        {
//            /** @var TYPE_NAME $modelabonpokazn */
//
//            $modelabonpokazn->save();
//            $mess =[];
//            $mess[0]='ok';
//            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';
//
//
//            return $mess;
//        }
//        else
//        {
//            $meserr='';
//            $errors = $modelabonpokazn->getErrors();
//            foreach ($errors as $error) {
//                $meserr=$meserr.implode(",", $error);
//            }
//
//            $messageLog = [
//                'status' => 'Помилка додавання показника',
//                'post' => $modelabonpokazn->errors
//            ];
//
//            Yii::error($messageLog, 'viber_err');
//            $mess =[];
//            $mess[0]='err';
//            $mess[1]=$meserr;
//            return $mess;
//
//        }
//    } elseif ($lasdatehvd[0]['yearmon']==$nowdate)  {
//        $modelpokazn = new Pokazn();
//        $modelpokazn->schet = iconv('UTF-8', 'windows-1251', $_SESSION['abon']->schet);
//        $modelpokazn->yearmon =$nowdate;
//        $modelpokazn->date_pok = null;
//        $modelpokazn->vid_pok = 37;
//        $modelpokazn->pokazn = $pokazn;
//        if ($modelpokazn->validate())
//        {
//            /** @var TYPE_NAME $modelpokazn */
//
//            $modelpokazn->save();
//
//            Yii::$app->hvddb->createCommand("execute procedure calc_pok(:schet)")->bindValue(':schet', $modelpokazn->schet)->execute();
//            $voda = HVoda::find()->where(['schet' => $modelpokazn->schet])->orderBy(['kl' => SORT_DESC])->one();
//
//            $mess =[];
//            $mess[0]='ok';
//            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' зараховано! Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';
//
//
//            return $mess;
//        }
//        else
//        {
//            $meserr='';
//            $errors = $modelpokazn->getErrors();
//            foreach ($errors as $error) {
//                $meserr=$meserr.implode(",", $error);
//            }
//
//            $messageLog = [
//                'status' => 'Помилка додавання показника',
//                'post' => $modelpokazn->errors
//            ];
//
//            Yii::error($messageLog, 'viber_err');
//            $mess =[];
//            $mess[0]='err';
//            $mess[1]=$meserr;
//            return $mess;
//
//        }
//
//    }
//
//
//}

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


//echo substr("abcdefsgdergrgreg", 10);
//$text='add-pok#0092124д#6000#yes';
//
////preg_match( '/(?<=(#))(.+)/ui', $text, $match );
//preg_match_all('/([^#]+)/ui', $text, $match );
////    foreach ($match as $mm){
////        echo $mm."\r";
////    }
//
//if (count($match[0])==4 && $match[0][3]=='yes'){
//    echo 'ok';
//}
//
//if ('Ірина'=='Ірина'){
//    echo 'ok111';
//}

//var_dump($match);
//$i = 1;
//$mes='';
//while ($i <= 7000) {
//
//    $mes=$mes.'1';
//     $i++;  /* выводиться будет значение переменной
//                   $i перед её увеличением
//                   (post-increment) */
//}
//
//
//getSend($mes);



//$modelPokazn = KpcentrPokazn::findOne(['schet' => '0092124','status' => 1]);
//if ($modelPokazn!=null) {
//    $mess = $mess . "\r" . 'Останній показник по воді :' . "\r\n";
//    $mess = $mess . "Дата показника: " . date('d.m.Y',strtotime($modelPokazn->date_pok)) . ' - Показник: ' . $modelPokazn->pokazn . "\r\n" . "<font color=#F2AD50>Согласовать</font>";
//}
//
//echo $mess;

//$Receiv = Viber::findOne(2);
//
//$FindRah = $Receiv->getViberAbons()->all();
//if ($FindRah == null) echo 'null';
//else {
//    foreach ($FindRah as $Rah)
//    {
//        echo $Rah->schet;
//        $modelKart = UtKart::findOne(['schet' => $Rah->schet]);
////        echo $modelKart->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$modelKart->dom.' '.(isset($modelKart->kv)?"":Yii::t('easyii', 'ap.').$modelKart->kv)."\n";
//
//        $abonen = UtAbonent::find()->where(['schet' => $Rah->schet])->orderBy('id_org')->one();
//        $oplab=UtOpl::find()
//            ->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
//            ->where(['ut_opl.id_abonent'=> $abonen->id])
//            ->andwhere(['>', 'ut_opl.period', $modelKart->lastperiod()])
//            ->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
//            ->asArray();
//
//        $dolg= UtObor::find();
//        $dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
//        $dolg->where(['ut_obor.id_abonent'=> $abonen->id,'ut_obor.period'=> $modelKart->lastperiod()]);
//        $dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();
//
//        $summa = 0;
//        foreach($dolg->asArray()->all() as $obb)
//        {
//            if ($obb['dolgopl']>0)
//            {
//                $summa = $summa + $obb['dolgopl'];
//            }
//        }
//
//        echo $summa;
//    }
//}
