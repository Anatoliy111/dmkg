<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtObor */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вивіз сміття';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>

<div class="smitpc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php  echo $this->render('_searchul', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'schet',
                'label' => 'Ос.рахунок',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["schet"]);
                }
            ],
            [
                'attribute' => 'wid',
                'label' => 'Посл.',
            ],
            [
                'attribute' => 'fio',
                'label' => 'ПІБ',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["fio"]);
                }
            ],
            [
                'attribute' => 'ulnaim',
                'label' => 'Вулиця',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["ulnaim"]);
                }
            ],
            [
                'attribute' => 'nomdom',
                'label' => 'Будинок',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["nomdom"]);
                }
            ],
            [
                'attribute' => 'nomkv',
                'label' => 'Квартира',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["nomkv"]);
                }
            ],
            [
                'attribute' => 'koli_pf',
                'label' => 'Проживає',
            ],
            [
                'attribute' => 'dolgopl',
                'label' => 'Борг',
            ],
        ],
        'resizableColumns'=>true,
        'hover'=>true,
//				'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            //			'beforeGrid'=>'My fancy content before.',
            //			'afterGrid'=>'My fancy content after.',
        ],
        //		'panel' => [
        //			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'. Yii::t('easyii', 'Ut Karts').'</h3>',
        //			'type'=>'success',
        //			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('easyii', 'Create Ut Kart'), ['create'], ['class' => 'btn btn-success']),
        //			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //			'footer'=>false
        //		],
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
        ],
        //		'panelBeforeTemplate' => [
        //			'{before}' => 'true',
        //		],
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'floatHeaderOptions'=>['scrollingTop'=>'50'],
        'toolbar'=> [
            //			['content'=>
            //				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
            //				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
            //			],
            '{export}',
//            '{toggleData}',
        ]
    ]); ?>

</div>

<?php Pjax::end();?>
