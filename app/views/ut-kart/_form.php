<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UtKart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-kart-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_o')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ulica')->textInput() ?>

    <?= $form->field($model, 'dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'korp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kv')->textInput() ?>

    <?= $form->field($model, 'ur_fiz')->textInput() ?>

    <?= $form->field($model, 'pass')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telef')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_oldkart')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
