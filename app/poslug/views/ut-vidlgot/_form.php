<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidlgot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-vidlgot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'lgota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lgota_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razmer')->textInput() ?>

    <?= $form->field($model, 'kod_subs')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
