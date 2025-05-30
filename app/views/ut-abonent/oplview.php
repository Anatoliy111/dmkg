<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-info-view">




	<?php


			?>
	<div class="rah">
	<h4>Особовий рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $abon->schet)))?></h4>

</div>


			<?php
				$layout = <<< HTML
			<div class="NameTab">
			   <h4>Оплата</h4>

			</div>
{items}
HTML;

				$layout2 = <<< HTML
			<div class="NameTab">
			     <h4>Утримання</h4>

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
                                    'attribute' => 'poslug',
                                    'label' => 'Послуга',
                                    'value'=>function ($model) {
                                        return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                                    }
                                ],
                                [
                                    'attribute' => 'dt',
                                    'label' => 'Дата',
                                ],
								[
									'attribute' => 'summ',
                                    'label' => 'Сума оплати',
									'format'=>['decimal', 2],
									'pageSummary'=>true,
								],
				],
				'layout' => $layout,
				'resizableColumns'=>true,
				'hover'=>true,
			]);


			echo GridView::widget([
				'dataProvider' =>  $dataProvider2,
				'showPageSummary' => true,
				'columns' => [
					['class' => '\kartik\grid\SerialColumn'],
					[
						'attribute' => 'period',
						'label' => 'Період',
						'format' => ['date', 'LLLL Y'],
						'pageSummary' => 'Всього',
						'pageSummaryOptions' => ['class' =>'text-left text-warning'],
					],
                    [
                        'attribute' => 'poslug',
                        'label' => 'Послуга',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                        }
                    ],
					[
						'attribute' => 'uder',
                        'label' => 'Сума утримань',
						'format'=>['decimal', 2],
						'pageSummary'=>true,
					],
				],
				'layout' => $layout2,
				'resizableColumns'=>true,
				'hover'=>true,
			]);

	?>





</div>





