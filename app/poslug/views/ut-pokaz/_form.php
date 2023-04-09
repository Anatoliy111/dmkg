<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPokaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-pokaz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_vidpokaz')->textInput() ?>

    <?= $form->field($model, 'pokaznik')->textInput() ?>

    <?= $form->field($model, 'nser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_vstan')->textInput() ?>

    <?= $form->field($model, 'date_pov')->textInput() ?>

    <?= $form->field($model, 'flag_lich')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
