<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use kartik\grid\GridView;
use yii\widgets\Pjax;
	use kartik\form\ActiveForm;
	use kartik\builder\TabularForm;

/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtUlica */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Ulicas');
$this->params['breadcrumbs'][] = $this->title;
//	$model = $dataProvider;
$attribs = $searchModel->formAttribs;
$title = $this->title;

?>
<div class="ut-ulica-index">
<!--	--><?//= Html::a(Yii::t('easyii', 'Back'),Yii::$app->request->referrer, ['data-pjax'=>0, 'class'=>'btn btn-success pull-right', 'title'=>'Back'])?>
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

<!--    --><?php //Pjax::begin(); ?>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!---->
<!--    <p>-->

<!--    </p>-->
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//
//            'ul',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>


	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],

//			'ul',
			[
				'attribute'=>'ul',
				'vAlign'=>'middle',
//				'width'=>'180px',
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(\app\poslug\models\UtUlica::find()->orderBy('ul')->asArray()->all(),'ul','ul'),
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>Yii::t('easyii', 'Ul')],
				'format'=>'raw'
			],
			'st_ul',
			[
				'class' => '\kartik\grid\ActionColumn',
//				'template' => '{view} {update} {delete}',
				'template' => '{update},{delete}',
//				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
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
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'.' '.$this->title.'</h3>',
			'type'=>'success',
			'before'=>Html::a(Yii::t('easyii', 'Create').' '.$this->title, ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'footer'=>true
		],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
			['content'=>
//				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success pull left', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid']). ' '.
				 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
//				 Html::a(Yii::t('easyii', 'Back'),Yii::$app->request->referrer, ['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Back'])
			],
			'{export}',
			'{toggleData}',
		]
	]); ?>

	<?php

//	$form = ActiveForm::begin();
//	$attribs = $model->formAttribs;
//	unset($attribs['attributes']['color']);
//	$attribs['attributes']['status'] = [
//	'type'=>TabularForm::INPUT_WIDGET,
//	'widgetClass'=>\kartik\widgets\SwitchInput::classname()
//	];

//	echo TabularForm::widget([
//	'dataProvider'=>$dataProvider,
//	'form'=>$form,
//	'attributes'=>$attribs,
//	'gridSettings'=>[
//	'floatHeader'=>true,
//	'panel'=>[
//	'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Manage Books</h3>',
//	'type' => GridView::TYPE_PRIMARY,
//	'after'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
//	Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
//	Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
//	]
//	]
//	]);
//	ActiveForm::end(); ?>
<!--    --><?php //Pjax::end(); ?>
</div>
