<?php

use app\models\UtKart;
use app\poslug\components\PeriodKabWidget;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\growl\Growl;
use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\nav\NavX;
use kartik\tabs\TabsX;
use yii\base\BaseObject;
use yii\bootstrap\Modal;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var app\models\UtKart $abon */
/** @var app\models\SearchUtAbonent $modelemail */
/** @var app\models\SearchDolgKart $modelkart */


$asset = \app\assets\AppAsset::register($this);

//    $period =date('Y-m-d', strtotime($lastperiod.' +1 month'));
    $period =date('Y-m-d', strtotime($lastperiod));
    $yearmon =date('Y', strtotime($period)).date('m', strtotime($period));
    $model = $_SESSION['model'];

//if ($abonents<>null) {
//    $abon = $_SESSION['abon'];
//    $abon->schet = trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet));
//}


if ($emailchange=='error') {
    $this->registerJs(
        "$('#emailchange').modal('show');",
        yii\web\View::POS_READY
    );
}

if (isset($_SESSION['modalmess']))  {
    $this->registerJs(
        "$('#modalmess1').modal('show');",
        yii\web\View::POS_READY
    );
}
?>





<?php 	Modal::begin([
    'header' => '<h2>Додати рахунок</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'modaladdrah',
    'size' => 'modal-md',
    'headerOptions' => [
        'style' => 'text-align: center;'
    ],

]);
?>

<div id='modal-content'>Завантаження...</div>

<?php Modal::end(); ?>


<?php 	Modal::begin([
    'header' => '<h2>Додати показник</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'modaladdpokaz',
    'size' => 'modal-md',
    'headerOptions' => [
        'style' => 'text-align: center;'
    ],

]);
?>

<div id='modal-content1'>Завантаження...</div>

<?php Modal::end(); ?>


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
    'method' => 'post',
    'options' => ['data-pjax' => true]
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

<h4 style="line-height: 1.5;">Введіть адресу ел.пошти на яку вибажаєте змінити!</h4>

<?=	 $form->field($modelemail, 'email', ['addon' => ['type'=>'prepend', 'content'=>'@']]);?>

<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>


<?php
ActiveForm::end();
?>

<?php Modal::end(); ?>

<?= $this->render('modalmess');?>





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

<?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>

<?php
if ($abonents<>null) {
Modal::begin([
    'header' => '<h2>Видалити рахунок</h2>',
    'id' => 'modaldelrah',
    'size' => 'modal-md',
    'headerOptions' => [
        'style' => 'text-align: center;'
    ],
]);


?>

<div class="modal-body">
    <div class="col" style="text-align:center">
        <h4 style="line-height: 1.5;">Ви дійсно бажаєта видалити рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet)))?>?</h4>
        <?= Html::a('Так', ['delrahunok'], ['class'=>'btn-lg btn-danger']);?>
        <?= Html::a('Ні', [''],['class'=>'btn-lg btn-primary','data-dismiss'=>'modal','aria-label'=>'close']);?>
    </div>
</div>




<?php Modal::end();
}
?>

