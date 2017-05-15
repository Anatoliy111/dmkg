<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOlddom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-olddom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ul')->textInput() ?>

    <?= $form->field($model, 'dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ndom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'real_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pod')->textInput() ?>

    <?= $form->field($model, 'rajon')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
