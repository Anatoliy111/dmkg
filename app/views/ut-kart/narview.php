<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>



	<?php $this->beginContent('@app/views/ut-kart/navbar.php'); ?>

<div class="utkart-info-view">


	<?php
		foreach ($abonents as $abon) {


			echo GridView::widget([
				'dataProvider' =>  $dp[$abon->id],
							'columns' => [
				['class' => 'yii\grid\SerialColumn'],


				'period',
				[
					'attribute' => 'id_tipposl',
					'value' => 'tipposl.poslug',
		    	],
				'id_vidlgot',
				'tarif',
				[
						'attribute' => 'id_vidpokaz',
						'value' => 'vidpokaz.vid_pokaz',
				],
				'pokaznik',
				'ed_izm',
				'nnorma',
				'sum',
//				['class' => 'yii\grid\ActionColumn'],
				],
				'resizableColumns'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
//				'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
				'pjax'=>true,
				'pjaxSettings'=>[
					'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
				],
				'panel' => [
					'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' '.Html::encode($abon->org->naim).'</h3>',
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
		}
	?>





</div>

	<?php $this->endContent(); ?>



