<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;

	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-auth-form">
<!--	--><?php //Pjax::begin(); ?>
	<div class="col-sm-6">
	<div class="well well-large">

    <?php $form = ActiveForm::begin(); ?>




<!--		<div class="col-sm-6">-->
<!--			--><?//= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<!--		</div>-->
<!--		<div class="col-sm-6">-->
<!--			--><?//= $form->field($model, 'telef')->textInput(['maxlength' => true]) ?>
<!--		</div>-->
<!---->
<!--		<div class="col-sm-4">-->
<!--			--><?//= $form->field($model, 'fio_p')->textInput(['maxlength' => true]) ?>
<!--		</div>-->
<!--		<div class="col-sm-4">-->
<!--			--><?//= $form->field($model, 'fio_i')->textInput(['maxlength' => true]) ?>
<!--		</div>-->
<!--		<div class="col-sm-4">-->
<!---->
<!--			--><?//= $form->field($model, 'fio_b')->textInput(['maxlength' => true]) ?>
<!--		</div>-->
<!--		<div class="col-sm-6">-->
<!---->
<!--			--><?//= $form->field($model, 'pass1')->passwordInput() ?>
<!--		</div>-->
<!--		<div class="col-sm-6">-->
<!--			--><?//= $form->field($model, 'pass2')->passwordInput() ?>
<!--		</div>-->
<!--		<div class="col-md-2">-->



			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'telef')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($model, 'schet')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'fio_p')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'fio_i')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'fio_b')->textInput(['maxlength' => true]) ?>


			<?= $form->field($model, 'pass1')->passwordInput() ?>

			<?= $form->field($model, 'pass2')->passwordInput() ?>


			<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>






<!--    <div class="form-group">-->





<!--			--><?//= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>




<!--		</div>-->
    <?php ActiveForm::end(); ?>

	</div>



	</div>

<!--	--><?php //Pjax::end(); ?>
</div>
