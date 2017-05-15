<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidutrim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-vidutrim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vidutrim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_vrem')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
