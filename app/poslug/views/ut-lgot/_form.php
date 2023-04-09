<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLgot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lgot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_vidlgot')->textInput() ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'posv_ser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_n')->textInput() ?>

    <?= $form->field($model, 'date_k')->textInput() ?>

    <?= $form->field($model, 'kat')->textInput() ?>

    <?= $form->field($model, 'flag_vrem')->textInput() ?>

    <?= $form->field($model, 'activ')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
