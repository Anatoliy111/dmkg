<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDom */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Doms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-dom-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>



<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('easyii', 'Create Ut Dom'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'n_dom',
//            'id_ulica',
//            'kol_kv',
//            'kol_pod',
//            // 'kol_etag',
//            // 'lift',
//            // 'note:ntext',
//            // 'id_olddom',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

</div>
