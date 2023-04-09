<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtMat */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Mats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-mat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Mat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nom_n',
            'naim',
            'ed_izm',
            'kol',
            // 'cena',
            // 'summa',
            // 'ostat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
