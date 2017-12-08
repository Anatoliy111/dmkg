<?php

	use app\poslug\models\UtUlica;
	use kartik\datecontrol\DateControl;
	use kartik\select2\Select2;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomzatrat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domzatrat-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'id_ulica')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(UtUlica::find()->all(), 'id', 'ul'),
		'language' => 'uk',
		'options' => ['placeholder' => Yii::t('easyii', 'Select the street...')],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>

    <?= $form->field($model, 'dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


	<?= $form->field($model, 'date')->widget(DateControl::classname(), [
		'type'=>DateControl::FORMAT_DATE,
		'ajaxConversion'=>false,
		'displayFormat' => 'dd/MM/yyyy',
//		'displayFormat' => 'php:D',
		'widgetOptions' => [
			'pluginOptions' => [
				'autoclose' => true
			]
		]
	]) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
