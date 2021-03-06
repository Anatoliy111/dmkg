<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtLgot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lgot-search">

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

    <?= $form->field($model, 'id_vidlgot') ?>

    <?php // echo $form->field($model, 'fio') ?>

    <?php // echo $form->field($model, 'posv_ser') ?>

    <?php // echo $form->field($model, 'date_n') ?>

    <?php // echo $form->field($model, 'date_k') ?>

    <?php // echo $form->field($model, 'kat') ?>

    <?php // echo $form->field($model, 'flag_vrem') ?>

    <?php // echo $form->field($model, 'activ') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
