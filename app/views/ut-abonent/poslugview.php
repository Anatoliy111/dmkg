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
			     <h4>Особовий рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $abon->schet)))?></h4>
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
                        'attribute' => 'poslug',
                        'label' => 'Послуга',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                        }
                    ],
                    [
                        'attribute' => 'n_dog',
                        'label' => '№ договору',
                    ],
                    [
                        'attribute' => 'd_dog',
                        'label' => 'Дата договору',
                    ],
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




	$prev = 0;
	echo GridView::widget([
		'dataProvider' =>  $dataProvider,

		'columns' => [
			['class' => '\kartik\grid\SerialColumn'],
			[
				'attribute' => 'period',
                'label' => 'Період',
				'format' => ['date', 'php:MY'],
			],
            [
                'attribute' => 'poslug',
                'label' => 'Послуга',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                }
            ],
			[
				'attribute' => 'vid',
                'label' => 'Вид показника',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["vid"]);
                },
				'format' => 'raw',
			],
			[
				'attribute' => 'tarname',
                'label' => 'Назва тарифу',
                'value'=>function ($model) {
                    return iconv('windows-1251', 'UTF-8', $model["tarname"]);
                }
			],
			[
				'attribute' => 'tartarif',
                'label' => 'Тариф',
			],
			[
				'attribute' => 'tarnorma',
                'label' => 'Норма',
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





