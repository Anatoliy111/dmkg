<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtObor */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вивіз сміття ПС';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smitpc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  echo $this->render('_searchul', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'schet',
                'label' => 'Ос.рахунок',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["schet"]);
                }
            ],
            [
                'attribute' => 'fio',
                'label' => 'ПІБ',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["fio"]);
                }
            ],
            [
                'attribute' => 'ulnaim',
                'label' => 'Вулиця',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["ulnaim"]);
                }
            ],
            [
                'attribute' => 'nomdom',
                'label' => 'Будинок',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["nomdom"]);
                }
            ],
            [
                'attribute' => 'nomkv',
                'label' => 'Квартира',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["nomkv"]);
                }
            ],
            [
                'attribute' => 'dolgopl',
                'label' => 'Борг',
            ],
        ],
    ]); ?>

</div>
