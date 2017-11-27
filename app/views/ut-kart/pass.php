<?php


	use kartik\detail\DetailView;
	use kartik\dialog\Dialog;

	use kartik\form\ActiveForm;
	use kartik\grid\GridView;

	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;
	use \kartik\switchinput\SwitchInput;
	use yii\widgets\Pjax;


	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */


?>



<div class="ut-pass-view">

	<?php Pjax::begin(); ?>

    <h1><?= Html::encode($this->title) ?></h1>


	<?php $form = ActiveForm::begin([
		'id' => 'pass-form1',
		'enableAjaxValidation' => true,
	]); ?>

			<?=	 $form->field($model, 'pass1')->passwordInput(['maxlength' => true])?>
			<?=    $form->field($model, 'pass2')->passwordInput(['maxlength' => true])?>
	<div class="buttons" style="padding-bottom: 20px">
		<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>
			<?php
		 ActiveForm::end();
	?>

	<?php Pjax::end(); ?>

</div>
