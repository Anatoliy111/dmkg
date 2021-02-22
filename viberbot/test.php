<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


//require_once("../vendor/autoload.php");
use app\poslug\models\UtKart;
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
        echo $modelKart->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$modelKart->dom.' '.(isset($modelKart->kv)?"":Yii::t('easyii', 'ap.').$modelKart->kv)."\n";
    }
}