<div class="ut-kart" id="kart1">



	<div class="mywell well-large container">
		<div class="col-sm-1">

			<?= Html::a('Вихід', ['ut-abonent/logout'], ['class' => 'btn btn-primary']) ?>

		</div>
		<div class="col-sm-1">

			<?= Html::a("Змінити пароль", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#passmodal-5','class'=>'btn btn-danger'])?>

		</div>

		<div class="col-xs-12">
			<h1>Кабінет споживача</h1>


			<div class="col-sm-6">

						<?=
                        DetailView::widget([
								'model' => $model,
								'hover'=>true,
								'striped'=>true,
//								'mode'=>DetailView::MODE_VIEW,
                            'panel'=>[
                                'heading'=>'Профіль користувача',
                                'type'=>DetailView::TYPE_PRIMARY,
                            ],
                            'buttons1' => '{update}',
                            'buttons2' => '{save},{view}',
								'attributes' => [
								        'fio',
                                    [
                                        'label'=>'Email',
                                        'format'=>'raw',
                                        'value'=>function ($model, $key){
                                            if (!empty($key->model['email']))
                                            {
                                                return $key->model['email'].' '.Html::a("Змінити пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailchange','class'=>'btn-sm btn-success']);
                                            }
                                            else
                                            {
                                                return Html::a("Зареєструвати пошту", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#emailreg','class'=>'btn-sm btn-danger']);
                                            }

                                        }
                                    ],
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
								],
								'hAlign'=>DetailView::ALIGN_RIGHT ,
								'vAlign'=>DetailView::ALIGN_TOP  ,

							]) ?>






			</div>
<!--        <div class="viber col-sm-6">-->

            <?php
            if (strlen(trim($model->email)) <>0 ) {
            ?>
            <div class="viber col-sm-3">
                <img src="<?= Url::to(['/site/qrcode','code_url'=>'viber://pa?chatURI=dmkgBot&context='.$model->email])?>" style="width: 100%"/>
            </div>
            <?php
            } else {
            ?>
            <div class="viber col-sm-3">
                <img src="<?= Url::to(['/site/qrcode','code_url'=>'viber://pa?chatURI=dmkgBot'])?>" style="width: 100%"/>
            </div>
            <?php
            }
            ?>
            <div class="viber col-sm-3">
                <h4>Відскануйте QR-код та підключайте ViberBot DMKG</h4>
                <?= Html::a('Інструкція', Url::to($asset->baseUrl.'/Інструкція Viber на телефоні.pdf'), ['style' => "font-size: x-large;",'data-pjax' => 0,'target'=>"_blank"]);?>
                <h4>Якщо на вашому пристрої, на якому ви зараз працюєте, встановлений вайбер, то натисніть кнопку ViberStart</h4>
                <?= Html::a('ViberStart', Url::to('viber://pa?chatURI=dmkgBot&context='.$model->email), ['http','class' => 'btn btn-success','target'=>"_blank"]);?>

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

        <div class="rah-button col-sm-12">
            <div class="rah-button col-sm-6 col-md-2 col-lg-2">


                <?php echo Html::button("Додати рахунок", ['class' => 'btn btn-success','onclick' => "AddRah()",'target' => "_blank",]); ?>

            </div>

            <?php

            if ($abonents<>null) {



            ?>

            <div class="col-sm-6 col-md-2 col-lg-2">

                <?= Html::a("Видалити рахунок", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#modaldelrah','class'=>'btn btn-danger'])?>

            </div>

            <?php } ?>
        </div>





        <?php

        if ($abonents<>null) {



        ?>



        <?php
             foreach ($abonents as $abonkart) {
                 if ($abonkart->schet==trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet))) {
                     $itemsnav[] = ['label' => $abonkart->schet, 'active'=>true, 'url' => ['kabinet', 'schetkart' => $abonkart->schet]];
                 }
                 else
                     $itemsnav[] = ['label' => $abonkart->schet, 'url' => ['kabinet', 'schetkart' => $abonkart->schet],'options' => ['data-pjax' => true]];
             }


    //        $items = [
    //            ['label' => 'Action', 'active'=>true, 'url' => '#'],
    //            ['label' => 'My Link', 'url' => '#'],
    //        ];

            ?>

            <div class="menu-rahunok">

            <?php

            echo NavX::widget([
                'options'=>['class'=>'nav nav-pills'],
                'items' => $itemsnav,
            ]);



            NavBar::begin();
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav','data-pjax' => 1],
                'activateParents' => true,
                'encodeLabels' => false,
            ]);
            NavBar::end();

            ?>

            </div>

            <?php

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
                    'content'=>$this->render('poslugview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$_SESSION['abon']]),
                ],
                [
                    'label'=>'Нарахування',
                    'content'=>$this->render('narview', ['model' => $model,'dataProvider' => $dpnar,'abon'=>$_SESSION['abon']]),
                ],
                [
                    'label'=>'Оплата/Утримання',
                    'content'=>$this->render('oplview', ['model' => $model,'dataProvider' => $dpopl,'dataProvider2' => $dpuder,'abon'=>$_SESSION['abon']]),
                ],
                [
                    'label'=>'Субсидія',
                    'content'=>$this->render('subview', ['model' => $model,'dataProvider' => $dpsub,'abon'=>$_SESSION['abon']]),
                ],
                [
                    'label'=>'Зведена відомість',
                    'content'=>$this->render('oborview', ['model' => $model,'dataProvider' => $dpobor,'abon'=>$_SESSION['abon']]),
                ],
            ];



            ?>

        <div class="col-xs-12">
            <h1>Особовий рахунок <?= Html::encode(trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet)))?></h1>
            <?php
            if ($_SESSION['abon']->schet=='0092124') {

            ?>

            <?= Html::a('1111111111111111111111111111111111111111111111', ['ut-abonent/temp'], ['class' => 'btn btn-primary']) ?>

            <?php } ?>
        </div>

        <div class="col-sm-12">

            <?=
            DetailView::widget([
                'model' => $_SESSION['abon'],
                'hover'=>true,
                'striped'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'attributes' => [
                    [
                        'attribute' => 'schet',
                        'value' => trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet)),
                    ],
                    [
                        'attribute' => 'fio',
                        'label' => 'ПІП',
                        'value' => iconv('windows-1251', 'UTF-8', $_SESSION['abon']->fio.' '.$_SESSION['abon']->im.' '.$_SESSION['abon']->ot),
                    ],
                    [
                        'label' => Yii::t('easyii', 'Adress'),

                        'value' => iconv('windows-1251', 'UTF-8',$_SESSION['abon']->ulnaim).' '.Yii::t('easyii', 'house №').iconv('windows-1251', 'UTF-8',$_SESSION['abon']->nomdom).' '.Yii::t('easyii', 'ap.').iconv('windows-1251', 'UTF-8',$_SESSION['abon']->nomkv),
                    ],
                ],
                'hAlign'=>DetailView::ALIGN_RIGHT ,
                'vAlign'=>DetailView::ALIGN_TOP  ,

            ]) ?>
        </div>


            <div class="col-xs-12">

                <div class="center" style="padding-bottom: 20px; margin-left: auto; margin-right: auto;">
                    <?= Html::a('<i class="glyphicon glyphicon-home"></i> Інформація по будинку '.iconv('windows-1251', 'UTF-8',$_SESSION['abon']->ulnaim.' '.$_SESSION['abon']->nomdom)  , ['/ut-dom/view','kl_ul' => $_SESSION['abon']->kl_ul,'nomdom' => $_SESSION['abon']->nomdom], ['class' => 'btn btn-primary btn-block' ]) ?>
                </div>

            </div>




            <div class="schet col-xs-12">

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
//                    echo Html::button("Додати рахунок", ['id' => 'btn-addpokazn1', 'class' => 'btn btn-success']);
                    ?>


                </div>


                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

                    <?php
                    echo GridView::widget([
                        'dataProvider' =>  $dpdolg,
                        'columns' => [
                            [
                                'attribute' => 'poslug',
                                'label'=>'Послуга',
                                'value'=>function ($model) {
                                    return iconv('windows-1251', 'UTF-8', $model["poslug"]);
                                }
                            ],
                            [
                                'attribute' => 'dolg',
                                'label'=>'Борг'
                            ],
                            [
                                'attribute' => 'opl',
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

    <?php



    if ($hv<>null) {

    ?>



    <div class="mywell well-large3 container">

        <!--		</div>-->
        <div class="col-xs-12">
                <h2>Холодна вода</h2>
        </div>

        <div class="col-xs-12">
            <?php
            $lich=$dplich->getModels();

            foreach($lich as $value){
                $monthpov = date('m', strtotime($value['data_pov']));
                $yearpov = date('Y', strtotime($value['data_pov']));
                $yearmonthpov =date('Y', strtotime($value['data_pov'])).date('m', strtotime($value['data_pov']));

                $month = date('m', strtotime(date("Y-m-d")));
                $year = date('Y', strtotime(date("Y-m-d")));
                $yearmonth=date('Y', strtotime(date("Y-m-d"))).date('m', strtotime(date("Y-m-d")));

                $monthpov2 = date('m', strtotime($value['data_pov'].' +1 month'));
                $yearpov2 = date('Y', strtotime($value['data_pov'].' +1 month'));

                $yearmonthpov2 = date('Y', strtotime($value['data_pov'].' +1 month')).date('m', strtotime($value['data_pov'].' -1 month'));


                if ($yearmon>=$yearmonthpov){
//                     echo Html::encode('<h4>Увага!!! Лічильник №'.$value['N_LICH'].' потребує повірки!</h4>');
                    echo '<div class="info' . $value['n_lich'] . '" style="color: #b92c28; text-align: center"><h4>Увага!!! Лічильник №'.$value['n_lich'].' потребує повірки!</h4></div>';
                }
                if ($yearmon==$yearmonthpov2){
//                     echo Html::encode('<h4>Увага!!! Лічильник №'.$value['N_LICH'].' потребує повірки!</h4>');
                    echo '<div class="info' . $value['n_lich'] . '" style="color: #337db6; text-align: center"><h4>Увага, в наступному місяці виходить термін повірки лічильника!!! Лічильник №' .$value['n_lich'].' потребує повірки!</h4></div>';
                }

            }
            ?>
        </div>




        <div class="col-xs-12 .col-sm-6 .col-lg-8">

            <?php

                if (($dpvoda==null) or ($err==335544344)) {
                ?>

                    <h3 style="color:#b92c28; text-align: center">Технічні роботи! - <?= Html::encode($err) ?></h3>
                <?php

                } else {
                $itemshv = [
                    [
                        'label'=>'Показники',
                        'content'=>$this->render('pokazview', ['model' => $model,'dpvoda' => $dpvoda,'dppokazn' => $dppokazn]),
                    ],
                    [
                        'label'=>'Лічильники',
                        'content'=>$this->render('lichview', ['model' => $model,'dplich' => $dplich]),
                    ],
                ];
            echo TabsX::widget([
                'items'=>$itemshv,
                'position'=>TabsX::POS_ABOVE,
//                'encodeLabels'=>false,
//                'bordered'=>true,
//                'enableStickyTabs' => true,
                //   'pluginOptions' => ['enableCache' => false],
                //            'stickyTabsOptions' => [
                //                'selectorAttribute' => 'data-target',
                //                'backToTop' => false,
                //            ],
            ]);

              }
            }
            ?>

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
        ?>
</div>


<?php Pjax::end();?>

<script type="text/javascript">
        function AddRah() {
            $.ajax({
                url: "/ut-abonent/addrahunok",
                type: 'post',
                data: {},
                success: function (s) {
                   // alert(s);
                    $('#modaladdrah').modal('show').modal({backdrop: false});
                    $('#modal-content').html(s);
                }

            });
        }
</script>

<script type="text/javascript">
    function AddPokaz() {
        $.ajax({
            url: "/ut-abonent/addpokazn",
            type: 'post',
            data: {},
            success: function (s) {
                // alert(s);
                $('#modaladdpokaz').modal('show').modal({backdrop: false});
                $('#modal-content1').html(s);
            }

        });
    }
</script>



