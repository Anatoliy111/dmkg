<?php

	use kartik\date\DatePicker;
	use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domnaryad-form">

    <?php $form = ActiveForm::begin(); ?>



	<?= $form->field($model, 'period')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Виберіть місяць'],
		//			'attribute2'=>'to_date',
		'type' => DatePicker::TYPE_INPUT,
		'pluginOptions' => [
			'autoclose' => true,
			'startView'=>'year',
			'minViewMode'=>'months',
//    				'format' => 'dd-mm-yyyy'
			'format' => 'yyyy-mm-dd'
		]
	])?>

    <?= $form->field($model, 'id_tarifvid')->textInput() ?>


	<?php  echo $this->render('rabota', ['dataProvider' => $DPrabota]); ?>

	<?php  echo $this->render('mater', ['dataProvider' => $DPmat]); ?>

    <?= $form->field($model, 'id_sotr')->textInput() ?>

<!--    --><?//= $form->field($model, 'summa')->textInput() ?>

    <div class="form-group">









    </div>

    <?php ActiveForm::end(); ?>

</div>
