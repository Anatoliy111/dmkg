<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ut-abonent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'schet') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'id_kart') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'val') ?>

    <?php // echo $form->field($model, 'del') ?>

    <?php // echo $form->field($model, 'pass') ?>

    <?php // echo $form->field($model, 'date_pass') ?>

    <?php // echo $form->field($model, 'passopen') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telefon') ?>

    <?php // echo $form->field($model, 'date_entry') ?>

    <?php // echo $form->field($model, 'vb_api_key') ?>

    <?php // echo $form->field($model, 'vb_date') ?>

    <?php // echo $form->field($model, 'vb_org') ?>

    <?php // echo $form->field($model, 'vb_receiver') ?>

    <?php // echo $form->field($model, 'vb_name') ?>

    <?php // echo $form->field($model, 'vb_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
