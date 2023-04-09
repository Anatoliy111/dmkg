<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtLichskl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Lichskls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lichskl-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Lichskl'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'id_abonent',
            'id_pokaz',
            'period',
            // 'date',
            // 'pokaz_nt1',
            // 'pokaz_nt2',
            // 'pokaz_nt3',
            // 'pokaz_kt1',
            // 'pokaz_kt2',
            // 'pokaz_kt3',
            // 'rizn_t1',
            // 'rizn_t2',
            // 'rizn_t3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
