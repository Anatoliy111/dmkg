<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtNarah */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ut Narahs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-narah-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ut Narah'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'period',
            'id_abonent',
            'id_posl',
            // 'id_tipposl',
            // 'tipposl',
            // 'id_vidlgot',
            // 'lgot',
            // 'tarif',
            // 'id_vidpokaz',
            // 'vidpokaz',
            // 'pokaznik',
            // 'ed_izm',
            // 'nnorma',
            // 'sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
