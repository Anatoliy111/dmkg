<?php

use app\poslug\models\UtTarifvid;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryad */
/* @var $form yii\widgets\ActiveForm */
?>

	<h4><?=Yii::$app->formatter->asDate($model->period, 'LLLL Y')?></h4>


<div class="ut-domnaryad-form">

    <?php $form = ActiveForm::begin(); ?>

<?=	$form->field($model, 'id_tarifvid')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(UtTarifvid::find()->all(), 'id', 'name'),
		'language' => 'uk',
		'options' => ['placeholder' => 'Вид тарифу'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>

	<?=	$form->field($model, 'id_sotr')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(\app\poslug\models\UtSotr::find()->all(), 'id', 'fio'),
		'language' => 'uk',
		'options' => ['placeholder' => 'Співробітник'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>


	<div class="form-group">
		<?= Html::submitButton('Далі', ['class' => 'btn btn-success']) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>
