<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtTarifinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarifinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tarif') ?>

    <?= $form->field($model, 'id_tarifvid') ?>

    <?= $form->field($model, 'tarifplan') ?>

    <?= $form->field($model, 'tariffakt') ?>

    <?php // echo $form->field($model, 'tarifend') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
