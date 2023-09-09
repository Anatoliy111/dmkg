<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;


	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-sub-view">


	<?php


			?>
	<div class="rah">
	<h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

</div>

			<?php

				$layout = <<< HTML
			<div class="NameTab">
			     <h4>Субсидія</h4>

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
                                    'value'=>function ($model) {
                                        return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                                    }
                                ],
								[
									'attribute' => 'subs',
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





