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
	$dom = \app\poslug\models\UtDom::findOne($model->id_dom);
	$ul = $dom->getUlica()->one();

	$NameDom = $ul->ul.' '.$dom->n_dom;
	$this->params['breadcrumbs'][] = ['label' => $NameDom, 'url' => ['view', 'id' => $model->id_dom]];
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
			'enableEditMode' => false,
			'buttons1' => '{view}',
			'attributes'=>[
				[
					'attribute' => 'id_dom',
					'value' => $NameDom,
					'displayOnly'=>true,
				],
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

		],
		'resizableColumns'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],

		'pjax'=>true,
		'pjaxSettings'=>[
//			'neverTimeout'=>true,
			'options'=>[
				'id'=>'w3',
			]
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"></i>'.' '.$this->title.'</h3>',
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