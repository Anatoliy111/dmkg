<?php

/* @var $model app\models\UtAuth */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/signup-confirm', 'token' => $model->authtoken]);
?>
Hello <?= $model->fio ?>,

Follow the link below to confirm your email:

<?= $confirmLink ?>
