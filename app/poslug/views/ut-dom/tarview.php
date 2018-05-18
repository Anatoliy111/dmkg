<?php

	use kartik\detail\DetailView;
	use kartik\dialog\Dialog;
	use kartik\form\ActiveForm;
	use kartik\grid\GridView;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;


	/* @var $this yii\web\View */
	/* @var $model app\poslug\models\UtKart */




?>
<div class="ut-dom-view">



<?php
	echo GridView::widget([
		'dataProvider' =>  $dataProvider,

		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
//			[
//				'class' => 'kartik\grid\ExpandRowColumn',
//				'width' => '100px',
//				'value' => function ($model, $key, $index, $column) {
//					return GridView::ROW_EXPANDED;
//				},
//				'detail' => function ($model, $key, $index, $column) {
//					return Yii::$app->controller->renderPartial('aktview', ['model' => $model]);
//				},
//				'headerOptions' => ['class' => 'kartik-sheet-style'],
//    			'expandOneOnly' => false
//],

			[
				'attribute' => 'period',
				'label'=>'Період',
			],
			[
				'attribute' => 'id_tipposl',
				'value' => 'tipposl.poslug',
				'label'=>'Послуга',

			],
			[
				'attribute' => 'name',
				'label'=>'Тариф',
			],
			'id_vidpokaz',
			[
				'attribute' => 'tarifplan',
				'label'=>'Плановий тариф на м2',
			],
			[
				'attribute' => 'tariffakt',
				'label'=>'Фактичний тариф на м2',
			],
			[
				'attribute' => 'tarifend',
				'label'=>'Кінцевий тариф на м2',
			],
//				'nnorma',
//				 'activ',
//								[
//									'attribute' => 'del',
//									'class' => '\kartik\grid\BooleanColumn',
//								],

			// 'note:ntext',
			// 'ur_fiz',
			// 'id_dom',
			// 'privat',
			// 'id_oldkart',

//				['class' => 'yii\grid\ActionColumn'],
		],
//		'layout' => $layout,
//				'layout'=>"{items}",
		'resizableColumns'=>true,
		'hover'=>true,
//				'showPageSummary'=>true,
		'pjax'=>true,
		'striped'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
		'pjaxSettings'=>[
			'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
		],
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
//				'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
//				'pjax'=>true,
//				'pjaxSettings'=>[
//					'neverTimeout'=>true,
////			'beforeGrid'=>'My fancy content before.',
////			'afterGrid'=>'My fancy content after.',
//				],
//				'panel' => [
//					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' Рахунок '.Html::encode($abon->schet).'</h3>',
//					'type'=>'primary',
////					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
////					'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//					'footer'=>false
//				],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
//				'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
//				'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//				'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
//					['content'=>
////				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
////				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
////						 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
//					],
//					'{export}',
//					'{toggleData}',
		]
	]);
?>







</div>