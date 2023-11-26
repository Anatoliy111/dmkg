<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\models\UtAuth */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/ut-abonent/confirm-signupviber', 'authtoken' => $model->authtoken,'idreceiv' => $model->id_receiver]);
$confirmLink = str_replace('viberbot/','',$confirmLink);

?>
<div class="password-reset">
    <p>Вітаємо <?= Html::encode($model->fio) ?>,</p>

    <p>Перейдіть за посиланням нижче, щоб завершити процедуру реєстрації в кабінеті споживача через Viberbot:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

    <p>Ваш пароль: <?= Html::encode($model->pass)?>:</p>
</div>
