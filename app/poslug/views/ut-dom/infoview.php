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
				'god_eksp',
//	'teh_stan',
				'kol_etag',
				'kol_pod',
				'kol_kv',
				'kol_lud',
//	'kol_kvpriv',
//	'kol_kvkom',
				'plos',
				'plos_kv',
				'plos_nokv',
				'plos_terit',
//	'tip_dom',
				'lift',
				'kol_podval',
				'kol_kladov',
//					'label' => Yii::t('easyii', 'Adress'),
//
//					'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
//				],
//				[
//					'attribute'=>'ur_fiz',
//					'label'=>'Юр. чи Фіз.',
//					'format'=>'raw',
//					'value'=>$model->ur_fiz==0 ? '<span class="label label-success">Фізична особа</span>' : '<span class="label label-danger">Юридична особа</span>',
////			        	'type'=>DetailView::TYPE_INFO,
////			        	'widgetOptions' => [
////			        		'pluginOptions' => [
////			        			'0' => 'Yes',
////			        			'1' => 'No',
////			        		]
////			        	],
//					'valueColOptions'=>['style'=>'width:30%']
//				],
//				[
//					'attribute'=>'pass',
//					'label'=>'Авторизація',
//					'format'=>'raw',
//					'value'=>(!empty($model->status) ? '<span class="label label-success">Авторизований</span>'
//						: '<span class="label label-danger">Не авторизований</span>') ,
//
//				],
//
//				[
//
//					'label'=>'Пароль',
//					'format'=>'raw',
//					'value'=>$pass,
//				],
////			        	'valueColOptions'=> array('style' =>'width:30%')),
//				'telef',
//				[
//					'attribute'=>'privat',
//					'label'=>'Приватизація',
//					'format'=>'raw',
//					'value'=>$model->privat==1 ? '<span class="label label-success">Приватизована</span>': $model->privat,
//					'valueColOptions'=>['style'=>'width:30%']
//				],
//
//
//				[
//					'attribute' => 'id_rabota',
////					'label'=>'Робота',
//					'value' => $model->getRabota()->asArray()->one()['name'],
//				],
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





