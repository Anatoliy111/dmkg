<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDomzatrat */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Domzatrats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domzatrat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'showPageSummary' => true,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],

//			[
//				'attribute' => 'fio',
//				'label' => 'ПІБ',
//				'format' => 'raw',
//				'value'=>function ($name, $id) {
//					return Html::a($name['fio'], ['/poslug/ut-kart/view', 'id' => $id, 'mode' => 'view']);
//
//				},
//			],

			[
				'attribute'=>'date',
				'vAlign'=>'middle',
				'width'=>'200px',
				'filterType'=>GridView::FILTER_DATE,
				'filterWidgetOptions' => [
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd',
					]
				]
			],


			[
				'attribute'=>'ulica',
				'vAlign'=>'middle',
				'width'=>'180px',
				'value' => 'ulica.ul',
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(\app\poslug\models\UtUlica::find()->orderBy('ul')->asArray()->all(), 'ul', 'ul'),
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'Any'],
				'format'=>'raw'
			],
			[
				'attribute' => 'dom',
				'vAlign'=>'middle',
			],

			'note:ntext',

			[
				'attribute' => 'sum',
				'vAlign'=>'middle',
				'format'=>['decimal', 2],
				'pageSummary'=>true,
			],
			[
				'class' => '\kartik\grid\ActionColumn',
//				'template' => '{view} {update} {delete}',
//				'template' => '{view} {update} {delete}',
				'template' => '{update},{delete}',
//				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
		],
		'resizableColumns'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' '.$this->title.'</h3>',
			'type'=>'success',
//			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'footer'=>true
		],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
//			['content'=>
////				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success pull left', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
////				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid']). ' '.
//				 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
////				 Html::a(Yii::t('easyii', 'Back'),Yii::$app->request->referrer, ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Back'])
//			],
			'{export}',
			'{toggleData}',
		]
	]); ?>

</div>
