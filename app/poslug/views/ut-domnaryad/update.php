<?php

use app\poslug\models\UtTarifvid;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryad */

$this->title = Yii::t('easyii', 'Ut Domnaryads', [
    'modelClass' => 'Ut Domnaryad',
]) .' №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domnaryads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Ut Domnaryads').' №'.$model->id;
?>
<div class="ut-domnaryad-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<h4><?=Yii::$app->formatter->asDate($model->period, 'LLLL Y')?></h4>

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
