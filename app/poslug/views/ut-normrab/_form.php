<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNormrab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-normrab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tarifvid')->textInput() ?>

    <?= $form->field($model, 'shifr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'naim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ed_izm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'norma')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
