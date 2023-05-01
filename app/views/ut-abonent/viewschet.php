<?php

use app\poslug\components\PeriodKabWidget;
use app\poslug\models\UtTarif;
use kartik\builder\Form;
	use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\growl\Growl;
	use kartik\helpers\Html;
	use kartik\select2\Select2;
	use kartik\tabs\TabsX;
	use yii\bootstrap\Button;

//use yii\widgets\DetailView;
	use kartik\detail\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>




	<?php Pjax::begin(); ?>





<?php


	$this->title = $model->fio;

	$items = [
		[
			'label'=>'Послуги/Тарифи',
			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos,'dataProvider2' => $dptar,'abonents'=>$abonents]),
		],
		[
			'label'=>'Нарахування',
			'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar,'abonents'=>$abonents]),
		],
		[
			'label'=>'Оплата/Утримання',
			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl,'dataProvider2' => $dpuder,'abonents'=>$abonents]),
		],
		[
			'label'=>'Субсидія',
			'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub,'abonents'=>$abonents]),
		],
		[
			'label'=>'Зведена відомість',
			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abonents'=>$abonents]),
		],
	];



?>
<div class="ut-kart">
	<div class="mywell well-large container">



			<div class="schet col-xs-12">
				<div class="rah">
					<h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

				</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 box-sum">
						<h4>Сума до сплати</h4>
						<?php
						if (round($summa[$abon->id],2)<500){
							?>
							<div class="summa" style="color: #2e8e5a;">
								<h3><?= number_format(round($summa[$abon->id], 2), 2, '.', '') ?></h3>
							</div>

							<?php
						}
						if (round($summa[$abon->id],2)>=500 and round($summa[$abon->id],2)<1000){
							?>
							<div class="summa" style="color: #a937c9;">
								<h3><?= number_format(round($summa[$abon->id], 2), 2, '.', '')  ?></h3>
							</div>
							<?php

							?>
							<?php
						}
						if (round($summa[$abon->id],2)>=1000) {
							?>
							<div class="summa" style="color: #c91017;">
								<h3><?= number_format(round($summa[$abon->id], 2), 2, '.', '')  ?></h3>
							</div>
							<?php
						}
						?>
						<?php
						echo Html::a('Сплатити', Url::to('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D'), ['http','class' => 'btn-lg btn-success','target'=>"_blank"]);

						?>


					</div>


					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

						<?php
								echo GridView::widget([
									'dataProvider' =>  $dpdolg[$abon->id],

				//				'showPageSummary' => true,
									'columns' => [
		//								['class' => '\kartik\grid\SerialColumn'],
										'tipposl',
										[
											'attribute' => 'sal',
											'label'=>'Борг'
				//									'format'=>['decimal', 2],
				//									'pageSummary'=>true,
										],
										[
											'attribute' => 'summ',
											'label'=>'Оплата'
											//									'format'=>['decimal', 2],
											//									'pageSummary'=>true,
										],
										[
											'attribute' => 'dolgopl',
											'label'=>'Борг після оплати'
											//									'format'=>['decimal', 2],
											//									'pageSummary'=>true,
										],
		//								[
		//									'attribute' => 'opl',
		//									'label' => 'Оплата',
		////										'format'=>['decimal', 2],
		////										'pageSummary'=>true,
		//								],
				//				['class' => 'yii\grid\ActionColumn'],
									],

									'striped'=>false,
								'layout'=>"{items}",
				//					'layout' => $layout,
									'resizableColumns'=>true,
		//							'hover'=>true,
									'pjax'=>true,
									'pjaxSettings'=>[
										'neverTimeout'=>true,

									],
									'panel' => [
		//								'after'=>'',
				//					'footer'=>true,

									],

		//							'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
									'toolbar'=> [
				//						'{export}',
		//								'{toggleData}',
									]
								]);
						?>
					</div>
			</div>

	</div>
	<div class="mywell well-large2 container">


		<div class="col-xs-12">
			<div class="col-lg-4 .col-sm-4 .col-md-4">

				<?= PeriodKabWidget::widget() ?>
			</div>
		</div>


		<div class="col-xs-12 .col-sm-6 .col-lg-8">

		<?php
		echo TabsX::widget([
			'items'=>$items,
			'position'=>TabsX::POS_ABOVE,
			'encodeLabels'=>false,
			'bordered'=>true,
		]);
		?>

	</div>



    </div>
	<?php Pjax::end(); ?>
</div>


<script type="text/javascript">
	function PrePay(id)
	{
     var payid_abonent = id;
				$.ajax({
					url: "/ut-kart/pay",
					type: 'post',
					data: {payid_abonent},
					success: function(s) {
						//				alert(s);
					$('#modalpay').modal('show').modal({backdrop: false});
					$('#modal-content').html(s);


					}

				});

	}

</script>
