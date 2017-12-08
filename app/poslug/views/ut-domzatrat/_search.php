<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDomzatrat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domzatrat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?//= $form->field($model, 'id_ulica') ?>

    <?= $form->field($model, 'dom') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
