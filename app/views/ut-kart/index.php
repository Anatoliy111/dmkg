<?php

	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
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


    <?php Pjax::begin(); ?>
	<div class="well well-large">
			<?php  echo $this->render('_search', ['model' => $searchModel, 'dataProvider' => $dataProvider]);
				?>
		<div class="text">
			<p> * Для отримання коду доступу, треба з паспортом з'явитись в КП "ДОЛИНСЬКИЙ МІСЬККОМУНГОСП" вул. Нова 80-А, в кабінет №2.</p>
		</div>
	</div>



	<div class="row">
		<?php
			if ($dataProvider->getTotalCount() == 0  and Yii::$app->request->queryParams <> null) {

				Alert::begin([
					'options' => [
						'class' => 'alert-danger', 'style' => 'float:bottom; margin-top:50px',
					],
				]);

				echo 'По вашій адресі абонентів не знайдено !!!';

				Alert::end();
			}

			if ($dataProvider->getTotalCount() <> 0  and $findmodel == 'bad') {

				Alert::begin([
					'options' => [
						'class' => 'alert-danger', 'style' => 'float:bottom; margin-top:50px',
					],
				]);

				echo 'Не вірний код доступу !!!';

				Alert::end();
			}
		?>
	</div>





    <?php Pjax::end(); ?>
</div>
