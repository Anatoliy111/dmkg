<?php

	use kartik\dialog\Dialog;
	use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDomnaryad */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Ut Domnaryads');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 		Modal::begin([
	'id'=>'nar-modal',
	'size'=> 'modal-lg',
//	'toggleButton' => false,
//	'options'=>[
//		'backdrop' => 'static',
//	],
	'clientOptions' => ['backdrop' => false],

]);
 echo $this->render('create', ['model' => $model]);

Modal::end(); ?>


<div class="ut-domnaryad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			[
				'attribute'=>'period',
				'label' => 'Період',
				'width'=>'110px',
				'value' => function ($model){
					return Yii::$app->formatter->asDate($model->period, 'LLLL Y');
				} ,
			],
			[
				'attribute' => 'id_tarifvid',
				'value' => 'idTarifv.name',
			],
			[
				'attribute' => 'id_sotr',
				'value' => 'sotr.fio',
			],
			'summa',
			[
				'attribute' => 'proveden',
				'label' => 'Проведений',
				'class' => '\kartik\grid\BooleanColumn',

			],
			[
				'class' => '\kartik\grid\ActionColumn',
				'template' => '{update} {delete}',
				'deleteOptions' => [ 'class' => 'btn btn-xs btn-danger', 'title' => 'Delete',
									 'type' => Dialog::TYPE_DANGER,
				],
			],
		],
//		'resizableColumns'=>true,
//		'floatHeaderOptions'=>['scrollingTop'=>'50'],
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		],
		'panel' => [
//			'heading'=>'<h3 class="panel-title"></i>'.' '.$this->title.'</h3>',
			'before'=>Html::a($this->title, ['create'], ['data-toggle' =>'modal', 'data-target' =>'#nar-modal','class'=>'btn btn-success']),
		],
//		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
//		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
			'{export}',
			'{toggleData}',
		]
	]); ?>



    <?php Pjax::end(); ?>
</div>
