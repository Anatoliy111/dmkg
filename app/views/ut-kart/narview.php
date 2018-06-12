<?php


	use kartik\grid\GridView;
	use yii\bootstrap\Tabs;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart">


	<?php
		foreach ($abonents as $abon) {

	?>
	<div class="rah">
	<h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

</div>

	<?php

		$layout = <<< HTML
			<div class="NameTab">
			     <h4>Нарахування</h4>

			</div>
{items}
HTML;
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
//								[
//									'attribute' => 'tipposl',
//									'label' => 'Послуга',
//								],
//								[
//									'attribute' => 'lgot',
//									'label' => 'Льгота',
//								],
//								[
//									'attribute' => 'tarif',
//									'label' => 'Тариф',
//								],
//								[
//									'attribute' => 'vidpokaz',
//									'label' => 'Вид показника',
//								],
//								[
//									'attribute' => 'pokaznik',
//									'label' => 'Показник',
//								],
//								[
//									'attribute' => 'ed_izm',
//									'label' => 'Од. вим',
//								],

//				'period',
				'tipposl',
				'lgot',
				'tarif',
                'vidpokaz',
				'pokaznik',
				'ed_izm',
					[
						'attribute' => 'sum',
						'format'=>['decimal', 2],
						'pageSummary'=>true,
					],
//				'nnorma',
//				['class' => 'yii\grid\ActionColumn'],
				],
				'layout' => $layout,
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
//				'panel' => [
//					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' Рахунок '.Html::encode($abon->schet).'</h3>',
//					'type'=>'primary',
////					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
////					'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//					'footer'=>true
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
				],
//				'showPageSummary' => true
			]);
		}
	?>





</div>





