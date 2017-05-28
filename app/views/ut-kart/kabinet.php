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
	$items = [
		[
			'label'=>'<i class="glyphicon glyphicon-home"></i> Загальна інформація',
//			'content'=>'dgfdgggggggggggggggggggg',
			'content'=>$this->render('infoview', ['model' => $model,'dataProvider' => $dpinfo]),
			'active'=>true
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Послуги',
			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl,'abonents'=>$abonents]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Нарахування',
			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Оплата',
			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Супсидія',
			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor]),
		],
		[
			'label'=>'<i class="glyphicon glyphicon-user"></i> Зведена відомість',
			'content'=>'dgfdgggggggggggggggggggg',
//			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor]),
		],

	];



?>
<div class="ut-kart">
	<div class="well well-large container">
		<div class="col-xs-4 pull-right">
			<?php



				echo Select2::widget([
					'model' => $model,
					'attribute' => 'periodd',
					'data' => ArrayHelper::map(\app\poslug\models\UtObor::find()->groupBy('period')->all(),'period','period'),
					'hideSearch' => true,
//					'showToggleAll' => true,
					'addon' => [
						'append' => [
							'content' => Html::submitButton('Go', ['class'=>'btn btn-primary']),
							'asButton' => true
						],
					],
					'pluginOptions' => [
						'allowClear' => true,
						'format' => ['date', 'php:MY'],
					],
				]);
			?>

		</div>
		<h3 class="text-center">Кабінет споживача</h3>


		<?php
			foreach ($orgs as $k=>$org)
			{

				if ($k==0)
				{
					$itemsorg[$org->id_org] =
						[
							'label'=>'<i class="glyphicon glyphicon-home">'.Html::encode($abon->org->naim).'</i>',
							'content'=>	 TabsX::widget([
								'items'=>$items,
								'position'=>TabsX::POS_LEFT,
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
					'label'=>'<i class="glyphicon glyphicon-home"></i>xcbgdfhdfh',
					'content'=>	 TabsX::widget([
						'items'=>$items,
						'position'=>TabsX::POS_LEFT,
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
