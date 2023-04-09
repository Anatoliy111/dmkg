<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtLgot */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Lgots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lgot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Lgot'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'id_vidlgot',
            // 'fio',
            // 'posv_ser',
            // 'date_n',
            // 'date_k',
            // 'kat',
            // 'flag_vrem',
            // 'activ',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
