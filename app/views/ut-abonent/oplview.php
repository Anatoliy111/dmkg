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
	<h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

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
				'tipposl',
				'dt',
								[
									'attribute' => 'sum',
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
						'format' => ['date', 'php:MY'],
						'pageSummary' => 'Всього',
						'pageSummaryOptions' => ['class' =>'text-left text-warning'],
					],
					'tipposl',
					[
						'attribute' => 'summa',
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





