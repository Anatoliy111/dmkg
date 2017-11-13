<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtNarah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-narah-search">

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

    <?= $form->field($model, 'id_abonent') ?>

    <?= $form->field($model, 'id_posl') ?>

    <?php // echo $form->field($model, 'id_tipposl') ?>

    <?php // echo $form->field($model, 'tipposl') ?>

    <?php // echo $form->field($model, 'id_vidlgot') ?>

    <?php // echo $form->field($model, 'lgot') ?>

    <?php // echo $form->field($model, 'tarif') ?>

    <?php // echo $form->field($model, 'id_vidpokaz') ?>

    <?php // echo $form->field($model, 'vidpokaz') ?>

    <?php // echo $form->field($model, 'pokaznik') ?>

    <?php // echo $form->field($model, 'ed_izm') ?>

    <?php // echo $form->field($model, 'nnorma') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
