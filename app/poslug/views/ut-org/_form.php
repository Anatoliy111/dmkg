<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-org-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'naim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'naim_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edrpou')->textInput() ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
