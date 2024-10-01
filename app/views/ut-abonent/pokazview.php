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
             <h4>Нарахування суми до оплати по нарахованим кубометрам води відбувається по закриттю облікового місяця, яке триває від 3-х до 6-ти днів з початку наступного місяця.</h4>

            <?php

            $voda=$dpvoda->getModels()[0];
//            echo Html::button("Подати показник", ['id' => 'btn-addpokaz','class' => 'btn-lg btn-success','data-target' => 'addpokazn']);
            if ($voda["wid"]==41 or $voda["wid"]==43 or $voda["wid"]==44) {
                echo Html::button("Подати показник", ['class' => 'btn-lg btn-success', 'onclick' => "AddPokaz()", 'target' => "_blank",]);
            }
            else
            {
                echo '<div class="infopokaz" style="color: #b92c28; text-align: center"><h4>По вашому виду нарахувань "'. iconv('windows-1251', 'UTF-8', $voda["sprzn"]["vid_zn"]) .'" ви не можете подати показник!!!</h4></div>';
            }
            ?>

        </div>


        <div class="col-lg-12">

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
                        'attribute' => 'h_voda.yearmon',
                        'label'=>'Місяць обліку',
                        'value'=>function ($model) {
                            return Yii::$app->formatter->asDate('01.'.substr($model["yearmon"], 4, 2).'.'.substr($model["yearmon"], 0, 4), 'LLLL Y');
                        }
                    ],
                    [
                        'attribute' => 'sch_cur',
                        'label'=>'Показник'
                    ],
                    [
                        'attribute' => 'sprzn.vid_zn',
                        'label'=>'Вид нарахування',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["sprzn"]["vid_zn"]);
                        }
                    ],
                    [
                        'attribute' => 'sch_razn',
                        'label'=>'Куби по ліч.'
                    ],
                    [
                        'label'=>'Розрах. споживання',
                        'value'=>function ($model) {
                            return $model["nor_razn"]+$model["norm_blich"];
                        }
                    ],
                    [
                        'attribute' => 'kub_nobalans',
                        'label'=>'Небаланс'
                    ],
                    [
                        'label'=>'Перерахунок',
                        'value'=>function ($model) {
                            return $model["del_norm"]+$model["pererah"]+$model["spis"];
                        }
                    ],
                    [
                        'attribute' => 'kub_all',
                        'label'=>'Нарах. всього кубів'
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

        <div class="col-lg-12">


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
                        'attribute' => 'date_pok',
                        'label'=>'Дата прийнятого показника',
                        'width'=>'150px',
                    ],
                    [
                        'attribute' => 'pokazn',
                        'label'=>'Показник'
                    ],
                    [
                        'attribute' => 'sprzn.vid_zn',
                        'label'=>'Вид',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["sprzn"]->vid_zn);
                        }
                    ],
                    [
                        'attribute' => 'fio',
                        'label'=>'ПІП',
                        'width'=>'150px',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model["fio"]);
                        }
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


