<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifvid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarifvid-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'id_tipposl')->dropDownList
	(ArrayHelper::map(\app\poslug\models\UtTipposl::find()->all(), 'id', 'poslug'),
		[
			'prompt' => Yii::t('easyii', 'Select the poslug...')
		]
	) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
