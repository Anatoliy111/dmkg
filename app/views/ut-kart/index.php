<?php

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
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

			<p>

			</p>

			<?= ListView::widget([
				'dataProvider' => $dataProvider,
		//        'itemView' => 'searchview',
				'itemView' => 'view',
			]);?>
	</div>



    <?php Pjax::end(); ?>
</div>
