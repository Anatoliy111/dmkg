<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtObor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-obor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_posl')->textInput() ?>

    <?= $form->field($model, 'dolg')->textInput() ?>

    <?= $form->field($model, 'nach')->textInput() ?>

    <?= $form->field($model, 'subs')->textInput() ?>

    <?= $form->field($model, 'opl')->textInput() ?>

    <?= $form->field($model, 'pere')->textInput() ?>

    <?= $form->field($model, 'sal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
