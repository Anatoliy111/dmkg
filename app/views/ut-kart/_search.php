<?php

	use app\poslug\models\UtUlica;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchUtKart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-kart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

	<div class="row">

		<div class="col-sm-3">
			<?= $form->field($model, 'id_ulica')->widget(Select2::classname(), [
				'data' => ArrayHelper::map(UtUlica::find()->all(), 'id', 'ul'),
				'language' => 'uk',
				'options' => ['placeholder' => Yii::t('easyii', 'Select the street...')],
				'pluginOptions' => [
					'allowClear' => true
				],
			]);
			 ?>
		</div>
		<div class="col-sm-2">
			<?= $form->field($model, 'dom')?>
		</div>
		<div class="col-sm-1">
			<?=  $form->field($model, 'korp')->dropDownList([
				'а'=>'а','б'=>'б','в'=>'в','г'=>'г'
			],
				[
					'prompt' => Yii::t('easyii', 'Select the body if there is...')
				]); ?>
		</div>
		<div class="col-sm-2">
			<?= $form->field($model, 'kv') ?>

		</div>
	</div>
	<?php
		if ($dataProvider->getTotalCount() <> 0) {
	?>

	<div class="row">
		<div class="col-sm-3">

			<?php
				$form->field($model, 'enterpass')->textInput();
			?>

<!--			fdgsdfhdfsjfjfdj-->

		</div>
	</div>
	<?php
		}
	?>



    <div class="form-group">
		<?= Html::submitButton('Далі',['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
