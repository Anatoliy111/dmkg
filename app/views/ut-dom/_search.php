<?php

use app\models\DolgUl;
use kartik\select2\Select2;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use app\poslug\models\UtUlica;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-dom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

	<div class="col-sm-12">
		<?= $form->field($model, 'kl_ul')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(DolgUl::getUL(), 'kl', 'ul'),
			'language' => 'uk',
			'options' => ['placeholder' => Yii::t('easyii', 'Select the street...')],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);
		?>
		<div class="form-group">
			<?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
		</div>
	</div>




    <?php ActiveForm::end(); ?>

</div>
