<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtKart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-kart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_f') ?>

    <?= $form->field($model, 'name_i') ?>

    <?= $form->field($model, 'name_o') ?>

    <?= $form->field($model, 'fio') ?>

    <?php // echo $form->field($model, 'idcod') ?>

    <?php // echo $form->field($model, 'id_ulica') ?>

    <?php // echo $form->field($model, 'dom') ?>

    <?php // echo $form->field($model, 'korp') ?>

    <?php // echo $form->field($model, 'kv') ?>

    <?php // echo $form->field($model, 'ur_fiz') ?>

    <?php // echo $form->field($model, 'pass') ?>

    <?php // echo $form->field($model, 'telef') ?>

    <?php // echo $form->field($model, 'id_oldkart') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
