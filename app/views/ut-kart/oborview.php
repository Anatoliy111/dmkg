<?php


	use kartik\grid\GridView;
	use yii\helpers\Html;



	//	use yii\bootstrap\

/* @var $this yii\web\View */
//	$today = new DateTime();
	$pdfHeader = [
		'L' => [
			'content' => 'КП "Долинський міськкомунгосп"',
		],
		'C' => [
			'content' => 'Зведена відомість',
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
//				'showPageSummary' => true,
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
												1=>"tt"."yyyxdfggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg",
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
												1=>['style'=>'font-variant:small-caps'],
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
				'tipposl',
								[
									'attribute' => 'dolg',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
								[
									'attribute' => 'nach',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
								[
									'attribute' => 'subs',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
									[
									'attribute' => 'opl',
									'label' => 'Оплата / Утримання',
//										'format'=>['decimal', 2],
//										'pageSummary'=>true,
								],
								[
									'attribute' => 'pere',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
								[
									'attribute' => 'sal',
//									'format'=>['decimal', 2],
//									'pageSummary'=>true,
								],
//				['class' => 'yii\grid\ActionColumn'],
				],
				'exportConfig'=> [
					GridView::PDF=>[
						'label' => 'PDF',
//						'icon' => '',
//						'iconOptions' => '',
//						'showHeader' => false,
//						'showPageSummary' => false,
//						'showFooter' => false,
//						'showCaption' => false,
//						'filename' => 'yii',
//						'alertMsg' => 'created',
//						'options' => ['title' => 'Semicolon -  Separated Values'],
						'filename' => 'Зведена відомість',
//						'alertMsg' => 'The PDF export file will be generated for download.',
						'options' => ['title' => 'Portable Document Format'],
						'mime' => 'application/pdf',
						'config' => [
//							'mode' => 'c',
//							'format' => 'A4-L',
//							'destination' => 'D',
//							'marginTop' => 20,
//							'marginBottom' => 20,
//							'cssInline' => '.kv-wrap{padding:20px;}' .
//								'.kv-align-center{text-align:center;}' .
//								'.kv-align-left{text-align:left;}' .
//								'.kv-align-right{text-align:right;}' .
//								'.kv-align-top{vertical-align:top!important;}' .
//								'.kv-align-bottom{vertical-align:bottom!important;}' .
//								'.kv-align-middle{vertical-align:middle!important;}' .
//								'.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
//								'.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
//								'.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
							'methods' => [
								'SetHeader' => [
									['odd' => $pdfHeader, 'even' => $pdfHeader]
								],
//								'SetFooter' => [
//									['odd' => $pdfFooter, 'even' => $pdfFooter]
//								],
							],
							'options' => [
								'title' => $title,
								'subject' => 'PDF export generated by kartik-v/yii2-grid extension',
								'keywords' => 'krajee, grid, export, yii2-grid, pdf'
							],
							'contentBefore'=>'',
							'contentAfter'=>''
						]
					],
				],
				'striped'=>false,
				'layout'=>"{items}",
				'resizableColumns'=>true,
				'hover'=>true,
//		'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
//		'floatHeader'=>true,
//				'floatHeaderOptions'=>['scrollingTop'=>'50'],
				'pjax'=>true,
				'pjaxSettings'=>[
					'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
				],
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
				'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
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





