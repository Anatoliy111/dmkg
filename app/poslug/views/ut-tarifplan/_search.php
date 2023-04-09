<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtTarifplan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarifplan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'period') ?>

    <?= $form->field($model, 'id_dom') ?>

    <?= $form->field($model, 'id_tipposl') ?>

    <?= $form->field($model, 'id_vidpokaz') ?>

    <?php // echo $form->field($model, 'tarifplan') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
