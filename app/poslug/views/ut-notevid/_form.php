<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNotevid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-notevid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tarifvid')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
