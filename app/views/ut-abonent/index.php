<?php

use app\models\UtAbonent;
use app\models\UtKart;
use kartik\nav\NavX;
use kartik\growl\Growl;
use kartik\tabs\TabsX;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\NavBar;

/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $searchModel */
/** @var app\models\UtKart $modeladres */
/** @var app\models\UtAbonent $modelemail */
/** @var yii\data\ActiveDataProvider $dataProviderAdres */

  $asset = \app\assets\AppAsset::register($this);

?>
<?php Pjax::begin(); ?>

<div class="ut-abonent col-xs-12 col-sm-8 col-md-8 col-lg-6 col-xl-6 col-xxl-6 align-self-center">

<!--    col-lg-offset-2-->
    <?php
    $header='';

    if ($message=='authsite')
        $header= '<h2>Реєстрація</h2>';
    if ($message=='fogpass')
        $header= '<h2>Відновлення паролю</h2>';

    Modal::begin([

            'header' => $header,
//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
        'id' => 'emailsendauth',
        'size' => 'modal-md',
        'headerOptions' => [
            'style' => 'text-align: center;'
        ],

    ]);
    ?>



    <div class="modal-email">

    <img itemprop="image" src="<?= $asset->baseUrl ?>/email.png" alt="EMAIL">

    <?php if ($message=='authsite')
             echo '<h3 style="line-height: 1.5;">На вашу пошту '.$email.' відправлено лист з посиланням для підтвердження реєстрації. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!</h3>';
          if ($message=='fogpass')
             echo '<h3 style="line-height: 1.5;">На вашу пошту '.$email.' відправлено лист з посиланням для підтвердження відновлення паролю. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!</h3>';

    ?>
    </div>


    <?php Modal::end(); ?>





    <div class="well well-lg">

        <?php


//        $this->registerJs(
//            "$('#emailsendauth').modal('show');",
//            yii\web\View::POS_READY
//        );

        $items = [
            [
                'label'=>'Вхід за адресою',
                'content'=>$this->render('authadres', ['model' => $modeladres, 'dataProvider' => $dataProviderAdres]),
            ],
            [
                'label'=>'Вхід за електронною поштою',
                'content'=>$this->render('authemail', ['modelemail' => $modelemail]),
            ],
        ];

        if ($tab<>'email')
            $items[0]['active'] = true;
        else
            $items[1]['active'] = true;

        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_CENTER,
            'encodeLabels'=>false,
//            'bordered'=>true,
        ]);


       ?>

    </div>

    <div class="row">
        <?php

        if ($email<>'') {
                    $this->registerJs(
                        "$('#emailsendauth').modal('show');",
                        yii\web\View::POS_READY
                    );

        }

            if ($message=='notadres') {

                echo Growl::widget([
                    'type' => Growl::TYPE_DANGER,
                    'title' => 'Помилка!',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'body' => 'По вашій адресі абонентів не знайдено. Спробуйте знову!!!',
                    'showSeparator' => true,
                    'delay' => 0,
                    'pluginOptions' => [
    //						'showProgressbar' => true,
                        'placement' => [
                            'from' => 'top',
                            'align' => 'right',
                        ]
                    ]
                ]);
            }

            if ($message=='notadrespass') {

                echo Growl::widget([
                    'type' => Growl::TYPE_DANGER,
                    'title' => 'Помилка!',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'body' => 'Не вірний код доступу !!!',
                    'showSeparator' => true,
                    'delay' => false,
                    'pluginOptions' => [
    //						'showProgressbar' => true,
                        'placement' => [
                            'from' => 'top',
                            'align' => 'right',
                        ]
                    ]
                ]);
            }

            if ($message=='notemail') {

                echo Growl::widget([
                    'type' => Growl::TYPE_DANGER,
                    'title' => 'Помилка!',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'body' => 'Не вірна електронна пошта або пароль !!!',
                    'showSeparator' => true,
                    'delay' => false,
                    'pluginOptions' => [
                        //						'showProgressbar' => true,
                        'placement' => [
                            'from' => 'top',
                            'align' => 'right',
                        ]
                    ]
                ]);
        }

        ?>
    </div>





</div>
<?php Pjax::end(); ?>

<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages):
    foreach($messages as $message):

        Alert::begin([
            'options' => [
                'class' => $type, 'style' => 'float:bottom; margin-top:50px',
            ],
        ]);

        echo $message;

        Alert::end();
    endforeach;
endforeach ?>


