<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtSubs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-subs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
