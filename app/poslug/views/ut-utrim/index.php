<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtUtrim */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Utrims');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-utrim-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Utrim'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'id_abonent',
            'period',
            'id_posl',
            // 'id_tipposl',
            // 'id_vidutr',
            // 'id_rabota',
            // 'summa',
            // 'procent',
            // 'data_n',
            // 'data_k',
            // 'zayav',
            // 'flag_vrem',
            // 'activ',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
