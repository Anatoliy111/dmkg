<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtOpl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-opl-search">

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

    <?php // echo $form->field($model, 'dt') ?>

    <?php // echo $form->field($model, 'pach') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
