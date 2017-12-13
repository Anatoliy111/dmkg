<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-info-view">




	<?php
		foreach ($abonents as $abon) {

			?>
			<h3 class="panel-title" style="text-align:right">Особовий рахунок <?= Html::encode($abon->schet)?></h3>
			<br/>

			<?php

			echo GridView::widget([
				'dataProvider' =>  $dataProvider[$abon->id],
				'showPageSummary' => true,
							'columns' => [
								['class' => '\kartik\grid\SerialColumn'],
								[
									'attribute' => 'period',
									'label' => 'Період',
									'format' => ['date', 'php:MY'],
									'pageSummary' => 'Всього',
									'pageSummaryOptions' => ['class' =>'text-left text-warning'],
								],
				'tipposl',
				'dt',
								[
									'attribute' => 'sum',
									'format'=>['decimal', 2],
									'pageSummary'=>true,
								],
//				['class' => 'yii\grid\ActionColumn'],
				],
				'resizableColumns'=>true,
				'hover'=>true,
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
				'panel' => [
					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> Оплата </h3>',
					'type'=>'success',
//					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
//					'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
					'footer'=>false
				],
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


			echo GridView::widget([
				'dataProvider' =>  $dataProvider2[$abon->id],
				'showPageSummary' => true,
				'columns' => [
					['class' => '\kartik\grid\SerialColumn'],
					[
						'attribute' => 'period',
						'label' => 'Період',
						'format' => ['date', 'php:MY'],
						'pageSummary' => 'Всього',
						'pageSummaryOptions' => ['class' =>'text-left text-warning'],
					],
					'tipposl',
					[
						'attribute' => 'summa',
						'format'=>['decimal', 2],
						'pageSummary'=>true,
					],
//				['class' => 'yii\grid\ActionColumn'],
				],
				'resizableColumns'=>true,
				'hover'=>true,
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
				'panel' => [
					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> Утримання </h3>',
					'type'=>'warning',
//					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
//					'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
					'footer'=>false
				],
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
		}
	?>





</div>





