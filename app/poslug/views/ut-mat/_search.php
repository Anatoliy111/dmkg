<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtMat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-mat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nom_n') ?>

    <?= $form->field($model, 'naim') ?>

    <?= $form->field($model, 'ed_izm') ?>

    <?= $form->field($model, 'kol') ?>

    <?php // echo $form->field($model, 'cena') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <?php // echo $form->field($model, 'ostat') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
