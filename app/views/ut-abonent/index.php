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

?>
<?php Pjax::begin(); ?>

<div class="ut-kart-index">


    <?php 	Modal::begin([
        'header' => '<h2>Змінити пароль</h2>',

//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
        'id' => 'emailsendauth',
        'size' => 'modal-md',

    ]);
    ?>

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Modal::end(); ?>





    <div class="well well-large">

        <?php




        $items = [
            [
                'label'=>'Вхід за адресою',
                'content'=>$this->render('authadres', ['model' => $modeladres, 'dataProvider' => $dataProviderAdres]),
            ],
            [
                'label'=>'Вхід за електронною поштою',
                'content'=>$this->render('authemail', ['model' => $modelemail]),
            ],
        ];

        if ($tab<>'email')
            $items[0]['active'] = true;
        else
            $items[1]['active'] = true;

        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
//            'bordered'=>true,
        ]);


       ?>

    </div>

    <div class="row">
        <?php

        if ($message=='sendauth') {
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


