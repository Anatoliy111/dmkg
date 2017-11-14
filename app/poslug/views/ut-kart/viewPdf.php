<?php

	use kartik\detail\DetailView;
	use kartik\dialog\Dialog;
	use kartik\form\ActiveForm;
	use kartik\grid\GridView;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;







?>
<div class="ut-kart-view">

    <h1><?= Html::encode($this->title) ?></h1>


	<?=
		DetailView::widget([
			'model'=>$model,
//			'condensed'=>true,
			'hover'=>true,
			'mode'=>DetailView::MODE_VIEW,
//			'panel'=>[
////							'heading'=>$model->getOrg()->asArray()->one()['naim'],
//				'heading'=>'gdfhsdfh',
//				'headingOptions' => [
//					'tag' => 'asfsdgasd',
//					'template' => '{title}{buttons}',
//				],
//				'type'=>DetailView::TYPE_INFO,
//				'enableEditMode' => true,
//			],
			'attributes'=>[
			        	'fio',
                        'idcod',
//			        'ulica.ul',
//	                [
//			        	'attribute' => 'ulica',
//			        	'label' => 'Вулиця',
////		        		'value' =>$model->ulica,
//			        	'value' => function ($model, $key, $index, $widget) {
//			        				return $model->ulica;
//			        	},
//			        ],
			        [
			        	'label' => Yii::t('easyii', 'Adress'),

			        	'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
			        ],
			        [
			        	'attribute'=>'ur_fiz',
			        	'label'=>'Юр. чи Фіз.',
			        	'format'=>'raw',
			        	'value'=>$model->ur_fiz==0 ? '<span class="label label-success">Фізична особа</span>' : '<span class="label label-danger">Юридична особа</span>',
//			        	'type'=>DetailView::TYPE_INFO,
//			        	'widgetOptions' => [
//			        		'pluginOptions' => [
//			        			'0' => 'Yes',
//			        			'1' => 'No',
//			        		]
//			        	],
			        	'valueColOptions'=>['style'=>'width:30%']
			        ],
			        [
			        	'attribute'=>'pass',
			        	'label'=>'Авторизація',
			        	'format'=>'raw',
			        	'value'=>(!empty($model->pass) ? '<span class="label label-success">Авторизований</span>'
			        	: '<span class="label label-danger">Не авторизований</span>') ,

			        	],

				[

					'label'=>'Пароль',
					'format'=>'raw',
					'value'=>$pass,
				],
//			        	'valueColOptions'=> array('style' =>'width:30%')),
                    'telef',
				[
					'attribute'=>'privat',
					'label'=>'Приватизація',
					'format'=>'raw',
					'value'=>$model->privat==1 ? '<span class="label label-success">Приватизована</span>': $model->privat,
					'valueColOptions'=>['style'=>'width:30%']
				],


				[
					'attribute' => 'id_rabota',
//					'label'=>'Робота',
					'value' => $model->getRabota()->asArray()->one()['name'],
				],
			]
		]);
	?>




	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
			'label' => 'Організація',
			'value' => 'org.naim',
		     ],
			'schet',
		],
	]); ?>



</div>
