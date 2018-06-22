<?php

use app\poslug\components\PeriodKabWidget;
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

			<div class="panel panel-success">
				<div class="panel-heading">
					<h4><?=Yii::$app->formatter->asDate(Yii::$app->session['period'], 'LLLL Y')?></h4>
				</div>
				<div class="panel-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
				</div>
				<div class="panel-footer">
					Panel Footer
				</div>
			</div>
		</div>


		<div class="col-xs-12">


			<div class="col-xs-4">

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
