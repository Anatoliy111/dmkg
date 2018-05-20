<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarifinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tarif')->textInput() ?>

    <?= $form->field($model, 'id_tarifvid')->textInput() ?>

    <?= $form->field($model, 'tarifplan')->textInput() ?>

    <?= $form->field($model, 'tariffakt')->textInput() ?>

    <?= $form->field($model, 'tarifend')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
