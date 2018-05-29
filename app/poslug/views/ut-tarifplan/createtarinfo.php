<?php

	use app\poslug\models\UtTarif;
	use app\poslug\models\UtTarifvid;
	use app\poslug\models\UtUlica;
	use kartik\select2\Select2;
	use yii\bootstrap\Modal;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ActiveForm;


	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifinfo */

//$this->title = Yii::t('easyii', 'Create Ut Tarifinfo');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifinfos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="ut-tarifinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin([
		'enableAjaxValidation' => true,
		'validationUrl' => Url::toRoute(['ut-tarifplan/validate','id'=>$model->id_tarifplan]),

//		'data-pjax' => '1',

	]); ?>

	<?=

		$form->field($model, 'id_tarifvid')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(UtTarifvid::find()->all(), 'id', 'name'),
		'language' => 'uk',
		'options' => ['placeholder' => 'Вид тарифу'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>

	<?= $form->field($model, 'tarifplan')->textInput() ?>

<!--	--><?//= $form->field($model, 'tariffakt')->textInput() ?>
<!---->
<!--	--><?//= $form->field($model, 'tarifend')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success','data-pjax' => '1']) ?>
	</div>

	<?php ActiveForm::end(); ?>



</div>
