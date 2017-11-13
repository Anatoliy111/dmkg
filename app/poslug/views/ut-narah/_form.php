<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNarah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-narah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_posl')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->textInput() ?>

    <?= $form->field($model, 'tipposl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_vidlgot')->textInput() ?>

    <?= $form->field($model, 'lgot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif')->textInput() ?>

    <?= $form->field($model, 'id_vidpokaz')->textInput() ?>

    <?= $form->field($model, 'vidpokaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pokaznik')->textInput() ?>

    <?= $form->field($model, 'ed_izm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nnorma')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
