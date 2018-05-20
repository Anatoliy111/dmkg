<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtTarifinfo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tarifinfos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Tarifinfo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_tarif',
            'id_tarifvid',
            'tarifplan',
            'tariffakt',
            // 'tarifend',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
