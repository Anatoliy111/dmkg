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

        $period =date('Y-m-d', strtotime($lastperiod.' +1 month'));
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


<div class="ut-kart">
	<div class="mywell well-large container">
		<div class="col-sm-1">

			<?= Html::a('Вихід', ['ut-abonent/logout'], ['class' => 'btn btn-primary']) ?>

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
									'telefon',
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
                                    [
                                        'label'=>' ',
                                        'format'=>'raw',
                                        'value'=>function ($model, $key){
                                            if (!empty($key->model['email']))
                                            {
                                                return Html::a("Змінити пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailchange','class'=>'btn-sm btn-success']);
                                            }
                                            else
                                            {
                                                return Html::a("Зареєструвати пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailreg','class'=>'btn-sm btn-danger']);
                                            }

                                        }
                                    ],
								],
								'hAlign'=>DetailView::ALIGN_RIGHT ,
								'vAlign'=>DetailView::ALIGN_TOP  ,

							]) ?>
			</div>

        <?php
           if (strlen(trim($model->email)) == 0 ) {
        ?>
               <div class="mess col-xs-12" style="color: #c91017;">
                   <h4>Увага!!! Заповніть та пройдіть верифікацію електронної пошти!!! В майбутньому буде змінено формат входу в кабінет за допомогою електронної пошти.</h4>
               </div>

        <?php
           }
        ?>






		<div class="col-xs-12">
			<h2><?=Yii::$app->formatter->asDate($period, 'LLLL Y')?></h2>
		</div>
