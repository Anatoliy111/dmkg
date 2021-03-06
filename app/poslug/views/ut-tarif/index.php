<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtTarif */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tarifs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarif-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Tarif'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'id_tipposl',
            'id_vidpokaz',
            'period',
            'tarifplan',
            'tariffakt',
            'tarifend',
            'kl',
            'name',
            'id_dom',
            'podezd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
