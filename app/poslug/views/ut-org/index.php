<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Orgs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-org-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Org'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'naim',
            'naim_full',
            'edrpou',
            'adress',
            // 'tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
