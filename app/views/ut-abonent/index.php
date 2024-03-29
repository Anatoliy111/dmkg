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


/* @var $this yii\web\View */
/** @var app\models\SearchUtAbonent $searchModel */
/** @var app\models\UtKart $modeladres */
/** @var app\models\UtAbonent $modelemail */
/** @var yii\data\ActiveDataProvider $dataProviderAdres */

  $asset = \app\assets\AppAsset::register($this);

if (isset($_SESSION['modalmess'])) {
    $this->registerJs(
        "$('#modalmess1').modal('show');",
        yii\web\View::POS_READY
    );

}

?>

<?= $this->render('modalmess');?>

<?php Pjax::begin(); ?>

<div class="ut-abonent col-xs-12 col-sm-8 col-md-8 col-lg-6 col-xl-6 col-xxl-6 align-self-center">

<!--    col-lg-offset-2-->


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

        if ($tab<>'adres')
            $items[1]['active'] = true;
        else
            $items[0]['active'] = true;

        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_CENTER,
            'encodeLabels'=>false,
//            'bordered'=>true,
        ]);


       ?>




    </div>

    <div class="well col-xs-12" style="text-align: center;">
        <h4>При виникненні проблем з реєстрацією звертайтесь в кабінет ЕКОНОМІСТИ в приміщенні Долинського Міськомунгоспу.</h4>
    </div>

    <div class="row">
        <?php

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
                    'body' => 'Не вірний пароль!!!',
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


