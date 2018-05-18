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
			<div class="rah"
			     <h3>Особовий рахунок <?= Html::encode($abon->schet)?></h3>

			</div>
			<?php

			$layout = <<< HTML
			<div class="NameTab"
			     <h3>Послуги</h3>

			</div>
{items}
HTML;

				$layout2 = <<< HTML
			<div class="NameTab"
			     <h3>Тарифи</h3>

			</div>
{items}
HTML;

			echo GridView::widget([
				'dataProvider' =>  $dataProvider[$abon->id],

							'columns' => [
								['class' => '\kartik\grid\SerialColumn'],

//				'id_tipposl',
		     	[
		     		'attribute' => 'id_tipposl',
		     		'value' => 'tipposl.poslug',
		     	],
				'n_dog',
				'date_dog',
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
				'layout' => $layout,
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



			echo GridView::widget([
				'dataProvider' =>  $dataProvider2[$abon->id],
//				'showPageSummary' => true,

				'columns' => [
					['class' => '\kartik\grid\SerialColumn'],
					[
							'attribute' => 'id_tipposl',
							'value' => 'tipposl.poslug',
							'group'=>true,

					],
//					'tipposl',
					'name',

					[
						'attribute' => 'tarifplan',
						'format'=>['decimal', 2],
					],
					[
						'attribute' => 'tariffakt',
						'format'=>['decimal', 2],
					],
					[
						'attribute' => 'tarifend',
						'format'=>['decimal', 2],
						'group'=>true,
					],
//					'days',
//				['class' => 'yii\grid\ActionColumn'],
				],
				'layout' => $layout2,
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
//					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> Тарифи </h3>',
//					'type'=>'info',
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


		}

	?>




</div>





