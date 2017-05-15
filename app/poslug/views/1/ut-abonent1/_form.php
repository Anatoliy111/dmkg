<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAbonent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-abonent-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id_kart')->dropDownList(
//		ArrayHelper::map($kart, 'ID_driver', 'Family_name')?>

    <?= $form->field($model, 'schet')->textInput() ?>

    <?= $form->field($model, 'FIO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
