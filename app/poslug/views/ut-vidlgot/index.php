<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Vidlgots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-vidlgot-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Vidlgot'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'lgota',
            'lgota_s',
            'razmer',
            // 'kod_subs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<!--    --><?php //Pjax::end(); ?>
</div>
