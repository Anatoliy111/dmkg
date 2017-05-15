<?php

	use app\poslug\models\UtUlica;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
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
			<?= $form->field($model, 'id_ulica')->dropDownList
			(ArrayHelper::map(UtUlica::find()->all(), 'id', 'ul'),
				[
					'prompt' => Yii::t('easyii', 'Select the street...')
				]
			) ?>
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





    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
