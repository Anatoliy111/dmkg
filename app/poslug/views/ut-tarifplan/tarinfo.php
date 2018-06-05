<?php

	use app\poslug\models\UtTarifinfo;
	use kartik\detail\DetailView;
use kartik\dialog\Dialog;
use kartik\growl\Growl;
	use yii\bootstrap\Modal;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
	/* @var $this yii\web\View */
	/* @var $searchModel app\poslug\models\SearchUtAbonent */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = Yii::t('easyii', 'Ut Tarifinfo');
//	$dom = $model->getDom()->one();
//	$ul = $dom->getUlica()->one();
	$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifplans'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
//	$this->params['breadcrumbs'][] = ['label' => $ul->ul.' '.$dom->n_dom, 'url' => ['view', 'id' => $model->id_dom]];

//	$this->params['breadcrumbs'][] = 'Плановий тариф';
?>
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


<div class="ut-tarinfo-index">



	<?=
		DetailView::widget([
			'model'=>$model,
			'striped'=>true,
			'hover'=>true,

			'mode'=>DetailView::MODE_VIEW,
			'panel'=>[
				'heading'=>'Плановий тариф',
				'type'=>DetailView::TYPE_INFO,
			],
			'enableEditMode' => true,
			'buttons1' => '{update}',
			'buttons2' => '{save},{view}',
			'attributes'=>[
				'id',
				[
					'attribute' => 'period',
					'label' => 'Період',
					'format' => ['date', 'php:MY'],
					'type'=>DetailView::INPUT_SELECT2,
					'widgetOptions'=>[
						'data'=>Yii::$app->session['dateplan'],
						'options' => ['placeholder' => 'Select ...'],
						'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
					],


				],
			    [
					'attribute' => 'id_tipposl',
					'value' => $model->getTipposl()->asArray()->one()['poslug'],
					'type'=>DetailView::INPUT_SELECT2,
					'widgetOptions'=>[
						'data'=>ArrayHelper::map(\app\poslug\models\UtTipposl::find()->orderBy('poslug')->asArray()->all(), 'id', 'poslug'),
						'options' => ['placeholder' => 'Select ...'],
						'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
					],

				],
				[
					'attribute' => 'id_vidpokaz',
					'value' => $model->getVidpokaz()->asArray()->one()['vid_pokaz'],
					'displayOnly'=>true,
				],
				[
					'attribute' => 'tarifplan',
				],
			]
		]);
	?>





	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
//		'filterModel' => $searchModel,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			'id',
			[
				'attribute' => 'id_tarifvid',
				'value' => 'idTarifv.name',
			],
			[
				'attribute' => 'tarifplan',
			],
//			[
//				'attribute' => 'tariffakt',
//			],
//			[
//				'attribute' => 'tarifend',
//			],

			[
				'class' => '\kartik\grid\ActionColumn',
				'template' => '{update} {delete}',
				'urlCreator' => function ($action, $model, $key, $index) {
					if ($action=='delete')
					    return Url::to(['deleteinfo', 'id' => $key]);
					if ($action=='update')
						return Url::to(['updateinfo', 'id' => $key]);

					return true;
				},

				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-pencil"></i>',
									'id' => 'info-upd',
									'data-toggle' => 'modal',
									'data-target' => '#tar-modal',
									'onclick' => "$('#tar-modal .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
							],
				'deleteOptions' => [ 'class' => 'btn btn-xs btn-danger', 'title' => 'Delete',
					'type' => Dialog::TYPE_DANGER,
						],
			],
		],
		'resizableColumns'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
		'pjax'=>true,
		'pjaxSettings'=>[
//			'neverTimeout'=>true,
			'options'=>[
				'id'=>'w3',
			]
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"></i>'.' '.$this->title.'</h3>',
			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['createtarinfo','id' => $model->id], ['id' => 'info-add','data-pjax' => '1','data-toggle' => 'modal','data-target' => '#tar-modal','class' => 'btn btn-success','onclick' => "$('#tar-modal .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",]).' '.Html::a('Перерахувати тариф', ['calculateinfo','id' => $model->id], ['class' => 'btn btn-success','data-pjax' => '1']),
		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
			'{export}',
			'{toggleData}',
		]
	]); ?>





</div>