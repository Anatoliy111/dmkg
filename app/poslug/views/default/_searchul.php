<?php

use app\poslug\models\DolgUl;
use kartik\select2\Select2;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-ul-search">

    <?php $form = ActiveForm::begin([
        'action' => ['smitpc'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

	<div class="col-sm-12">
		<?= $form->field($model, 'kl_ul')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(DolgUl::getUL(), 'kl', 'ul'),
			'language' => 'uk',
			'options' => ['placeholder' => Yii::t('easyii', 'Select the street...'),'onchange'=>'buttul.click()'],
             'pluginOptions' => [
				'allowClear' => true
			],
		]);
		?>
		<div class="form-group">
			<?= Html::submitButton('fsdfasdf', ['class' => 'btn btn-primary','id'=>'buttul','style'=>"display:none"]) ?>
		</div>
	</div>




    <?php ActiveForm::end(); ?>

</div>
