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

<?php 	Modal::begin([
    'header' => '<h2>Зареєструвати електронну пошту</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'emailreg',
    'size' => 'modal-md',

]);
?>

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
    'id' => 'email-form1',

]); ?>

<?=	 $form->field($model, 'email', ['addon' => ['type'=>'prepend', 'content'=>'@']]);?>

<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php
ActiveForm::end();
?>

<?php Modal::end(); ?>

<?php 	Modal::begin([
    'header' => '<h2>Змінити електронну пошту</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'emailchange',
    'size' => 'modal-md',

]);
?>

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
    'id' => 'email-form2',

]); ?>

<?=	 $form->field($model, 'email', ['addon' => ['type'=>'prepend', 'content'=>'@']]);?>

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
			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos,'dataProvider2' => $dptar,'abon'=>$abon]),
		],
		[
			'label'=>'Нарахування',
			'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar,'abon'=>$abon]),
		],
		[
			'label'=>'Оплата/Утримання',
			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl,'dataProvider2' => $dpuder,'abon'=>$abon]),
		],
		[
			'label'=>'Субсидія',
			'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub,'abon'=>$abon]),
		],
		[
			'label'=>'Зведена відомість',
			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
		],
        [
            'label'=>'Зведена відомість',
            'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
        ],
        [
            'label'=>'Зведена відомість',
            'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
        ],
        [
            'label'=>'Зведена відомість',
            'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
        ],
        [
            'label'=>'Зведена відомість',
            'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
        ],
        [
            'label'=>'Зведена відомість',
            'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$abon]),
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
                                    'email',
//                                    [
//                                        'label' => 'email',
//                                        'value' => function ($key) {
//                                            if ($key->email==null) {
//                                                $res = '-----------------';
//                                            }
//                                            else
//                                                $res = $key->email;
//                                            return $res;
//                                        }
//                                    ],
//                                    [
//                                        'label'=>' ',
//                                        'format'=>'raw',
//                                        'value'=>function ($model, $key){
//                                            if (!empty($key->model['email']))
//                                            {
//                                                return Html::a("Змінити пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailchange','class'=>'btn-sm btn-success']);
//                                            }
//                                            else
//                                            {
//                                                return Html::a("Зареєструвати пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailreg','class'=>'btn-sm btn-danger']);
//                                            }
//
//                                        }
//                                    ],
									[
										'label' => Yii::t('easyii', 'Adress'),

										'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
									],
								],
								'hAlign'=>DetailView::ALIGN_RIGHT ,
								'vAlign'=>DetailView::ALIGN_TOP  ,

							]) ?>
			</div>

<!--        --><?php
//           if (strlen(trim($model->email)) == 0 ) {
//        ?>
<!--               <div class="mess col-xs-12" style="color: #c91017;">-->
<!--                   <h4>Увага!!! Заповніть та пройдіть верифікацію електронної пошти!!! В майбутньому буде змінено формат входу в кабінет за допомогою електронної пошти.</h4>-->
<!--               </div>-->
<!---->
<!--        --><?php
//           }
//        ?>






		<div class="col-xs-12">
			<h2><?=Yii::$app->formatter->asDate($period, 'LLLL Y')?></h2>
		</div>
<!--		<div class="col-xs-12">-->


			<div class="schet col-xs-12">
				<div class="rah">
					<h4>Особовий рахунок <?= Html::encode($model->schet)?></h4>

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


//						if ($abon->id==2071) {
//							echo Html::button("Сплатити", [
//							//	'value'=>Url::to("https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D"),
//								'class' => 'btn btn-success btn-lg btn-block',
//							//	'onclick' => "PrePay($abon->id)",
//								//'onclick' => "location.href='https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D'",
//								'href' => "https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D",
//								'target'=> "_blank",
//							]);



//						}
//						?>
<!--						--><?php
//						if ($abon->id==3703) {
//							echo Html::button("Сплатити", [
//							//	'value'=>Url::to("https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D"),
//								'class' => 'btn btn-success btn-lg btn-block',
//								//'onclick' => "PrePay($abon->id)",
//								//'onclick' => "location.href='https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D'",
//								'href' => "https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D",
//								'target'=> "_blank",
//							]);
////							echo Html::a('Сплатити', [Url::to('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')], ['class' => 'btn-lg btn-success','target'=>"_blank"]);
//
//
//						}
//						?>

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
            'enableStickyTabs' => true,
         //   'pluginOptions' => ['enableCache' => false],
//            'stickyTabsOptions' => [
//                'selectorAttribute' => 'data-target',
//                'backToTop' => false,
//            ],
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
