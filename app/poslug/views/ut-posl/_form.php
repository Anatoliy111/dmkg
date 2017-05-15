<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPosl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-posl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->textInput() ?>

    <?= $form->field($model, 'flag_vrem')->textInput() ?>

    <?= $form->field($model, 'date_n')->textInput() ?>

    <?= $form->field($model, 'date_k')->textInput() ?>

    <?= $form->field($model, 'n_dog')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_dog')->textInput() ?>

    <?= $form->field($model, 'nnorma')->textInput() ?>

    <?= $form->field($model, 'flag_dom')->textInput() ?>

    <?= $form->field($model, 'id_dom')->textInput() ?>

    <?= $form->field($model, 'activ')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
