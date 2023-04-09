<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtPosl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Posls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-posl-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Posl'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'id_org',
			'id_abonent',
			[
				'attribute' => 'id_abonent',
				'value' => 'abonent.fio',
			],
			[
				'attribute' => 'schet',
				'value' => 'abonent.schet',
			],
    		[
				'attribute' => 'id_tipposl',
				'value' => 'tipposl.poslug',
			],
             'flag_vrem',
             'date_n',
             'date_k',
             'n_dog',
             'date_dog',
             'nnorma',
             'flag_dom',
             'id_dom',
             'del',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
