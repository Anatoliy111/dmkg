<?php

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtTarifplan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tarifplans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifplan-index">

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Tarifplan'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Перерахувати тарифи', ['calculate'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    echo GridView::widget([
        'dataProvider' =>  $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => '\kartik\grid\SerialColumn'],

//            'period',
            [
                'attribute'=>'ulica',
                'label' => 'Вулиця',
                'vAlign'=>'middle',
                'width'=>'200px',
                'value' => 'domul.ul',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\poslug\models\UtUlica::find()->orderBy('ul')->asArray()->all(), 'ul', 'ul'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any'],
                'format'=>'raw',
                'pageSummary'=>'Всього',
            ],
            [
                'attribute' => 'n_dom',
                'value' => 'dom.n_dom',
                'label' => 'Будинок',
                'width'=>'80px',
            ],


            [
                'attribute' => 'poslug',
                'value' => 'tipposl.poslug',
                'label' => 'Послуга',
                'width'=>'80px',
            ],
            [
                'attribute' => 'id_vidpokaz',
                'value' => 'vidpokaz.vid_pokaz',
            ],
            [
                'attribute' =>'tarifplan',
                'pageSummary'=>true,
             ],

            [
                'class' => '\kartik\grid\ActionColumn',
                'header'=>'Складові тарифу',
                'template' => '{tarinfo}',
                'buttons' => [
                    'tarinfo' => function ($name, $model) {
                        return Html::a('<i class="glyphicon glyphicon-info-sign"></i>', ['tarinfo','id' => $model->id], ['class' => 'btn btn-info']);
                    }
                ],
            ]
        ],

        'resizableColumns'=>true,
        'hover'=>true,
				'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'floatHeaderOptions'=>['scrollingTop'=>'50'],
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' '.$this->title.'</h3>',
            'type'=>'success',
//			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>true
        ],
        'toolbar'=> [
            '{export}',
            '{toggleData}',
        ]
    ]);
    ?>
</div>
