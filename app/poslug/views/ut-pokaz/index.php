<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Pokazs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-pokaz-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Pokaz'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_org',
            'id_abonent',
            'id_vidpokaz',
            'pokaznik',
            // 'nser',
            // 'date_vstan',
            // 'date_pov',
            // 'flag_lich',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
