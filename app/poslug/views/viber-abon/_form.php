<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\ViberAbon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viber-abon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_viber')->textInput() ?>

    <?= $form->field($model, 'org')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_utkart')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
