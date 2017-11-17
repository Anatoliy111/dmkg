<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-auth-form">

    <?php $form = ActiveForm::begin(); ?>



	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'telef')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'schet')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'fio_p')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'fio_i')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'fio_b')->textInput(['maxlength' => true]) ?>


	<?= $form->field($model, 'pass1')->passwordInput() ?>

	<?= $form->field($model, 'pass2')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
