<?php

	use kartik\date\DatePicker;
	use kartik\nav\NavX;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\helpers\Url;
	use yii\bootstrap\Tabs;
	use yii\bootstrap\Dropdown;
	use yii\bootstrap\ActiveForm;
	use yii\widgets\Menu;
	use yii\widgets\Pjax;

	//	use yii\bootstrap\

/* @var $this yii\web\View */




?>




<div class="utkart-view">




	<?php Pjax::begin(); ?>
	<div class="well well-large">
	<h3 class="text-center">Кабінет споживача</h3>


	<div class="row">
		<div class="col-sm-4 pull-right">

			<?php

			    $form = ActiveForm::begin([
				'id'=>'period',
				'action' => [$this->context->action->id, 'id' => Yii::$app->request->get('id')],
				'options' => [
//					'enctype' => 'multipart/form-data',
						'data-pjax' => true,
//	'enableAjaxValidation'=>true,
					'validateOnSubmit'=>true,
				]]);?>



		<?=$form->field($model, 'MonthYear')->widget(DatePicker::classname(), [
			'options' => ['placeholder' => 'Виберіть місяць...'],
			'type' => DatePicker::TYPE_INPUT,
			'pluginOptions' => [
				'autoclose' => true,
				'startView'=>'year',
				'minViewMode'=>'months',
				'format' => 'mm-yyyy',
			]])?>




			<?= Html::submitButton('Далі', ['class' => 'btn btn-success']) ?>

			<?php $form = ActiveForm::end()?>
		</div>


		<div class="col-sm-12">

	<?php

		echo NavX::widget([
			'options'=>['class'=>'navbar-brand nav-pills'],
			'items' => [
				['label' => 'Загальна інформація', 'url' => ['info', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['info']),],
				['label' => 'Послуги', 'url' => ['poslug', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['poslug']),],
				['label' => 'Нарахування', 'url' => ['nar', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['nar']),],
				['label' => 'Оплата', 'url' => ['opl', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['opl']),],
				['label' => 'Зведена відомість', 'url' => ['obor', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['obor']),],
//				['label' => 'Історія', 'url' => ['his', 'id' => Yii::$app->request->get('id')],'active' => in_array(\Yii::$app->controller->action->id, ['his']),],
			],
			'encodeLabels' => true
		]);




	?>
		</div>
	</div>

</br>
	<!--Panel-->

			<?= $content ?>

	</div>

	<?php Pjax::end(); ?>



</div>
