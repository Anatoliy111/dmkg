<?php

	use app\poslug\models\UtTarifinfo;
	use kartik\detail\DetailView;
	use kartik\growl\Growl;
	use yii\bootstrap\Modal;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
	/* @var $this yii\web\View */
	/* @var $searchModel app\poslug\models\SearchUtAbonent */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = Yii::t('easyii', 'Ut Tarifinfo');
//	$dom = $model->getDom()->one();
//	$ul = $dom->getUlica()->one();
//	$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Doms'), 'url' => ['index']];
//	$this->params['breadcrumbs'][] = ['label' => $ul->ul.' '.$dom->n_dom, 'url' => ['view', 'id' => $model->id_dom]];

	$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>



<!--<div class="row">-->
<!--	--><?php
//
//		$session = Yii::$app->session;
//		if ($session->hasFlash('pass')) {
//
//			echo Growl::widget([
//				'type' => Growl::TYPE_SUCCESS,
////				'title' => 'Помилка!',
////				'icon' => 'glyphicon glyphicon-remove-sign',
//				'body' => $session->getFlash('pass'),
//				'showSeparator' => true,
//				'delay' => 0,
//				'pluginOptions' => [
////						'showProgressbar' => true,
//					'placement' => [
//						'from' => 'top',
//						'align' => 'left',
//					]
//				]
//			]);
//		}
//	?>
<!--</div>-->


<div class="ut-tarinfo-index">

<!--	<h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

	<?=
		DetailView::widget([
			'model'=>$model,
			'striped'=>true,
			'hover'=>true,

			'mode'=>DetailView::MODE_VIEW,
			'panel'=>[
				'heading'=>'Тариф',
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
					'displayOnly'=>true,

				],
			    [
					'attribute' => 'id_tipposl',
					'value' => $model->getTipposl()->asArray()->one()['poslug'],
					'displayOnly'=>true,
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

	<?php 		Modal::begin([
		'header' => '<h2>Завантаження даних...</h2>',
		'options'=>[
			'id'=>'tar-modal',
			'backdrop' => 'static',

		],
		'size'=> 'modal-lg',

//		'toggleButton' => [
//
//
//			'tag' => 'button',
//			'class' => 'advisor ',
//			'label' => 'Нажмите здесь, забавная штука!',
////			'href' => \yii\helpers\Url::to(['/poslug/ut-dom/createtarinfo']),
//		]
//		    'toggleButton' => [
//		'label' => ' Войти',
//		'tag' => 'a',
//		'data-target' => '#login-modal',
//		'class' => 'glyphicon glyphicon-log-in',
//		'href' => \yii\helpers\Url::to(['/account/login']),
//	],
	]);
	?>


	<!--<h1>--><?//= Html::encode($this->title) ?><!--</h1>-->





	<?php

		echo $this->render('createtarinfo', ['model' => $newtarinfo]);
//		echo $this->render('createtarinfo',['id' => $model->id]);


	?>

	<?php Modal::end(); ?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
//		'filterModel' => $searchModel,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
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
//				'template' => '{view} {update} {delete}',
//				'template' => '{update},{delete}',
				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
//				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
		],
		'resizableColumns'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
//		'showPageSummary' => true,
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"></i>'.' '.$this->title.'</h3>',
//			'type'=>'success',
//			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['createtarinfo','id' => $model->id], ['class' => 'btn btn-success']),
			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['createtarinfo','id' => $model->id], ['data-toggle' =>'modal', 'data-target' =>'#tar-modal','class'=>'btn btn-success']),

	//			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//			'footer'=>true
		],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
//			['content'=>
////				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success pull left', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
////				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid']). ' '.
//				 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
////				 Html::a(Yii::t('easyii', 'Back'),Yii::$app->request->referrer, ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Back'])
//			],
			'{export}',
			'{toggleData}',
		]
	]); ?>
	<!--    --><?php //Pjax::end(); ?>
</div>