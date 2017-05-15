<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
	use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Setting');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-org-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--	--><?php //Pjax::begin(); ?>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			'naim',
			'naim_full',
			'edrpou',
			'adress',
			'tel',
			[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
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
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> Організації</h3>',
			'type'=>'success',
			'before'=>Html::a(Yii::t('easyii', 'Create Ut Org'), ['create'], ['class' => 'btn btn-success']),
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





<!--	--><?php //Pjax::end(); ?>



	<?= Html::a('OldDOM', ['ut-olddom/index'], ['class' => 'btn-lg btn-success']) ?>
	<?= Html::a('OldKART', ['default/oldkart'], ['class' => 'btn-lg btn-success']) ?>
	<?= Html::a('OldORGAN', ['default/oldorg'], ['class' => 'btn-lg btn-success']) ?>

</div>
