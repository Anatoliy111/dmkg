<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifplan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarifplan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_dom')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->textInput() ?>

    <?= $form->field($model, 'id_vidpokaz')->textInput() ?>

    <?= $form->field($model, 'tarifplan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
