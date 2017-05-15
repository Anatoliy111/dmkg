<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtLich */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lich-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'id_abonent') ?>

    <?= $form->field($model, 'id_pokaz') ?>

    <?= $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'pokaz_n') ?>

    <?php // echo $form->field($model, 'pokaz_k') ?>

    <?php // echo $form->field($model, 'rizn') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
