<?php

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

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>

	<?= ListView::widget([
		'dataProvider' => $dataProvider,
//        'itemView' => 'searchview',
		'itemView' => 'view',
	]);?>


    <?php Pjax::end(); ?>
</div>
