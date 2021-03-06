<?php

	use kartik\detail\DetailView;
	use kartik\dialog\Dialog;
	use kartik\form\ActiveForm;
	use kartik\grid\GridView;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;
use yii\helpers\Url;


/* @var $this yii\web\View */
	/* @var $model app\poslug\models\UtKart */




?>
<div class="ut-dom-view">



<?php
    $prev = 0;
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
				'label' => 'Період',
				'format' => ['date', 'php:MY'],
			],
			[
				'attribute' => 'id_tipposl',
				'value' => 'tipposl.poslug',
				'group'=>true,
			],

			[
				'attribute' => 'id_vidpokaz',
				'value' => 'vidpokaz.vid_pokaz',
				'group'=>true,
			],
//			'tarifplan',
			[
				'attribute' => 'tarifplan',
				'format' => 'raw',
				'value' =>function ($model, $id) {
					if ($model->val<>null) {
						$res = $model->tarifplan . ' ' . Html::a('<i class="glyphicon glyphicon-info-sign"></i>', [Url::to(['ut-tarifplan/tarinfo', 'id' => $model->val])],['class' => 'btn-sm','title'=>'Редагування та складові тарифу']);
							}
					else
						$res = null;
					return $res;
				},
				'group'=>true,
			],
			[
				'attribute' => 'name',
				'label'=>'Назва фактичного тарифу'
			],
//			'tarifplan',
			[
				'attribute' => 'tariffakt',
			],
//			[
//				'attribute' => 'tarifend',
//			],
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

//			[
//				'class' => '\kartik\grid\ActionColumn',
//				'header'=>'Складові тарифу',
//				'template' => '{tarinfo}',
//				'buttons' => [
//					'tarinfo' => function ($name, $model) {
////						return Html::button('<i class="glyphicon glyphicon-eye-open" aria-hidden="true"> fgsdfhdsfh</i>', ['id' => $model->ID]);
////						if ($prev<>$model->id_tipposl)
////						{
//							$res = Html::a('<i class="glyphicon glyphicon-info-sign"></i>', ['tarinfo','id' => $model->id], ['class' => 'btn btn-info']);
////						}
//						return $res;
//					}
//				],
////				'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"> Складові тарифу</i>'],
//////				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh">sdg</i>'],
//////				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove">sg</i>'],
////				'dropdown' => true,
////				'dropdownOptions' => ['class' => 'pull-right'],
//			]
		],
//		'layout' => $layout,
//				'layout'=>"{items}",
		'resizableColumns'=>true,
		'hover'=>true,
//				'showPageSummary'=>true,
		'pjax'=>false,
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