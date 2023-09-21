<?php

use yii\helpers\Html;

/* @var $model app\models\UtAuth */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['ut-abonent/confirm-signupviber', 'authtoken' => $model->authtoken]);
?>
<div class="password-reset">
    <p>Вітаємо <?= Html::encode($model->fio) ?>,</p>

    <p>Перейдіть за посиланням нижче, щоб завершити процедуру реєстрації в Viber:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
