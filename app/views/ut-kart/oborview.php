<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;



	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>





<div class="utkart-obor-view">


	<?php
		foreach ($abonents as $abon) {

			?>
	<div class="rah"
	<h3>Особовий рахунок <?= Html::encode($abon->schet)?></h3>

</div>

			<?php
            $allsum = $dataProvider[$abon->id]->getModels();
			$layout = <<< HTML
			<div class="NameTab"
			     <h3>Зведена відомість</h3>

			</div>
{items}
HTML;
			echo GridView::widget([
				'dataProvider' =>  $dataProvider[$abon->id],
				'showPageSummary' => true,
							'columns' => [
								['class' => '\kartik\grid\SerialColumn'],


								[
									'attribute' => 'period',
									'label' => 'Період',
									'format' => ['date', 'php:MY'],
									'pageSummary' => 'Всього по сторінці',
									'pageSummaryOptions' => ['class' =>'text-left text-warning'],
									'group'=>true,
									'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
										return [
											'mergeColumns'=>[[1,2]], // columns to merge in summary
											'content'=>[             // content to show in each summary cell
												2=>'Summary:',
												3=>GridView::F_SUM,
												4=>GridView::F_SUM,
												5=>GridView::F_SUM,
												6=>GridView::F_SUM,
												7=>GridView::F_SUM,
												8=>GridView::F_SUM,
											],
											'contentFormats'=>[      // content reformatting for each summary cell
												3=>['format'=>'number', 'decimals'=>2],
												4=>['format'=>'number', 'decimals'=>2],
												5=>['format'=>'number', 'decimals'=>2],
												6=>['format'=>'number', 'decimals'=>2],
												7=>['format'=>'number', 'decimals'=>2],
												8=>['format'=>'number', 'decimals'=>2],
											],
											'contentOptions'=>[      // content html attributes for each summary cell
												1=>['style'=>'font-variant:small-caps'],
//												4=>['style'=>'text-align:right'],
//												5=>['style'=>'text-align:right'],
//												6=>['style'=>'text-align:right'],
											],
											// html attributes for group summary row
											'options'=>['class'=>'success','style'=>'font-weight:bold;']
										];
									}
								],
				'tipposl',
								[
									'attribute' => 'dolg',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
								[
									'attribute' => 'nach',
//									'format'=>['decimal', 2],
									'pageSummary'=>true,
								],
								[
									'attribute' => 'subs',
//									'format'=>['decimal', 2],
									'pageSummary'=>true,
								],
									[
									'attribute' => 'opl',
									'label' => 'Оплата / Утримання',
//										'format'=>['decimal', 2],
										'pageSummary'=>true,
								],
								[
									'attribute' => 'pere',
//									'format'=>['decimal', 2],
									'pageSummary'=>true,
								],
								[
									'attribute' => 'sal',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
//				['class' => 'yii\grid\ActionColumn'],
				],
				'striped'=>false,
				'layout'=>"{items}",
				'resizableColumns'=>true,
				'hover'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
//				'floatHeaderOptions'=>['scrollingTop'=>'50'],
//				'pjax'=>true,
//				'pjaxSettings'=>[
//					'neverTimeout'=>true,
////			'beforeGrid'=>'My fancy content before.',
////			'afterGrid'=>'My fancy content after.',
//				],
				'panel' => [
//					'heading'=>'<h3 class="panel-title">'.' Зведена відомість '.'</h3>',
					'heading'=>'<div class="NameTab"<h3>'.'Зведена відомість'.'</h3></div>',
//					'type'=>'primary',
//					'before'=>Html::a(Yii::t('easyii', 'Create Ut Olddom'), ['create'], ['class' => 'btn btn-success']),
//					'after'=>function($allsum){
//						$summ = 0;
//						foreach($allsum as $sum)
//						{
//							if ($sum > 0)
//							{
//								$summ = $summ + $sum;
//							}
//						}
//						return $summ;
//					},
//					'footer'=>true,
				],
//		'panelBeforeTemplate' => [
//			'{before}' => 'true',
//		],
//				'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
//				'headerRowOptions'=>['class'=>'kartik-sheet-style'],
//				'filterRowOptions'=>['class'=>'kartik-sheet-style'],
				'toolbar'=> [
//					['content'=>
//				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
//						 Html::a(Yii::t('easyii', 'Update'), ['updateall'], ['class' => 'btn btn-danger'])
//					],
					'{export}',
					'{toggleData}',
				]
			]);
		}
	?>





</div>





