<?php

	use kartik\builder\Form;
	use kartik\form\ActiveForm;
	use kartik\helpers\Html;
	use kartik\select2\Select2;
	use kartik\tabs\TabsX;
	use yii\bootstrap\Button;

//use yii\widgets\DetailView;
	use kartik\detail\DetailView;
	use yii\helpers\ArrayHelper;

	/* @var $this yii\web\View */
/* @var $model app\models\UtKart */

$this->title = $model->fio;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
	foreach ($orgs as $k=>$org)
	{

	$items[$org->id_org] = [
//		[
//			'label'=>'<i class="glyphicon glyphicon-info-sign"></i> Загальна інформація',
////			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('infoview', ['model' => $model,'dataProvider' => $dpinfo[$org->id_org]]),
//			'active'=>true
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-info-sign"></i> Загальна інформація',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
		[
			'label'=>'<i class="glyphicon glyphicon-wrench"></i> Послуги',
			'content'=>$this->render('poslugview', ['model' => $model,'abonents'=>$abonents[$org->id_org],'dataProvider' => $dppos[$org->id_org]]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-flag"></i> Нарахування',
			'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-usd"></i> Оплата',
			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Субсидія',
			'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-retweet"></i> Зведена відомість',
			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-book"></i> Архів ',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],

	];

	}

?>
<div class="ut-kart">
	<div class="well well-large container">
		<div class="col-xs-1">

			<?= Html::a('Вихід', ['ut-kart/logout'], ['class' => 'btn btn-primary']) ?>

		</div>
		<div class="col-xs-6">
			<h2>Кабінет споживача</h2>


		</div>


<!--		<div class="col-xs-4">-->
<!--			--><?php
//
//				$form = ActiveForm::begin();
//
//				echo Select2::widget([
//					'model' => $model,
//					'attribute' => 'MonthYear',
//					'data' => ArrayHelper::map(\app\poslug\models\UtObor::find()->groupBy('period')->all(),'period','period'),
//					'hideSearch' => true,
////					'showToggleAll' => true,
//					'addon' => [
//						'append' => [
//							'content' => Html::submitButton('Go', ['class'=>'btn btn-primary']),
//							'asButton' => true
//						],
//					],
//					'pluginOptions' => [
//						'allowClear' => true,
//						'format' => ['date', 'php:MY'],
//					],
//				]);
//
//				ActiveForm::end();
//			?>
<!---->
<!---->
<!--		</div>-->

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
		<?php
			foreach ($orgs as $k=>$org)
			{

				if ($k==0)
				{
					$itemsorg[$org->id_org] =
						[
							'label'=>'<i class="glyphicon glyphicon-home"></i>'.' '.Html::encode($org->org->naim).'',
							'content'=>
							'<h3 class="panel-title" style="text-align:right">'. Yii::$app->formatter->asDate($_SESSION['period'][$org->id_org], 'LLLL-Y').'</h3>'.
								TabsX::widget([
								'items'=>$items[$org->id_org],
								'position'=>TabsX::POS_ABOVE,
								'encodeLabels'=>false,
								'bordered'=>true,
							]),
							'active'=>true,
//					'active'=>true,
					];
				}
				else
				{
				$itemsorg[$org->id_org] =
				[
					'label'=>'<i class="glyphicon glyphicon-home"></i>'.' '.Html::encode($org->org->naim).'',
					'content'=>
						TabsX::widget([
						'items'=>$items[$org->id_org],
						'position'=>TabsX::POS_ABOVE,
						'encodeLabels'=>false,
						'bordered'=>true,
					]),
				];

				}

			}




			echo TabsX::widget([
				'items'=>$itemsorg,
				'position'=>TabsX::POS_ABOVE,
				'encodeLabels'=>false,
//						'height'=>TabsX::SIZE_MEDIUM,

				'bordered'=>true,
			]);
		?>

	</div>
<!--				--><?php
//					echo TabsX::widget([
//						'items'=>$items,
//						'position'=>TabsX::POS_LEFT,
//						'encodeLabels'=>false,
////						'height'=>TabsX::SIZE_MEDIUM,
//
//						'bordered'=>true,
//					]);
//				?>

    </div>

</div>
