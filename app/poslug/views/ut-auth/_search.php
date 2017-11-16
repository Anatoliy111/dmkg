<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\SearchUtAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-auth-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'id_kart') ?>

    <?= $form->field($model, 'fio_p') ?>

    <?= $form->field($model, 'fio_i') ?>

    <?php // echo $form->field($model, 'fio_b') ?>

    <?php // echo $form->field($model, 'passw') ?>

    <?php // echo $form->field($model, 'telef') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
