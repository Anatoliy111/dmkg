<?php

	use yii\easyii\widgets\DateTimePicker;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLich */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lich-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_pokaz')->textInput() ?>

    <?= $form->field($model, 'period')->widget(DateTimePicker::className()); ?>

    <?= $form->field($model, 'data')->widget(DateTimePicker::className()); ?>

    <?= $form->field($model, 'pokaz_n')->textInput() ?>

    <?= $form->field($model, 'pokaz_k')->textInput() ?>

    <?= $form->field($model, 'rizn')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
