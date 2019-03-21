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

//        $lastperiod = UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one()->period;
//        $period = $lastperiod->modify('+1 month');;
        $period =date('Y-m-d', strtotime($lastperiod.' +1 month'));
?>

<!--<script type="text/javascript">-->
<!--	function ($)({-->
<!--		$("#btn-mod-pay").click(function(){-->
<!--			// нужный блок выбирается относительно this как предыдущий (prev)-->
<!--			var textBlock = $(this).prev('#block').text();-->
<!--			alert(textBlock);-->
<!--		});-->
<!---->
<!--	})/*end  ready*/-->
<!--</script>-->


	<?php Pjax::begin(); ?>

<?php 	Modal::begin([
			'header' => '<h2>Змінити код доступу</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
			'id' => 'passmodal-1',
			'size' => 'modal-md',

		]);
?>


<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
	'id' => 'pass-form1',

]); ?>

<?=	 $form->field($model, 'pass1')->passwordInput(['maxlength' => true])?>
<?=    $form->field($model, 'pass2')->passwordInput(['maxlength' => true])?>
<div class="buttons" style="padding-bottom: 20px">
	<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php
	ActiveForm::end();
?>

<?php Modal::end(); ?>

<?php
yii\bootstrap\Modal::begin([
	'header' => '<h2>Формування платежу</h2>',
	'id' => 'modalpay',
	'size' => 'modal-md',
]);
?>

<div id='modal-content'>Загружаю...</div>

<?php yii\bootstrap\Modal::end(); ?>



<div class="row">
	<?php

		$session = Yii::$app->session;
		if ($session->hasFlash('pass')) {

			echo Growl::widget([
				'type' => Growl::TYPE_SUCCESS,
//				'title' => 'Помилка!',
//				'icon' => 'glyphicon glyphicon-remove-sign',
				'body' => $session->getFlash('pass'),
				'showSeparator' => true,
				'delay' => 0,
				'pluginOptions' => [
//						'showProgressbar' => true,
					'placement' => [
						'from' => 'top',
						'align' => 'left',
					]
				]
			]);
		}
	?>
</div>

