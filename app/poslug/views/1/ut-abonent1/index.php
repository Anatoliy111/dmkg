<?php

use yii\helpers\Html;
	use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtAbonent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ut Abonents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-abonent-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php Pjax::begin(); ?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
//            'id',
			'id_kart',
			'schet',
			'FIO',
			[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
			// 'tel',
		],
		'resizableColumns'=>true,
		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
		'floatHeader'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
		'showPageSummary' => true,
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> Абоненти</h3>',
			'type'=>'success',
			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Додати абонента', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'footer'=>false
		],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> [
//			['content'=>
//				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
//			],
			'{export}',
			'{toggleData}',
		]
	]); ?>

    <?php Pjax::end(); ?>
</div>
