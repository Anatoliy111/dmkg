<?php

use app\models\UtAbonent;
use app\models\UtKart;
use kartik\nav\NavX;
use kartik\growl\Growl;
use kartik\tabs\TabsX;
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




    <div class="well well-large">

        <?php

        $items = [
            [
                'label'=>'Вхід за адресою',
                'active'=>true,
                'content'=>$this->render('authadres', ['model' => $modeladres, 'dataProvider' => $dataProviderAdres]),
            ],
            [
                'label'=>'Вхід за електронною поштою',
                'content'=>$this->render('authemail', ['model' => $modelemail]),
            ],
        ];

        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
//            'bordered'=>true,
        ]);


       ?>

        <div class="text">
            <p> * Для отримання коду доступу, потрібно з'явитись в КП "ДОЛИНСЬКИЙ МІСЬККОМУНГОСП" вул. Нова 80-А, в кабінет №2.</p>
            <p> При собі мати паспорт та документ що засвідчує право власності.</p>
        </div>
    </div>

    <div class="row">
        <?php
        if ($dataProviderAdres->getTotalCount() == 0  and Yii::$app->request->queryParams <> null) {

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

        if ($dataProviderAdres->getTotalCount() <> 0  and $findmodeladres == 'bad') {

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
        ?>
    </div>





</div>
<?php Pjax::end(); ?>


