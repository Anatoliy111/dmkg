<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use yii\widgets\Pjax;
	/* @var $this yii\web\View */
	/* @var $searchModel app\poslug\models\SearchUtAbonent */
	/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="ut-abonent-index">


	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			[
				'attribute' => 'schet',
//				'label' => 'ПІБ',
				'format' => 'raw',
				'value'=>function ($name, $id) {
					return Html::a($name['schet'], ['/poslug/ut-abonent/view', 'id' => $id]);
				},
			],
			[
				'attribute' => 'kart',
				'label' => 'ПІБ',
				'format' => 'raw',
				'value'=>function ($name, $id) {
					return Html::a($name['kart']['fio'], ['/poslug/ut-kart/view', 'id' => $name['kart']['id']]);
				},
			],
			'note:ntext',

//			[
////				'class' => '\kartik\grid\ActionColumn',
////				'template' => '{view} {update} {delete}',
////				'template' => '{view} {update} {delete}',
//////				'template' => '{update},{delete}',
//////				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//////				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
////				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
//			]
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
			'heading'=>'<h3 class="panel-title"></i> Абоненти</h3>',
			'type'=>'primary',
//			'footer'=>true,
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




