<?php

use app\poslug\components\PeriodKabWidget;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\growl\Growl;
use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\nav\NavX;
use kartik\tabs\TabsX;
use yii\bootstrap\Modal;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Pjax;

        $period =date('Y-m-d', strtotime($lastperiod.' +1 month'));
?>




	<?php Pjax::begin(); ?>

<?php 	Modal::begin([
			'header' => '<h2>Змінити пароль</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
			'id' => 'passmodal-5',
			'size' => 'modal-md',
            'headerOptions' => [
                'style' => 'text-align: center;'
            ],

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
    'id' => 'emailreg',
    'size' => 'modal-md',

]);
?>

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
    'id' => 'email-form1',

]); ?>

<?=	 $form->field($modelemail, 'email', ['addon' => ['type'=>'prepend', 'content'=>'@']]);?>

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

<?=	 $form->field($modelemail, 'email', ['addon' => ['type'=>'prepend', 'content'=>'@']]);?>

<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    <?//= Html::a('Зберегти', ['ut-abonent/changeemail'], ['class' => 'btn btn-primary']) ?>
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



<?=  $this->render('modalmess', ['modalformheader' => 'Змінити електронну пошту','modalformimage' => 'email.png','modalformtext' => 'На вашу пошту '.$emailchange.' відправлено лист з посиланням для підтвердження зміни пошти. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!']);?>




<div class="row">



	<?php


    if ($emailchange<>'') {
            if ($emailchange=='error') {
                $this->registerJs(
                "$('#emailchange').modal('show');",
                yii\web\View::POS_READY
                );
            }
            else{
                $this->registerJs(
                "$('#modalmess1').modal('show');",
                yii\web\View::POS_READY
                );

            }

    }

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

			<?= Html::a("Змінити пароль", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#passmodal-5','class'=>'btn btn-danger'])?>

		</div>

		<div class="col-xs-12">
			<h1>Кабінет споживача</h1>

		</div>
			<div class="col-sm-12">

						<?=
                        DetailView::widget([
								'model' => $model,
								'hover'=>true,
								'striped'=>true,
								'mode'=>DetailView::MODE_VIEW,
								'attributes' => [

									'fio',
									'telef',
                                    'email',
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
                   <h4>Увага!!! Заповніть та пройдіть верифікацію електронної пошти!!! В майбутньому буде змінено формат входу в кабінет тільки за допомогою електронної пошти.</h4>
               </div>

        <?php
           }
        ?>


		<div class="col-xs-12">
			<h2><?=Yii::$app->formatter->asDate($period, 'LLLL Y')?></h2>
		</div>

        <?php

        if ($abonents<>null) {

             foreach ($abonents as $abonkart) {
                 if ($abonkart->id_kart==$abon->id) {
                     $itemsnav[] = ['label' => $abonkart->schet, 'active'=>true, 'url' => ['kabinet', 'id' => $model->id,'idkart' => $abonkart->id_kart]];
                 }
                 else
                     $itemsnav[] = ['label' => $abonkart->schet, 'url' => ['kabinet', 'id' => $model->id,'idkart' => $abonkart->id_kart]];
             }


    //        $items = [
    //            ['label' => 'Action', 'active'=>true, 'url' => '#'],
    //            ['label' => 'My Link', 'url' => '#'],
    //        ];

            echo NavX::widget([
                'options'=>['class'=>'nav nav-pills'],
                'items' => $itemsnav
            ]);



            NavBar::begin();
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav'],
                'activateParents' => true,
                'encodeLabels' => false
            ]);
            NavBar::end();

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
            ];



            ?>


            <div class="schet col-xs-12">
                <div class="rah">
                    <h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 box-sum">
                    <h4>Сума до сплати</h4>
                    <?php
                    if (round($summa,2)<500){
                        ?>
                        <div class="summa" style="color: #2e8e5a;">
                            <h3><?= number_format(round($summa, 2), 2, '.', '') ?></h3>
                        </div>

                        <?php
                    }
                    if (round($summa,2)>=500 and round($summa,2)<1000){
                        ?>
                        <div class="summa" style="color: #a937c9;">
                            <h3><?= number_format(round($summa, 2), 2, '.', '')  ?></h3>
                        </div>
                        <?php

                        ?>
                        <?php
                    }
                    if (round($summa,2)>=1000) {
                        ?>
                        <div class="summa" style="color: #c91017;">
                            <h3><?= number_format(round($summa, 2), 2, '.', '')  ?></h3>
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
                        'dataProvider' =>  $dpdolg,
                        'columns' => [
                            'tipposl',
                            [
                                'attribute' => 'sal',
                                'label'=>'Борг'
                            ],
                            [
                                'attribute' => 'summ',
                                'label'=>'Оплата'
                            ],
                            [
                                'attribute' => 'dolgopl',
                                'label'=>'Борг після оплати'
                            ],
                        ],

                        'striped'=>false,
                        'layout'=>"{items}",
                            'resizableColumns'=>true,
                        'pjax'=>true,
                        'pjaxSettings'=>[
                            'neverTimeout'=>true,

                        ],
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

                <div class="col-lg-4 .col-sm-4 .col-md-4">
                    <h2><?=Yii::$app->formatter->asDate($periodkab, 'LLLL Y')?></h2>
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


        <?php
        }

        Pjax::end(); ?>