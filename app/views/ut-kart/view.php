<?php

	use yii\bootstrap\Button;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ActiveForm;
	use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UtKart */

$this->title = $model->fio;

?>
<div class="ut-kart-view">

    <h1><?= Html::encode($this->title) ?></h1>





	<?php $form = ActiveForm::begin([
//			'enableAjaxValidation'=>true,
		'action' => ['kabinet', 'id'=>$model->id],
		'options' => [
			'id' => 'search-form',
			'method' => 'get',
		],
	'validateOnSubmit'=>true,

	]);


	?>


		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [

				'fio',


				[
					'label' => Yii::t('easyii', 'Adress'),

					'value' => $model->getUlica()->asArray()->one()['ul'].Yii::t('easyii', ' house №').$model->dom.Yii::t('easyii', ' ap.').$model->kv,
				],
			],

		]) ?>

	<div class="row">
		<div class="col-sm-3">
		<?php if ($this->context->action->actionMethod == "actionIndex"): ?>
			<?=
			$form->field($model, 'enterpass')->textInput();
			?>

			       <?= Html::submitButton('Далі',['class' => 'btn btn-primary']) ?>



		<?php endif; ?>
		</div>
	</div>
		<?php ActiveForm::end(); ?>

</div>
