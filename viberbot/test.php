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

require_once(__DIR__ . '/../vendor/autoload.php');
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/web.php';
new yii\web\Application($yiiConfig);
require_once(__DIR__ . '\botMenu.php');

//echo infoDmkgSchet('0014001');
$schet='7020006а';
$session = Yii::$app->session;
//$session->destroy();
$event='12345';

//echo addPokazn(802,'0092124','asfsadfasdf');

if (array_key_exists('addabon',$_SESSION)) {
    $modelemail=$session['addabon'];
}
else $modelemail = new UtAbonent();

$modelemail->scenario = 'reg';
$modelemail->email='sdfs@sdf.com';
$key='';
if (!$modelemail->validate()) {
   $err=$modelemail->getErrors();
   if (array_key_exists('fio',$err)) $modelemail->fio = $event;
   elseif (array_key_exists('pass1',$err)) $modelemail->pass1 = $event;
   elseif (array_key_exists('pass2',$err)) $modelemail->pass2 = $event;

}
if ($modelemail->validate()) {

        echo 'Вітаємо '.$modelemail->fio.'! Ви здійснили реєстрацію в кабінеті споживача ДМКГ. На вашу пошту '.$modelemail->email.' вислано лист для підтвердження реєстрації!!!';

}
else {
    $err = $modelemail->getErrors();
    $session['addabon']=$modelemail;
    if (array_key_exists('fio',$err)) echo $err['fio'][0];
    elseif (array_key_exists('pass1',$err)) echo $err['pass1'][0];
    elseif (array_key_exists('pass2',$err)) echo $err['pass2'][0];

}



function addPokazn($pokazn, $schet, $viber_name){

    $lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll();
    $nowdate = intval(date('Y').date('m'));

    if ($lasdatehvd[0]['yearmon']<$nowdate) {
        $modelabonpokazn = new UtAbonpokazn();
        $modelabonpokazn->schet = $schet;
        $modelabonpokazn->name = $viber_name;
        $modelabonpokazn->id_abonent = 2071;
        $modelabonpokazn->date_pok = date("Y-m-d");
        $modelabonpokazn->pokazn = $pokazn;
        $modelabonpokazn->vid = 'viber';
        if ($modelabonpokazn->validate())
        {
            /** @var TYPE_NAME $modelabonpokazn */

            $modelabonpokazn->save();
            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';


            return $mess;
        }
        else
        {
            $meserr='';
            $errors = $modelabonpokazn->getErrors();
            foreach ($errors as $error) {
                $meserr=$meserr.implode(",", $error);
            }

            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelabonpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }
    } elseif ($lasdatehvd[0]['yearmon']==$nowdate)  {
        $modelpokazn = new Pokazn();
        $modelpokazn->schet = iconv('UTF-8', 'windows-1251', $_SESSION['abon']->schet);
        $modelpokazn->yearmon =$nowdate;
        $modelpokazn->date_pok = null;
        $modelpokazn->vid_pok = 37;
        $modelpokazn->pokazn = $pokazn;
        if ($modelpokazn->validate())
        {
            /** @var TYPE_NAME $modelpokazn */

            $modelpokazn->save();

            Yii::$app->hvddb->createCommand("execute procedure calc_pok(:schet)")->bindValue(':schet', $modelpokazn->schet)->execute();
            $voda = HVoda::find()->where(['schet' => $modelpokazn->schet])->orderBy(['kl' => SORT_DESC])->one();

            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' зараховано! Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';


            return $mess;
        }
        else
        {
            $meserr='';
            $errors = $modelpokazn->getErrors();
            foreach ($errors as $error) {
                $meserr=$meserr.implode(",", $error);
            }

            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }

    }


}

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
