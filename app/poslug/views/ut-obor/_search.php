<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtObor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-obor-search">

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

    <?php // echo $form->field($model, 'dolg') ?>

    <?php // echo $form->field($model, 'nach') ?>

    <?php // echo $form->field($model, 'subs') ?>

    <?php // echo $form->field($model, 'opl') ?>

    <?php // echo $form->field($model, 'uder') ?>

    <?php // echo $form->field($model, 'sal') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
