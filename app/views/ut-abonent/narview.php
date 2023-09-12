<?php


	use kartik\grid\GridView;
	use yii\bootstrap\Tabs;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart">



	<div class="rah">
	<h4>Особовий рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $abon->schet)))?></h4>

</div>

	<?php

		$layout = <<< HTML
			<div class="NameTab">
			     <h4>Нарахування</h4>

			</div>
{items}
HTML;
			echo GridView::widget([
				'dataProvider' =>  $dataProvider,
				'showPageSummary' => true,
				'columns' => [
					['class' => '\kartik\grid\SerialColumn'],
				[
						'attribute' => 'period',
					    'label' => 'Період',
						'format' => ['date', 'php:MY'],
					'pageSummary' => 'Всього',
					'pageSummaryOptions' => ['class' =>'text-left text-warning'],
				],
                    [
                        'attribute' => 'naim',
                        'label' => 'Плслуга',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["naim"]);
                        }
                    ],
                    [
                        'attribute' => 'tarif',
                        'label' => 'Тариф',
                    ],
                    [
                        'attribute' => 'vid',
                        'label' => 'Вид показника',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["vid"]);
                        }
                    ],
//					[
//						'attribute' => 'id_tipposl',
//						'label' => 'Показник',
//						'format' => 'raw',
//						'value' => 'poslvid.vid_pokaz',
//					],
                    [
                        'attribute' => 'razn',
                        'label' => 'Показник',
                    ],
                    [
                        'attribute' => 'par',
                        'label' => 'Од.виміру',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["par"]);
                        }
                    ],
					[
						'attribute' => 'sum',
                        'label' => 'Сума',
						'format'=>['decimal', 2],
						'pageSummary'=>true,
					],
				],
				'layout' => $layout,
				'resizableColumns'=>true,
				'hover'=>true,
			]);

	?>





</div>





