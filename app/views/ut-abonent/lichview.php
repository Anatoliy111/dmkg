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

            <?php
            $lich=$dplich->getModels();

             foreach($lich as $value){
                 if ($value['data_pov']<date("Y-m-d")){
//                     echo Html::encode('<h4>Увага!!! Лічильник №'.$value['N_LICH'].' потребує повірки!</h4>');
                     echo '<div class="info' . $value['n_lich'] . '" style="color: #b92c28; text-align: center"><h4>Увага!!! Лічильник №'.$value['n_lich'].' потребує повірки!</h4></div>';
                 }
             }
            ?>
        </div>



            <?php

            $layout1 = <<< HTML
			<div class="NameTab">
			     <h4>Лічильники</h4>

			</div>
{items}
HTML;
            echo GridView::widget([
                'dataProvider' =>$dplich,
                'columns' => [
                    [
                        'attribute' => 'tip',
                        'label'=>'Тип лічильника',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model->tip);
                        }
                    ],
                    [
                        'attribute' => 'n_lich',
                        'label'=>'№ лічильника',
                        'value'=>function ($model) {
                            return iconv('windows-1251', 'UTF-8', $model->n_lich);
                        }
                    ],
                    'data_pov',
                    'data_vig',

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


