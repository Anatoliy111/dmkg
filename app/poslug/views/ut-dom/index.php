<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDom */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Doms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="ut-dom-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>



<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('easyii', 'Create Ut Dom'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!--        <p>-->
<!--            --><?//= Html::a('Оновити список', ['updatespis'], ['class' => 'btn btn-success']) ?>
<!--        </p>-->
<!---->
    </br>
<!--    <div class="container-fluid">-->

            <?php foreach($doms as $dom) : ?>
                <div class="col-xs-6 col-sm-4 col-md-2 col-xs-offset-1 form-group">
                    <div class="top5">
<!--                    <a href="--><?//= Url::to(['view', 'id' => $dom->id]) ?><!--" class="read-more">Буд. --><?//= $dom->n_dom?><!--</a>-->
                    <?= Html::a('<i class="glyphicon glyphicon-home"></i> Буд. '.$dom->n_dom , ['view', 'id' => $dom->id], ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
<!--    </div>-->



<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'n_dom',
//            'id_ulica',
//            'note:ntext',
//
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

</div>
