<?php

use app\models\UtAbonent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ut Abonents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-abonent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ut Abonent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'schet',
            'fio',
            'id_kart',
            //'note:ntext',
            //'val',
            //'del',
            //'pass',
            //'date_pass',
            //'passopen',
            //'email:email',
            //'telefon',
            //'date_entry',
            //'vb_api_key',
            //'vb_date',
            //'vb_org',
            //'vb_receiver',
            //'vb_name',
            //'vb_status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UtAbonent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
