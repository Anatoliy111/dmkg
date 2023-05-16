<?php


use app\poslug\models\UtKart;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-info-view">

	<?php 		Modal::begin([
		'header' => '<h2>Складові тарифу</h2>',
		'id'=>'tar-modal',
		'size'=> 'modal-lg',
		'clientOptions' => ['backdrop' => false],

	]);


	echo "<div id='modalContentinfo'></div>";

	Modal::end(); ?>



	<?php


			?>
			<div class="rah">
			     <h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

			</div>
			<?php

			$layout = <<< HTML
			<div class="NameTab">
			     <h4>Послуги</h4>

			</div>
{items}
HTML;

				$layout2 = <<< HTML
			<div class="NameTab">
			     <h4>Тарифи по рухунку</h4>

			</div>
{items}
HTML;

			echo GridView::widget([
				'dataProvider' =>  $dataProvider,
				'columns' => [
				['class' => '\kartik\grid\SerialColumn'],
		     	[
		     		'attribute' => 'id_tipposl',
		     		'value' => 'tipposl.poslug',
		     	],
				'n_dog',
				'date_dog',
				],
				'layout' => $layout,
				'resizableColumns'=>true,
				'hover'=>true,
				'pjax'=>true,
				'striped'=>true,
				'floatHeaderOptions'=>['scrollingTop'=>'50'],
				'pjaxSettings'=>[
					'neverTimeout'=>true,
				],
			]);




	?>
	<div class="col-xs-12">

			<div class="center" style="padding-bottom: 20px; margin-left: auto; margin-right: auto;">
			<?= Html::a('<i class="glyphicon glyphicon-home"></i> Тарифи по будинку '.$abon->getUlica()->one()->ul.' '.$abon->dom  , ['/ut-dom/view', 'id' => $abon->id_dom], ['class' => 'btn btn-primary btn-block' ]) ?>
			</div>

	</div>

    <?php

	$prev = 0;
	echo GridView::widget([
		'dataProvider' =>  $dataProvider2,

		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			[
				'attribute' => 'period',
				'label' => 'Період',
				'format' => ['date', 'php:MY'],
			],
			[
				'attribute' => 'id_tipposl',
				'value' => 'tipposl.poslug',
				'group'=>true,
			],

			[
				'attribute' => 'id_tipposl',
				'label' => 'Показник',
				'format' => 'raw',
				'value' => 'poslvid.vid_pokaz',
				'group'=>true,
			],
			[
				'attribute' => 'name',
				'label'=>'Назва тарифу'
			],
			[
				'attribute' => 'tariffakt',
			],
			[
				'attribute' => 'norma',
			],
		],
		'layout' => $layout2,
		'resizableColumns'=>true,
		'hover'=>true,
		'pjax'=>false,
		'striped'=>true,
		'floatHeaderOptions'=>['scrollingTop'=>'50'],
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		],
	]);
	?>

</div>





