<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtMat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-mat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nom_n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'naim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ed_izm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kol')->textInput() ?>

    <?= $form->field($model, 'cena')->textInput() ?>

    <?= $form->field($model, 'summa')->textInput() ?>

    <?= $form->field($model, 'ostat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
