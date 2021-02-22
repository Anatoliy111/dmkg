<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


//require_once("../vendor/autoload.php");
use app\poslug\models\UtAbonent;
use app\models\UtKart;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\Viber;

require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/console.php';
new yii\web\Application($yiiConfig);



echo substr("abcdefsgdergrgreg", 10);

$Receiv = Viber::findOne(2);

$FindRah = $Receiv->getViberAbons()->all();
if ($FindRah == null) echo 'null';
else {
    foreach ($FindRah as $Rah)
    {
        echo $Rah->schet;
        $modelKart = UtKart::findOne(['schet' => $Rah->schet]);
//        echo $modelKart->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$modelKart->dom.' '.(isset($modelKart->kv)?"":Yii::t('easyii', 'ap.').$modelKart->kv)."\n";

        $abonen = UtAbonent::find()->where(['schet' => $Rah->schet])->orderBy('id_org')->one();
        $oplab=UtOpl::find()
            ->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
            ->where(['ut_opl.id_abonent'=> $abonen->id])
            ->andwhere(['>', 'ut_opl.period', $modelKart->lastperiod()])
            ->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
            ->asArray();

        $dolg= UtObor::find();
        $dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
        $dolg->where(['ut_obor.id_abonent'=> $abonen->id,'ut_obor.period'=> $modelKart->lastperiod()]);
        $dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();

        $summa = 0;
        foreach($dolg->asArray()->all() as $obb)
        {
            if ($obb['dolgopl']>0)
            {
                $summa = $summa + $obb['dolgopl'];
            }
        }

        echo $summa;
    }
}
