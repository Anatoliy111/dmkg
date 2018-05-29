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
	'options'=>[
		'backdrop' => 'static',
	],

]);


echo "<div id='modalContentinfo'></div>";

 Modal::end(); ?>


<div class="ut-tarinfo-index">

<!--	<h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

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

	<?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' .
		Yii::t('easyii', 'Add'), ['createtarinfo','id' => $model->id], [
			'id' => 'info-add',
			'data-toggle' => 'modal',
			'data-target' => '#tar-modal',
			'class' => 'btn btn-success',
			'onclick' => "$('#tar-modal .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
		]
	) ?>

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
//				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-pencil"></i>',
							'id' => 'activity-view-link',
							'data-toggle' => 'modal',
							'data-target' => '#tar-modal',
							'data-pjax' => '0'],
				'deleteOptions' => [ 'class' => 'btn btn-xs btn-danger', 'title' => 'Delete',
					'type' => Dialog::TYPE_DANGER,
						],
			],
		],
		'resizableColumns'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
//		'pjax'=>true,
//		'pjaxSettings'=>[
//			'neverTimeout'=>true,
//		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"></i>'.' '.$this->title.'</h3>',
			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['createtarinfo','id' => $model->id], ['id'=>'modalbutton','class'=>'btn btn-success']).' '.Html::a('Перерахувати тариф', ['calculateinfo','id' => $model->id], ['class' => 'btn btn-success']),
		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
			'{export}',
			'{toggleData}',
		]
	]); ?>



	<?php $this->registerJs(
		"$(function () {
		$('#modalbutton').click(function(){
		$('#tar-modal').modal('show')
		.find('#modalContentinfo')
		.load($(this).attr('value'));
		});
});
    "
	); ?>



</div>