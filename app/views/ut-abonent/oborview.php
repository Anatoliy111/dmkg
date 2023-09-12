<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;



	//	use yii\bootstrap\

/* @var $this yii\web\View */
//	$today = new DateTime();


?>





<div class="utkart-info-view">


	<?php
		$pdfHeader = [
			'L' => [
				'content' => 'КП "Долинський міськкомунгосп"',
			],
			'C' => [
				'content' => 'Зведена відомість '.trim(iconv('windows-1251', 'UTF-8', $abon->schet)),
				'font-size' => 10,
				'font-style' => 'B',
				'font-family' => 'arial',
				'color' => '#333333'
			],
			'R' => [
				'content' => 'Згенеровано '.Yii::$app->formatter->asDatetime('now'),
			],
			'line' => true,
		];

		$pdfFooter = [
			'line' => true,
		];

			?>
			<div class="rah">
				<h4>Особовий рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $abon->schet)))?></h4>

			</div>

			<?php
            $allsum = $dataProvider->getModels();
			$layout = <<< HTML
			<div class="NameTab">
			     <h4>Зведена відомість</h4>

			</div>
{items}
HTML;
			echo GridView::widget([
				'dataProvider' =>  $dataProvider,
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
//											'mergeColumns'=>[[1,2]], // columns to merge in summary
											'content'=>[             // content to show in each summary cell
//												1=>'Summary (' . $model->period . ')',
												1=>"Всього",
												3=>GridView::F_SUM,
												4=>GridView::F_SUM,
												5=>GridView::F_SUM,
												6=>GridView::F_SUM,
												7=>GridView::F_SUM,
												8=>GridView::F_SUM,
											],
											'contentFormats'=>[      // content reformatting for each summary cell
												1=>['format'=>'text'],
												3=>['format'=>'number', 'decimals'=>2],
												4=>['format'=>'number', 'decimals'=>2],
												5=>['format'=>'number', 'decimals'=>2],
												6=>['format'=>'number', 'decimals'=>2],
												7=>['format'=>'number', 'decimals'=>2],
												8=>['format'=>'number', 'decimals'=>2],
											],
											'contentOptions'=>[      // content html attributes for each summary cell
//												1=>['style'=>'font-variant:small-caps'],
												3=>['style'=>'text-align:right'],
												4=>['style'=>'text-align:right'],
												5=>['style'=>'text-align:right'],
												6=>['style'=>'text-align:right'],
												7=>['style'=>'text-align:right'],
												8=>['style'=>'text-align:right'],
											],
											// html attributes for group summary row
											'options'=>['class'=>'success','style'=>'font-weight:bold;']
										];
									}
								],
                                [
                                    'attribute' => 'poslug',
                                    'value'=>function ($model) {
                                        return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                                    }
                                ],
								[
									'attribute' => 'dolg',
                                    'label' => 'Борг на початок',
								],
								[
									'attribute' => 'nach',
                                    'label' => 'Нарахування/Перерахунок',
								],
								[
									'attribute' => 'subs',
                                    'label' => 'Субсидія',
								],
									[
									'attribute' => 'oplnotsubs',
									'label' => 'Оплата / Утримання',
								],
								[
									'attribute' => 'sal',
                                    'label' => 'Борг на кінець',
								],

				],
				'exportConfig'=> [
					GridView::PDF=>[
						'label' => 'PDF',
						'filename' => 'Зведена відомість '.trim(iconv('windows-1251', 'UTF-8', $abon->schet)),
						'options' => ['title' => 'Portable Document Format'],
						'mime' => 'application/pdf',
						'config' => [
							'methods' => [
								'SetHeader' => [
									['odd' => $pdfHeader, 'even' => $pdfHeader]
								],
								'SetFooter' => [
									['odd' => $pdfFooter, 'even' => $pdfFooter]
								],
							],
							'options' => [
//								'title' => $title,
								'subject' => 'PDF export',
								'keywords' => 'pdf'
							],
							'contentBefore'=>'',
							'contentAfter'=>''
						]
					],
				],
				'striped'=>false,
				'layout' => $layout,
				'resizableColumns'=>true,
				'hover'=>true,
				'pjax'=>true,
				'pjaxSettings'=>[
					'neverTimeout'=>true,
				],
				'panel' => [
					'after'=>'',
				],
				'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
				'toolbar'=> [
					'{export}',
					'{toggleData}',
				]
			]);

	?>





</div>





