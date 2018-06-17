<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPostach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-postach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'postach')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edrpou')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
