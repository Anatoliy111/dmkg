<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUlica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-ulica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'st_ul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_olddom')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
