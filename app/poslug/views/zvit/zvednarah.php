<?php
/**
 *
 * @var PsiWhiteSpace $model
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use yii\helpers\Url;
	use yii\widgets\Pjax;
	/* @var $this yii\web\View */
	/* @var $searchModel app\poslug\models\SearchUtKart */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Зведена відомість по нарахуванню';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zvit-narah">

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
//		'filterModel' => $model,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],

			[
				'attribute'=>'period',
				'group'=>true,
			],
			[
				'attribute'=>'tipposl',
				'pageSummary'=>'Всього',
				'group'=>true,
			],
			[
				'attribute'=>'sum',
				'pageSummary'=>true,
			],
//			[
//				'attribute' => 'ulica',
//				'label' => 'Вулиця',
//				'value' => 'ulica.ul',
//			],
//			[
//				'attribute'=>'ulica',
//				'vAlign'=>'middle',
////				'width'=>'180px',
//				'filterType'=>GridView::FILTER_SELECT2,
//				'filter'=>ArrayHelper::map(\app\poslug\models\UtUlica::find()->orderBy('ul')->asArray()->all(),'ul','ulica'),
//				'filterWidgetOptions'=>[
//					'pluginOptions'=>['allowClear'=>true],
//				],
//				'filterInputOptions'=>['placeholder'=>Yii::t('easyii', 'Ul')],
//				'format'=>'raw'
//			],

//			'utAbonents[0].schet',
//			['utAbonents.schet'],
//			[
//				'attribute'=>'utAbonents.schet',
//				'vAlign'=>'middle',
//				'width'=>'180px',
//				'value' => 'utAbonents.schet',
//			],
//		    'schet',
//			[
//			'label' => 'Текст новости',
//			'attribute' => 'utAbonents.schet',
//			'value' => function($data) { return  $data["utAbonents.schet"]; },
//			],
//			[
//				'label' => 'schet',
//				'value' => function ($searchModel) {
//					$components = ArrayHelper::map($searchModel->utAbonents, 'id', 'schet');
//					$components = array_map(function ($id, $name) {
//						return Html::a($name, ['/component/view', 'id' => $id]);
//					}, array_keys($components), $components);
//					return implode(', ', $components);
//				},
//				'format' => 'raw'
//			],
//			[
//				'class' => '\kartik\grid\ActionColumn',
//				'template' => '{view} {update} {delete}',
////				'template' => '{view} {update} {delete}',
////				'template' => '{update},{delete}',
////				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
////				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
//				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
//			]
		],
		'resizableColumns'=>true,
		'showPageSummary'=>true,
		'pjax'=>true,
		'striped'=>true,
		'hover'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
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



	<!--    --><?php //Pjax::end(); ?>
</div>