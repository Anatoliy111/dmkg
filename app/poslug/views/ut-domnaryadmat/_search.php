<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDomnaryadmat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domnaryadmat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_naryad') ?>

    <?= $form->field($model, 'id_normrab') ?>

    <?= $form->field($model, 'nom_n') ?>

    <?= $form->field($model, 'naim') ?>

    <?php // echo $form->field($model, 'ed_izm') ?>

    <?php // echo $form->field($model, 'kol') ?>

    <?php // echo $form->field($model, 'cena') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
