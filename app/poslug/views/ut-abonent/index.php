<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtAbonent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Abonents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-abonent-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Abonent'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'schet',
            'fio',
            'id_kart',
            // 'id_rabota',
            // 'note:ntext',
            // 'ur_fiz',
            // 'id_dom',
            // 'privat',
            // 'id_oldkart',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<!--    --><?php //Pjax::end(); ?>
</div>
