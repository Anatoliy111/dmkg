<?php

	use kartik\form\ActiveForm;
	use kartik\grid\GridView;
	use kartik\select2\Select2;
	use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtTarifplan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Tarifplans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifplan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--	<div class="ut-tarifplan-form">-->

		<?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($searchModel, 'periodnow')->widget(Select2::classname(), [
//			'data' => \yii\helpers\ArrayHelper::map(\app\poslug\models\UtTarifplan::find()->all(), 'period', 'period'),
			'hideSearch' => true,
//			'data' =>[
//				'foo' => [
//					'bar' => 'dgdgdsgdgh',
//					'bar1' => 'wwwwwwwwwwww',
//					'bar2' => 'rrrrrrrrrrrrrrr',
//				],
//				'foo2' => [
//					'bar' => 'dgdgdsgdgh',
//					'bar1' => 'wwwwwwwwwwww',
//					'bar2' => 'rrrrrrrrrrrrrrr',
//				]
//			],
			'data'=>$per,
				'options' => ['placeholder' => 'Select a state ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); ?>

		<?php ActiveForm::end(); ?>

<!--	</div>-->

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

            'period',
            [
                'attribute'=>'ulica',
                'label' => 'Вулиця',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value' => 'domul.ul',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\poslug\models\UtUlica::find()->orderBy('ul')->asArray()->all(), 'ul', 'ul'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any'],
                'format'=>'raw'
            ],
            [
                'attribute' => 'n_dom',
                'value' => 'dom.n_dom',
                'label' => 'Будинок',
                'width'=>'80px',
            ],


            [
                'attribute' => 'id_tipposl',
                'value' => 'tipposl.poslug',
            ],
            [
                'attribute' => 'id_vidpokaz',
                'value' => 'vidpokaz.vid_pokaz',
            ],
            'tarifplan',

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

        'toolbar'=> [

        ]
    ]);
    ?>
</div>
