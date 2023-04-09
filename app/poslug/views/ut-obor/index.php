<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtObor */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Obors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-obor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Obor'), ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'dolg',
            // 'nach',
            // 'subs',
            // 'opl',
            // 'pere',
            // 'sal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
