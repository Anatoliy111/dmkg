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
				'type'=>DetailView::TYPE_INFO,
			],
			'buttons1' => '{view}',
//			'buttons2' => '{save},{view}',
			'attributes'=>[
	'god_eksp',
	'teh_stan',
	'kol_etag',
	'kol_pod',
	'kol_kv',
	'kol_kvpriv',
	'kol_kvkom',
	'plos',
	'plos_kv',
	'plos_nokv',
	'kol_lud',
	'tip_dom',
	'lift',
	'plos_terit',
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
				'heading'=>'Характеристики будинку',
				'type'=>DetailView::TYPE_INFO,
			],
			'buttons1' => '{view}',
//			'buttons2' => '{save},{view}',
			'attributes'=>[
				'n_dom',
				'id_ulica',
				'note',
				'image'

			]
		]);
	?>

	<?php Pjax::end(); ?>





</div>





