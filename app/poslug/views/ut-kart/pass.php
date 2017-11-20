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

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="ut-pass-view">

	<?php Pjax::begin(); ?>

    <h1><?= Html::encode($this->title) ?></h1>


	<?php $form = ActiveForm::begin([
		'id' => 'pass-form',
		'enableAjaxValidation' => true,
	]); ?>

	<?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
		'pluginOptions'=>[
			'size' => 'large',
			'onText'=>'Авторизований',
			'offText'=>'Не авторизований',
			'onColor' => 'success',
			'offColor' => 'danger',
		]]); ?>


			<?=	 $form->field($model, 'pass1')->passwordInput(['maxlength' => true])?>
			<?=    $form->field($model, 'pass2')->passwordInput(['maxlength' => true])?>
	<div class="buttons" style="padding-bottom: 20px">
		<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
		<?= Html::submitButton(Yii::t('easyii', 'Save and Print'), ['class' => 'btn btn-success','name' => 'print', 'value' => 'true']) ?>
	</div>
			<?php
		 ActiveForm::end();
	?>

	<?php Pjax::end(); ?>

</div>
