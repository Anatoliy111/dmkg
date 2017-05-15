<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtEdizm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-edizm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'edizm')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
