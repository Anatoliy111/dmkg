<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 17.02.2021
 * Time: 15:44
 */


//require_once("../vendor/autoload.php");
use app\poslug\models\Viber;

require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/console.php';
new yii\web\Application($yiiConfig);



echo substr("abcdefsgdergrgreg", 10);

$Receiv = Viber::findOne(['id' => 2]);

$FindRah = $Receiv->getViberAbons();
if ($FindRah == null) echo 'null';
else {
    foreach ($FindRah as $Rah)
    {
        echo $Rah;
    }
}