<?php


	$this->title = $model->fio;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


	$items = [
//		[
//			'label'=>'<i class="glyphicon glyphicon-info-sign"></i> Загальна інформація',
////			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('infoview', ['model' => $model,'dataProvider' => $dpinfo[$org->id_org]]),
//			'active'=>true
//		],
//		[
//			'label'=>'Загальна інформація',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
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
		<div class="col-sm-1">

			<?= Html::a('Вихід', ['ut-kart/logout'], ['class' => 'btn btn-primary']) ?>

		</div>
		<div class="col-sm-1">

			<?= Html::a("Змінити код доступу", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#passmodal-1','class'=>'btn btn-danger'])?>

		</div>

		<div class="col-xs-12">
			<h1>Кабінет споживача</h1>


		</div>




			<div class="col-sm-12">

						<?=
							DetailView::widget([
								'model' => $model,
								'hover'=>true,
//								'condensed'=>true,
								'striped'=>true,
								'mode'=>DetailView::MODE_VIEW,
//								'panel'=>[
//									'heading'=>'Book # ' . $model->id,
//									'type'=>DetailView::TYPE_INFO,
//								],

								'attributes' => [

									'fio',
									'idcod',
									'telef',
									[
										'label' => Yii::t('easyii', 'Adress'),

										'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
									],
								],
								'hAlign'=>DetailView::ALIGN_RIGHT ,
								'vAlign'=>DetailView::ALIGN_TOP  ,

							]) ?>
			</div>





		<div class="col-xs-12">
			<h2><?=Yii::$app->formatter->asDate($period, 'LLLL Y')?></h2>
		</div>
<!--		<div class="col-xs-12">-->

					<?php
					foreach ($abonents as $abon) {

					?>
			<div class="schet col-xs-12">
				<div class="rah">
					<h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

				</div>
					<div class="col-xs-4">
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
						if ($abon->id==2071) {
							echo Html::button("Сплатити", [
								'id' => 'btn-pay',
								'class' => 'btn btn-success',
								'onclick' => "PrePay($abon->id)",
							]);
?>
						<div class="col-sm-1">

							<?= Html::a('Вихід', ['ut-kart/logout'], ['class' => 'btn btn-primary']) ?>
							<?= Html::button("Сплатити", [
							'id' => 'btn-pay',
							'class' => 'btn btn-success',
							'onclick' => "PrePay($abon->id)",
							])?>

						</div>
						<div class="col-sm-1">

							<?= Html::a("Змінити код доступу", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#passmodal-1','class'=>'btn btn-danger'])?>

						</div>
<?php

						echo Html::a('Вихід', ['class' => 'btn btn-primary','onclick' => "PrePay($abon->id)"]);

//							echo Html::a('callback', ['/ut-kart/callback'], [
//								'data' => [
//									'method' => 'post',
//									'params' => [
//										'data' => 'eyJhY3Rpb24iOiJwYXkiLCJwYXltZW50X2lkIjo5NzY1NDQxNDAsInN0YXR1'
//												    .'cyI6InNhbmRib3giLCJ2ZXJzaW9uIjozLCJ0eXBlIjoiYnV5IiwicGF5dHlwZSI6InByaXZhdDI0I'
//													.'iwicHVibGljX2tleSI6ImkyNjE3Nzk3NTkxMSIsImFjcV9pZCI6NDE0OTYzLCJvcmRlcl9pZCI6Ij'
//													.'UiLCJsaXFwYXlfb3JkZXJfaWQiOiJVSjZBTERJVjE1NTI4OTg4MjM0NDYxMjYiLCJkZXNjcmlwdGl'
//													.'vbiI6ItCe0L/Qu9Cw0YLQsCDQv9C+INGA0LDRhdGD0L3QutGDIDAwOTIxMjQg0LfQsCDQv9C+0YHQ'
//													.'u9GD0LPQuDrQntC/0LDQu9C10L3QvdGPOjQwICIsInNlbmRlcl9waG9uZSI6IjM4MDY2OTczNDU5M'
//													.'CIsInNlbmRlcl9maXJzdF9uYW1lIjoi0KDQvtC80LDQvSIsInNlbmRlcl9sYXN0X25hbWUiOiLQmN'
//													.'Cy0LDRidC10L3QutC+Iiwic2VuZGVyX2NhcmRfbWFzazIiOiI1MTY4NzUqNTUiLCJzZW5kZXJfY2F'
//													.'yZF9iYW5rIjoicGIiLCJzZW5kZXJfY2FyZF90eXBlIjoibWMiLCJzZW5kZXJfY2FyZF9jb3VudHJ5'
//													.'Ijo4MDQsImlwIjoiMTc4LjIxNC4xNjEuMzkiLCJhbW91bnQiOjQwLjAsImN1cnJlbmN5IjoiVUFII'
//													.'iwic2VuZGVyX2NvbW1pc3Npb24iOjAuMCwicmVjZWl2ZXJfY29tbWlzc2lvbiI6My4wLCJhZ2VudF'
//													.'9jb21taXNzaW9uIjowLjAsImFtb3VudF9kZWJpdCI6NDAuMCwiYW1vdW50X2NyZWRpdCI6NDAuMCw'
//													.'iY29tbWlzc2lvbl9kZWJpdCI6MC4wLCJjb21taXNzaW9uX2NyZWRpdCI6My4wLCJjdXJyZW5jeV9k'
//													.'ZWJpdCI6IlVBSCIsImN1cnJlbmN5X2NyZWRpdCI6IlVBSCIsInNlbmRlcl9ib251cyI6MC4wLCJhb'
//													.'W91bnRfYm9udXMiOjAuMCwibXBpX2VjaSI6IjciLCJpc18zZHMiOmZhbHNlLCJsYW5ndWFnZSI6In'
//													.'VrIiwiY3JlYXRlX2RhdGUiOjE1NTI4OTg3NTg4MTAsImVuZF9kYXRlIjoxNTUyODk4ODIzNDY0LCJ'
//													.'0cmFuc2FjdGlvbl9pZCI6OTc2NTQ0MTQwfQ==',
//										'signature' => '1/9Fuu4GNBVeLgSwOb/cCs8m03A=',
//									],
//								],
//							]);
						}



						?>

					</div>


					<div class="col-lg-8">

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

				<?php
					}
					?>

	</div>
	<div class="mywell well-large2 container">

<!--		</div>-->
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
//		var keys = $('#gridfile').yiiGridView('getSelectedRows');
//		if (keys.length != 0){
//			var hi= confirm("Ви впевненні що хочете видалити ці файли?");
//			if (hi== true){

				$.ajax({
					url: "/ut-kart/pay",
					type: 'post',
					data: {payid_abonent},
					success: function(s) {
						//				alert(s);
					$('#modalpay').modal('show').modal({backdrop: false});
					$('#modal-content').html(s);
//						.load($(this).attr('href'));

					}

				});

//			}
//		}


	}


//		$("#pay-form").on("submit", function (event) {
//			alert("1");
//			event.preventDefault();
//			var $this = $(this);
//			var frmValues = $this.serialize();
//			$.ajax({
//					type: $this.attr('method'),
//					url: $this.attr('action'),
//					data: frmValues
//				})
//				.done(function () {
//					$("#para").text("Done!" + frmValues);
//				})
//				.fail(function () {
//					$("#para").text("An error occured!");
//				});
//		});
//
//
//
//
//		$(document).on('click', '#modalpay', function (e) {
//				e.modalWindow = true;
//			})
//			.on('click', function (e) {
//				if (!e.modalWindow) {
//					console.log('Это — не моя клетка!');
//				}
//			});



</script>
