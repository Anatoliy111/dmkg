<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryadmat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domnaryadmat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_naryad')->textInput() ?>

    <?= $form->field($model, 'id_normrab')->textInput() ?>

    <?= $form->field($model, 'nom_n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'naim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ed_izm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kol')->textInput() ?>

    <?= $form->field($model, 'cena')->textInput() ?>

    <?= $form->field($model, 'summa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
