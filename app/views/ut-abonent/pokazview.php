<?php


use app\poslug\models\UtKart;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


//	use yii\bootstrap\

/* @var $this yii\web\View */


?>
<div class="utkart-pokaz-view">

    <div class="col-xs-12" style='text-align: center;'>
        <div class="col-lg-12">
             <h4>Особовий рахунок <?= Html::encode($abon->schet)?></h4>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">

            <?php
            echo Html::a('Подати показник', Url::to('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D'), ['http','class' => 'btn-lg btn-success','target'=>"_blank"]);
            ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <h4>Ваш попередній показник</h4>
        </div>

    </div>
        <?php

        $layout2 = <<< HTML
			<div class="NameTab">
			     <h4>Показники</h4>

			</div>
{items}
HTML;
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

            'layout' => $layout2,
            'resizableColumns'=>true,
            'hover'=>true,
            'pjax'=>true,
            'striped'=>true,
            'floatHeaderOptions'=>['scrollingTop'=>'50'],
            'pjaxSettings'=>[
                'neverTimeout'=>true,
            ],
        ]);
        ?>

</div>


