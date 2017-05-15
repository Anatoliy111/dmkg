<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Vidpokazs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-vidpokaz-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Vidpokaz'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'vid_pokaz',
            'ed_izm',
            [
                'attribute' => 'ed_izm',
                'value' => 'edizm.edizm',
            ],
            'flag_lich',
            'flag_lichskl',
            'flag_dom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
