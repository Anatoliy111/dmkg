<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDommat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-dommat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'period') ?>

    <?= $form->field($model, 'id_dom') ?>

    <?= $form->field($model, 'id_tarifvid') ?>

    <?php // echo $form->field($model, 'id_naryad') ?>

    <?php // echo $form->field($model, 'id_normrab') ?>

    <?php // echo $form->field($model, 'nom_n') ?>

    <?php // echo $form->field($model, 'naim') ?>

    <?php // echo $form->field($model, 'ed_izm') ?>

    <?php // echo $form->field($model, 'kol') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <?php // echo $form->field($model, 'proveden') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
