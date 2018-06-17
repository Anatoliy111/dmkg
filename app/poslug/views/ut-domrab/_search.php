<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDomrab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domrab-search">

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

    <?php // echo $form->field($model, 'ed_izm') ?>

    <?php // echo $form->field($model, 'norm_ed') ?>

    <?php // echo $form->field($model, 'kol_day') ?>

    <?php // echo $form->field($model, 'obiem') ?>

    <?php // echo $form->field($model, 'norm_chas') ?>

    <?php // echo $form->field($model, 'notevid') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <?php // echo $form->field($model, 'proveden') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
