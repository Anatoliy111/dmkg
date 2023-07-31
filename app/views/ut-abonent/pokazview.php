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
             <h4>Період обробки поданих показників триває 1-3 дні, після успішної обробки ви побачите свій показник в таблиці ПОКАЗНИКИ та НАРАХУВАННЯ</h4>

            <?php
            echo Html::a('Подати показник', Url::to('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D'), ['http','class' => 'btn-lg btn-success','target'=>"_blank"]);
            ?>

        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php

            $layout1 = <<< HTML
			<div class="NameTab">
			     <h4>Нарахування</h4>

			</div>
{items}
HTML;
            echo GridView::widget([
                'dataProvider' =>$dpvoda,
                'columns' => [
                    [
                        'attribute' => 'YEARMON',
                        'label'=>'Місяць обліку'
                    ],
                    [
                        'attribute' => 'SCH_CUR',
                        'label'=>'Показник'
                    ],
                    [
                        'attribute' => 'KUB',
                        'label'=>'Нараховано кубів'
                    ],
                ],
                'layout' => $layout1,
                'headerContainer' => ['class' => 'kv-table-header'],
                'containerOptions' => ['class' => 'kv-grid-wrapper'], // fixed height for floated header behavior
                'floatHeader' => true, // table header floats when you scroll
//            'floatPageSummary' => true, // table page summary floats when you scroll
//            'floatFooter' => false, // disable floating of table footer
                'pjax' => false, // pjax is set to always false for this demo
                'resizableColumns'=>true,
                // parameters from the demo form
                'responsive' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'hover' => true,
                // set your toolbar
//            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
                'persistResize' => false,
                'toggleDataOptions' => ['minCount' => 10],
            ]);
            ?>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


            <?php

            $layout2 = <<< HTML
			<div class="NameTab">
			     <h4>Показники</h4>

			</div>
{items}
HTML;
            echo GridView::widget([
                'dataProvider' =>$dppokazn,
                'columns' => [
                    [
                        'attribute' => 'DATE_POK',
                        'label'=>'Дата прийнятого показника'
                    ],
                    [
                        'attribute' => 'POKAZN',
                        'label'=>'Показник'
                    ],
                    [
                        'attribute' => 'VID',
                        'label'=>'Вид'
                    ],
                ],
                'layout' => $layout2,
                'headerContainer' => ['class' => 'kv-table-header'],
                'containerOptions' => ['class' => 'kv-grid-wrapper'], // fixed height for floated header behavior
                'floatHeader' => true, // table header floats when you scroll
//            'floatPageSummary' => true, // table page summary floats when you scroll
//            'floatFooter' => false, // disable floating of table footer
                'pjax' => false, // pjax is set to always false for this demo
                'resizableColumns'=>true,
                // parameters from the demo form
                'responsive' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'hover' => true,
                // set your toolbar
//            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
                'persistResize' => false,
                'toggleDataOptions' => ['minCount' => 10],
            ]);
            ?>
        </div>

    </div>


</div>


