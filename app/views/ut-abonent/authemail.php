<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ut-abonent-email">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
//        'options' => [
//            'data-pjax' => 1
//        ],
    ]); ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'pass')->passwordInput(); ?>


    <div class="form-group">
        <?= Html::submitButton('Далі',['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

