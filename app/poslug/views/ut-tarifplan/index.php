<?php

use app\poslug\models\UtTarifplan;

	use kartik\grid\GridView;
	use kartik\select2\Select2;
	use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;


	/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtTarifplan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tarifplans');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ut-tarifplan-index">


    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Tarifplan'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Перерахувати всі тарифи', ['calculateall'], ['class' => 'btn btn-success']) ?>
    </p>




    <?php
    echo GridView::widget([
        'dataProvider' =>  $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => '\kartik\grid\SerialColumn'],


            [
                'attribute'=>'period',
                'label' => 'Період',
				'width'=>'110px',
				'value' => function ($model){
					return Yii::$app->formatter->asDate($model->period, 'LLLL Y');
				} ,
                'pageSummary'=>'Всього',
            ],
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
            ],
            [
                'attribute' => 'n_dom',
                'value' => 'dom.n_dom',
                'label' => 'Будинок',
                'width'=>'80px',
            ],
			[
				'attribute'=>'poslug',
				'label' => 'Послуга',
				'vAlign'=>'middle',
				'width'=>'120px',
				'value' => 'tipposl.poslug',
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(\app\poslug\models\UtTipposl::find()->asArray()->all(), 'poslug', 'poslug'),
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'Any'],
				'format'=>'raw',
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
                'header'=>'Дії',
                'vAlign'=>'middle',
                'template' => '{tarinfo}{delete}',
                'buttons' => [
                    'tarinfo' => function ($name, $model) {
                        return Html::a('<i class="glyphicon glyphicon-info-sign"></i>', ['tarinfo','id' => $model->id], ['class' => 'btn-sm','title'=>'Редагування та складові тарифу']);
                    },
//                    'delete' => function ($name, $model) {
//        return Html::a('<i class="glyphicon glyphicon-info-sign"></i>', ['delete','id' => $model->id], ['class' => 'btn btn-danger', 'title'=>'This is a test tooltip',]);
//    }
                ],
            ]
        ],

//        'resizableColumns'=>true,
        'hover'=>true,
				'showPageSummary'=>true,
        'pjax'=>true,
//        'striped'=>true,
//        'floatHeaderOptions'=>['scrollingTop'=>'50'],
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' '.$this->title.'</h3>',
            'type'=>'success',
//			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['create'], ['class' => 'btn btn-success']),
//            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//            'footer'=>true
        ],
        'toolbar'=> [
            '{export}',
            '{toggleData}',
        ]
    ]);
    ?>
</div>
