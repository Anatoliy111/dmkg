<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDomrab */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Domrabs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domrab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Domrab'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'period',
            'id_dom',
            'id_tarifvid',
            // 'id_naryad',
            // 'id_normrab',
            // 'ed_izm',
            // 'norm_ed',
            // 'kol_day',
            // 'obiem',
            // 'norm_chas',
            // 'notevid',
            // 'summa',
            // 'proveden',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
