<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtTarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'id_tipposl') ?>

    <?= $form->field($model, 'id_vidpokaz') ?>

    <?= $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'tarif1') ?>

    <?php // echo $form->field($model, 'tarif2') ?>

    <?php // echo $form->field($model, 'tarif3') ?>

    <?php // echo $form->field($model, 'koef_skl') ?>

    <?php // echo $form->field($model, 'norma') ?>

    <?php // echo $form->field($model, 'normalgot') ?>

    <?php // echo $form->field($model, 'normalgotsm') ?>

    <?php // echo $form->field($model, 'activ') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
