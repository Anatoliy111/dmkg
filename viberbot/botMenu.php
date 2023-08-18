<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 23.03.2021
 * Time: 16:43
 */

require_once(__DIR__ . '/../vendor/autoload.php');

use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use app\models\UtKart;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtAbonkart;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;


function getKpMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('small')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#75C5F3")
                ->setText('📈  Інформація по ос.рахунках'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Pokazmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('♻  Операції з ос.рахунками'),


            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📞 Контактна інформація'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222381919%22,%22form%22:%7B%22query%22:%2233006271%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
        ]);

}

function getDmkgMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('small')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#F2F3A7")
                ->setText('📊  Інформація по рахунках'),

//            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(2)
//                //  ->setBgColor('#2fa4e7')
//                ->setTextHAlign('center')
//                ->setTextSize('small')
//                ->setActionType('reply')
//                ->setActionBody('Pokazmenu-button')
//                ->setBgColor("#75C5F3")
//                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
//                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#F2F3A7")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('⚙ Додати/видалити рахунок'),


            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📬 Контактна інформація'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
        ]);

}

function getMyMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('small')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#F2F3A7")
                ->setText('📊  Інформація по рахунках111'),

//            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(2)
//                //  ->setBgColor('#2fa4e7')
//                ->setTextHAlign('center')
//                ->setTextSize('small')
//                ->setActionType('reply')
//                ->setActionBody('Pokazmenu-button')
//                ->setBgColor("#75C5F3")
//                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
//                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#F2F3A7")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('⚙ Додати/видалити рахунок'),


            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📬 Контактна інформація'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📬 Вихід'),
        ]);

}

function infoDmkgSchet($schet){

    $mess='';
    $modelKart = UtKart::findOne(['schet' => $schet]);
    $mess = 'Особовий рахунок - '.$schet."\r\n";
    $mess = $mess.$modelKart->fio . "\n";
    $mess = $mess.$modelKart->getUlica()->asArray()->one()['ul'].' буд.'.$modelKart->dom.' '.(isset($modelKart->kv)?'кв.'.$modelKart->kv:'')."\r\n";
    $mess = $mess.'----------------------------'."\n";

    $abonen = UtAbonent::find()->where(['schet' => $schet])->orderBy('id_org')->one();
    $oplab=UtOpl::find()
        ->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
        ->where(['ut_opl.id_abonent'=> $abonen->id])
        ->andwhere(['>', 'ut_opl.period', $modelKart->lastperiod()])
        ->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
        ->asArray();

    $dolg= UtObor::find();
//					->select(["ut_obor.id_abonent as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
    $dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
//  				    $dolg->select('ut_obor.*,b.summ,');
    $dolg->where(['ut_obor.id_abonent'=> $abonen->id,'ut_obor.period'=> $modelKart->lastperiod()]);
    $dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();
    $mess = $mess.'Ваша заборгованість по послугам:'."\n\r";
    $summa =0;
    foreach($dolg->asArray()->all() as $obb)
    {
        $mess = $mess.$obb['tipposl'].' '.$obb['sal']."\n";

        if ($obb['dolgopl']>0)
        {
            $summa = $summa + $obb['dolgopl'];
        }
    }
    $mess = $mess.'----------------------------'."\n";

    $mess = $mess."\r".'Всього до сплати: '.$summa."\n";


    return $mess;

}

function infoKpSchet($schet){

    $mess='';
    $modelObor = KpcentrObor::findOne(['schet' => $schet,'status' => 1]);
    $mess = 'Особовий рахунок - '.$schet."\n";
    $mess = $mess.$modelObor->fio .' '.$modelObor->im.' '.$modelObor->ot. "\n";
    $mess = $mess.$modelObor->ulnaim.' буд.'.$modelObor->nomdom.' '.(isset($modelObor->nomkv)?'кв.'.$modelObor->nomkv:'')."\n";

    $dolg= KpcentrObor::find();
//					->select(["ut_obor.id_abonent as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
    $dolg->select(["kpcentr_obor.*"]);
//  				    $dolg->select('ut_obor.*,b.summ,');
    $dolg->where(['kpcentr_obor.schet'=> $schet,'status' => 1])->all();
    $mess = $mess.'----------------------------'."\n";


    $summa =0;
    foreach($dolg->asArray()->all() as $obb)
    {
        if ($obb['sal']>=0) $mess = $mess.'Ваша заборгованість по послузі:'."\n";
        else $mess = $mess.'Ваша передплата по послузі:'."\n";
        $mess = $mess.$obb['naim_wid'].': '.$obb['sal']."грн \n";

        if ($obb['sal']>0)
        {
            $summa = $summa + $obb['sal'];
        }
    }


    // $mess = $mess."\r".'Всього до сплати: '.$summa."\n\r";
    $mess = $mess.'----------------------------'."\n";
    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    if ($modelPokazn!=null){
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn->date_pok))."\n";
        $mess = $mess.'Показник: '.$modelPokazn->pokazn."\n";
    }




    return $mess;

}