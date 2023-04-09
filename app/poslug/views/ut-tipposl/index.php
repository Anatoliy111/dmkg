<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tipposls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tipposl-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Tipposl'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'id_org',

            'poslug',
            [
                'attribute' => 'id_groupposl',
                'value' => 'groupposl.groups',
            ],

            'ed_izm',
            [
                'attribute' => 'id_vidpokaz',
                'value' => 'vidpokaz.vid_pokaz',
            ],
            'old_tipusl',
//             'flag_nar',
//             'flag_norm',
//             'flag_lgot',
//             'flag_dom',
//            [
//                'attribute' => 'id_vidpokazprop',
//                'value' => 'vidpokazprop.vid_pokaz',
//            ],
             'del',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
