<?php

	use app\poslug\components\MyGrid;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use kartik\grid\GridExportAsset;
	use \app\poslug\models\UtUlica;
	use \app\poslug\models\UtKart;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtKart */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Karts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-kart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php Pjax::begin();

//		echo MyGrid::widget(['dataProvider' => $dataProvider, 'searchModel' => $searchModel])
	?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'=>$searchModel,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
//            'id',
//			'ID',
			'NAME',
//			'fio',
			'IDCOD',
//			[
//				'attribute'=>'id_ulica',
//				'label'=>Yii::t('easyii', 'id Ulica'),
//				'format'=>'text', // Возможные варианты: raw, html
//				'content'=>function($data){
////					$data->getUtUlica('id_ulica');
//					return $data->getUtUlicaUL();
//				},
////				'filter' => UtKart::getUtUlicaList()
//				'filter' => ArrayHelper::map(UtUlica::find()->all(), 'ID', 'ul')
//			],
			[
				'attribute'=>'id_ulica',
				'label'=>Yii::t('easyii', 'id ulica'),
				'format'=>'text', // Возможные варианты: raw, html
				'vAlign'=>'middle',
				'width'=>'250px',
				'content'=>function ($model, $key, $index, $widget) {
					return $model->utUlica->ul;
				},
//				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(UtUlica::find()->asArray()->all(), 'ID', 'ul'),
//				'filterWidgetOptions'=>[
//					'pluginOptions'=>['allowClear'=>true],
//				],
//				'filterInputOptions'=>['placeholder'=>'UL'],
//				'format'=>'raw'
			],
//			[
//				'attribute'=>'id_ulica',
//				'vAlign'=>'middle',
//				'width'=>'250px',
//				'value'=>function ($model, $key, $index, $widget) {
//					return Html::a($model->utUlica->ul,'#', [
//						'title'=>Yii::t('easyii', 'id Ulica'),
//						'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
//					]);
//				},
////				'filterType'=>GridView::FILTER_SELECT2,
//				'filter'=>ArrayHelper::map(UtUlica::find()->asArray()->all(), 'id', 'ul'),
//				'filterWidgetOptions'=>[
//					'pluginOptions'=>['allowClear'=>true],
//				],
//				'filterInputOptions'=>['placeholder'=>'UL'],
//				'format'=>'raw'
//			],

//			[
//				'attribute'=>'id_ulica',
//				'label'=>Yii::t('easyii', 'id ulica'),
////				'format'=>'text', // Возможные варианты: raw, html
//				'content'=>function($searchModel){
//					return $searchModel->getUtUlica();
//				},
////				'filter' => \app\poslug\models\UtUlica::getUtKarts(),
//			],
			 'DOM',
			 'KV',
			 'UR_FIZ',
			// 'PASS',
			// 'ID_DOM',
			// 'KOL_KOM',
			// 'KOL_LUD',
			// 'PLOS_Z',
			// 'PLOS_O',
			// 'ETAG',
			// 'ID_LGOT',
			// 'PRIVAT',
			// 'lift',
			// 'note:ntext',
			// 'telef',
			// 'id_oldkart',
			// 'id_uslug',
			// 'id_rabota',
			[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"> Перегляд</i>'],
				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"> Змінити</i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"> Видалити</i>'],
				'dropdown' => true,
				'dropdownOptions' => ['class' => 'pull-right'],
			]
		],
		'resizableColumns'=>true,
		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
//		'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
		'pjax'=>true,
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
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> '. Yii::t('easyii', 'Ut Karts').'</h3>',
			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('easyii', 'Create'), ['create'], ['class' => 'btn btn-success']),

		],
		'hover' => true,
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'pjax'=>true, // pjax is set to always true for this demo
		'toolbar'=> [
			['content'=>
//				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/poslug/ut-kart/index'], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Скинути налаштування'])
			],
			'{export}',
			'{toggleData}',
		],
		'autoXlFormat'=>true,
//		'export'=>[
//			'fontAwesome'=>true,
//			'showConfirmAlert'=>false,
//			'target'=>GridView::TARGET_BLANK
//		]
	]); ?>


    <?php Pjax::end(); ?>
</div>
