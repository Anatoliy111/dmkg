<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUtrim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-utrim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_posl')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->textInput() ?>

    <?= $form->field($model, 'id_vidutr')->textInput() ?>

    <?= $form->field($model, 'id_rabota')->textInput() ?>

    <?= $form->field($model, 'summa')->textInput() ?>

    <?= $form->field($model, 'procent')->textInput() ?>

    <?= $form->field($model, 'data_n')->textInput() ?>

    <?= $form->field($model, 'data_k')->textInput() ?>

    <?= $form->field($model, 'zayav')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_vrem')->textInput() ?>

    <?= $form->field($model, 'activ')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
