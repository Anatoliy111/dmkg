<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtNarah */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Narahs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-narah-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Narah'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'id_abonent',
            'id_posl',
            'id_tipposl',
            // 'id_tarif',
            // 'tarif',
            // 'id_vidpokaz',
            // 'pokaznik',
            // 'ed_izm',
            // 'nnorma',
            // 'sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
