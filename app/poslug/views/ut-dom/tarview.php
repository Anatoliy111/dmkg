<?php
/**
 *
 * @var \app\models\UtKart $model
 * @var Array access expression $abonents
 * @var Array access expression $dataProvider
 */

	use app\poslug\models\UtTipposl;
	use kartik\grid\GridView;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;


	//	use yii\bootstrap\

	/* @var $this yii\web\View */


?>





<div class="utkart-info-view">


	<?php
//		foreach ($abonents as $abon) {
//
//			echo GridView::widget([
//				'dataProvider' =>  $dP[$abon->id],
//
//				'columns' => [
//					['class' => 'yii\grid\SerialColumn'],
//
//					'id',
//					'id_tarif',
//					[
//						'attribute' => 'tarif.id_tipposl',
//						'label' => 'Послуга',
//						'value' => 'tarif.id_tipposl',
////						'value' =>ArrayHelper::map(UtTipposl::find()->asArray()->all(),'id','poslug'),
//					],
//					[
//						'label' => 'Назва тарифу',
//						'value' => 'tarif.name',
//					],
//					[
//						'label' => 'Тариф',
//						'value' => 'tarif.tarif1',
//					],
////					'n_dog',
////					'date_dog',
////				'nnorma',
////				 'activ',
////								[
////									'attribute' => 'del',
////									'class' => '\kartik\grid\BooleanColumn',
////								],
//
//					// 'note:ntext',
//					// 'ur_fiz',
//					// 'id_dom',
//					// 'privat',
//					// 'id_oldkart',
//
////				['class' => 'yii\grid\ActionColumn'],
//				],
//				'resizableColumns'=>true,
////				'showPageSummary'=>true,
//				'pjax'=>true,
//				'striped'=>true,
//				'hover'=>true,
////		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
////		'floatHeader'=>true,
//				'floatHeaderOptions'=>['scrollingTop'=>'50'],
//				'pjaxSettings'=>[
//					'neverTimeout'=>true,
////			'beforeGrid'=>'My fancy content before.',
////			'afterGrid'=>'My fancy content after.',
//				],
////		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
////		'floatHeader'=>true,
////				'floatHeaderOptions'=>['scrollingTop'=>'50'],
////		'showPageSummary' => true,
////				'pjax'=>true,
////				'pjaxSettings'=>[
////					'neverTimeout'=>true,
//////			'beforeGrid'=>'My fancy content before.',
//////			'afterGrid'=>'My fancy content after.',
////				],
//				'panel' => [
//					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' Рахунок '.Html::encode($abon->schet).'</h3>',
//					'type'=>'primary',
////					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
////					'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//					'footer'=>false
//				],
////		'panelBeforeTemplate' => [
////			'{before}' => 'true',
////		],
////				'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
////				'headerRowOptions'=>['class'=>'kartik-sheet-style'],
////				'filterRowOptions'=>['class'=>'kartik-sheet-style'],
//				'toolbar'=> [
////					['content'=>
//////				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//////				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
//////						 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
////					],
////					'{export}',
////					'{toggleData}',
//				]
//			]);
//
//		}






	?>





</div>