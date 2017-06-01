<?php

	use app\poslug\models\UtObor;
	use kartik\date\DatePicker;
	use kartik\datecontrol\DateControl;
	use kartik\nav\NavX;
	use kartik\select2\Select2;
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



<?php //Pjax::begin(); ?>
<div class="utkart-view">





	<div class="well well-large">
		<div class="col-sm-4 pull-right">
			<?php



				echo Select2::widget([
					'model' => $model,
					'attribute' => 'periodd',
					'data' => ArrayHelper::map(\app\poslug\models\UtObor::find()->groupBy('period')->all(),'period','period'),
					'hideSearch' => true,
//					'showToggleAll' => true,
					'addon' => [
						'append' => [
							'content' => Html::submitButton('Go', ['class'=>'btn btn-primary']),
							'asButton' => true
						],
					],
					'pluginOptions' => [
						'allowClear' => true,
						'format' => ['date', 'php:MY'],
					],
				]);
			?>

		</div>
	<h3 class="text-center">Кабінет споживача</h3>


	<div class="row">



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


	<!--Panel-->

			<?= $content ?>

	</div>





</div>
<?php //Pjax::end(); ?>