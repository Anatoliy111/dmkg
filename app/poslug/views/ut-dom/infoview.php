<?php

	use kartik\detail\DetailView;
	use kartik\dialog\Dialog;
	use kartik\form\ActiveForm;
	use kartik\grid\GridView;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;
	use yii\widgets\Pjax;


	/* @var $this yii\web\View */
	/* @var $model app\poslug\models\UtKart */




?>
<div class="ut-dom-view">


	<?php Pjax::begin(); ?>
	<?=
		DetailView::widget([
			'model'=>$dominfo,
			'striped'=>true,
			'hover'=>true,
			'mode'=>DetailView::MODE_VIEW,
			'panel'=>[
				'heading'=>'Характеристики будинку',
				'type'=>DetailView::TYPE_PRIMARY,
			],
			'buttons1' => '{update}',
			'buttons2' => '{save},{view}',
			'attributes'=>[
				[
					'attribute'=>'god_eksp',
					'value'=>$dominfo->god_eksp.' р.',
				],
//	'teh_stan',
				'kol_etag',
				'kol_pod',
				'kol_kv',
				'kol_lud',
//	'kol_kvpriv',
//	'kol_kvkom',
				[
					'attribute'=>'plos',
					'value'=>$dominfo->plos.' м3',
				],
				[
					'attribute'=>'plos_kv',
					'value'=>$dominfo->plos_kv.' м3',
				],
				[
					'attribute'=>'plos_nokv',
					'value'=>$dominfo->plos_nokv.' м3',
				],
				[
					'attribute'=>'plos_terit',
					'value'=>$dominfo->plos_terit.' м3',
				],
//	'tip_dom',
				'lift',
				'kol_podval',
				'kol_kladov',
			]
		]);
	?>

	<?=
		DetailView::widget([
			'model'=>$model,
			'striped'=>true,
			'hover'=>true,
			'mode'=>DetailView::MODE_VIEW,
			'panel'=>[
				'heading'=>'.',
				'type'=>DetailView::TYPE_DEFAULT,
			],
			'buttons1' => '{update}',
			'buttons2' => '{save},{view}',
			'attributes'=>[
//				'n_dom',
//				'id_ulica',
				'note',
				'image'

			]
		]);
	?>

	<?php Pjax::end(); ?>





</div>





