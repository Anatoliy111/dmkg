<?php

	use kartik\builder\Form;
	use kartik\form\ActiveForm;
	use kartik\growl\Growl;
	use kartik\helpers\Html;
	use kartik\select2\Select2;
	use kartik\tabs\TabsX;
	use yii\bootstrap\Button;

//use yii\widgets\DetailView;
	use kartik\detail\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
	use yii\widgets\Pjax;

	/* @var $this yii\web\View */
/* @var $model app\models\UtKart */

	?>
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
//			'label'=>'Загальна інформація',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
		[
			'label'=>'Послуги/Тарифи',
			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'dataProvider2' => $dptar[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'Нарахування',
			'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'Оплата/Утримання',
			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl[$org->id_org],'dataProvider2' => $dpuder[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'Субсидія',
			'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
		[
			'label'=>'Зведена відомість',
			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
		],
//		[
//			'label'=>'Архів ',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],


		////////////////////////////////////////////////////////////////////

//		[
//			'label'=>'<i class="glyphicon glyphicon-info-sign"></i> Загальна інформація',
//			'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dppos[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-wrench"></i> Послуги',
//			'content'=>$this->render('poslugview', ['model' => $model,'abonents'=>$abonents[$org->id_org],'dataProvider' => $dppos[$org->id_org]]),
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-flag"></i> Нарахування',
//			'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-usd"></i> Оплата/Утримання',
//			'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl[$org->id_org],'dataProvider2' => $dpuder[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-user"></i> Субсидія',
//			'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
//		[
//			'label'=>'<i class="glyphicon glyphicon-retweet"></i> Зведена відомість',
//			'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor[$org->id_org],'abonents'=>$abonents[$org->id_org]]),
//		],
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


		<div class="col-sm-4">

			<?= Html::a("Змінити код доступу", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#passmodal-1','class'=>'btn-sm btn-success'])?>

		</div>


		<div class="col-xs-12 .col-sm-6 .col-lg-8">
		<?php
			foreach ($orgs as $k=>$org)
			{

				if ($k==0)
				{
					$itemsorg[$org->id_org] =
						[
							'label'=>'<i class="glyphicon glyphicon-home"></i>'.' '.Html::encode($org->org->naim).'',
							'content'=>
							'<div class="col-xs-12 .col-sm-6 .col-lg-8">'.
							'<h2 class="panel-danger" style="text-align:right">'. Yii::$app->formatter->asDate($_SESSION['period'][$org->id_org], 'LLLL-Y').'  '.Html::a('Архів', ['ut-kart/logout'], ['class' => 'btn-lg btn-success']).'</h2>'.
							'</div>'.
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
	<?php Pjax::end(); ?>
</div>
