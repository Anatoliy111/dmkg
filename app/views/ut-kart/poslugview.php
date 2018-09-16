<?php


use app\poslug\models\UtKart;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-info-view">

	<?php 		Modal::begin([
		'header' => '<h2>Складові тарифу</h2>',
		'id'=>'tar-modal',
		'size'=> 'modal-lg',
//	'toggleButton' => false,
//	'options'=>[
//		'backdrop' => 'static',
//	],
		'clientOptions' => ['backdrop' => false],

	]);


	echo "<div id='modalContentinfo'></div>";

	Modal::end(); ?>



	<?php
		foreach ($abonents as $abon) {

			?>
			<div class="rah">
			     <h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

			</div>
			<?php

			$layout = <<< HTML
			<div class="NameTab">
			     <h4>Послуги</h4>

			</div>
{items}
HTML;

				$layout2 = <<< HTML
			<div class="NameTab">
			     <h4>Тарифи по рухунку</h4>

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




	?>
	<div class="col-xs-12">

			<div class="center" style="padding-bottom: 20px; margin-left: auto; margin-right: auto;">
			<?= Html::a('<i class="glyphicon glyphicon-home"></i> Тарифи по будинку '.$model->getUlica()->one()->ul.' '.$model->dom  , ['/ut-dom/view', 'id' => $model->id_dom], ['class' => 'btn btn-primary btn-block' ]) ?>
			</div>

	</div>

    <?php

	$prev = 0;
	echo GridView::widget([
		'dataProvider' =>  $dataProvider2[$abon->id],

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
				'attribute' => 'id_tipposl',
				'label' => 'Показник',
				'format' => 'raw',
				'value' => 'poslvid.vid_pokaz',
				'group'=>true,
			],

//			[
//				'attribute' => 'id_vidpokaz',
//				'value' => 'vidpokaz.vid_pokaz',
//				'group'=>true,
//			],
//			[
//				'attribute' => 'tarifplan',
//				'format' => 'raw',
//				'value' =>function ($model, $id) {
//					if ($model->val<>null) {
//						$res = $model->tarifplan . ' ' . Html::a('<i class="glyphicon glyphicon-info-sign"></i>', [Url::to(['ut-dom/tarinfo', 'id' => $model->val])],['class' => 'btn-sm btn-outline btn-warning','title'=>'Cкладові тарифу',
//								'id' => 'tar-info',
//								'data-toggle' => 'modal',
//								'data-target' => '#tar-modal',
//								'onclick' => "$('#tar-modal .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",]);
//					}
//					else
//						$res = null;
//					return $res;
//				},
//				'group'=>true,
//			],
			[
				'attribute' => 'name',
				'label'=>'Назва фактичного тарифу'
			],
			[
				'attribute' => 'tariffakt',
			],

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
		'layout' => $layout2,
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


	}
	?>





</div>





