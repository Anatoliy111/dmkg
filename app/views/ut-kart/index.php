<?php

	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use kartik\growl\Growl;
	use yii\bootstrap\Tabs;
	use yii\helpers\Html;
use yii\grid\GridView;
	use yii\widgets\ListView;
	use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchUtKart */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('easyii', 'Ut Karts');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-kart-index">



	<div class="well well-large">
			<?php  echo $this->render('_search', ['model' => $searchModel, 'dataProvider' => $dataProvider]);
				?>
		<div class="text">
			<p> * Для отримання коду доступу, потрібно з'явитись в КП "ДОЛИНСЬКИЙ МІСЬККОМУНГОСП" вул. Нова 80-А, в кабінет №2.</p>
			<p> При собі мати паспорт та документ що засвідчує право власності.</p>
		</div>
	</div>



	<div class="row">
		<?php
			if ($dataProvider->getTotalCount() == 0  and Yii::$app->request->queryParams <> null) {

				echo Growl::widget([
					'type' => Growl::TYPE_DANGER,
					'title' => 'Помилка!',
					'icon' => 'glyphicon glyphicon-remove-sign',
					'body' => 'По вашій адресі абонентів не знайдено. Спробуйте знову!!!',
					'showSeparator' => true,
					'delay' => 0,
					'pluginOptions' => [
//						'showProgressbar' => true,
						'placement' => [
							'from' => 'top',
							'align' => 'right',
						]
					]
				]);
			}

			if ($dataProvider->getTotalCount() <> 0  and $findmodel == 'bad') {

				echo Growl::widget([
					'type' => Growl::TYPE_DANGER,
					'title' => 'Помилка!',
					'icon' => 'glyphicon glyphicon-remove-sign',
					'body' => 'Невірний код доступу !!!',
					'showSeparator' => true,
					'delay' => false,
					'pluginOptions' => [
//						'showProgressbar' => true,
						'placement' => [
							'from' => 'top',
							'align' => 'right',
						]
					]
				]);
			}
		?>
	</div>





</div>
