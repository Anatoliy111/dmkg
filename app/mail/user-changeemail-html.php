<?php

use yii\helpers\Html;

/* @var $model app\models\UtAuth */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['ut-abonent/confirm-pass', 'authtoken' => $model->authtoken]);
?>
<div class="password-reset">
    <p>Вітаємо <?= Html::encode($model->fio) ?>,</p>

    <p>Перейдіть за посиланням нижче, щоб підтвердити зміну електронної пошти:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
