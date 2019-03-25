<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 20.02.2019
 * Time: 13:37
 */
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

$list = [1 => 'Privat24',2 => 'Other'];
$asset = \app\assets\AppAsset::register($this);


?>


<?php $form = ActiveForm::begin(['id' => 'pay-form']); ?>

    <div class="form-group">
        <h4>Особовий рахунок <?= Html::encode($model->getAbonent()->one()['schet'])?></h4>

<!--        --><?php
//        echo GridView::widget([
//            'dataProvider' =>  $dp,
//
//        				'showPageSummary' => true,
//            'columns' => [
//                'tipposl',
//                [
//                    'attribute' => 'dolgopl',
//                    'label'=>'Борг'
//                ],
//                [
//                    'attribute' => 'sendopl',
//                    'label' => 'Оплата',
//                        'format'=>['decimal', 2],
//                        'pageSummary'=>true,
//                ],
//                [
//                    'class' => 'kartik\grid\EditableColumn',
//                    'attribute' => 'sendopl',
//                    'pageSummary' => true,
//                    'readonly' => false,
//                    'value' => 'sendopl',
////                    'content' => function($data,$model){return '<div class="text_content">'.htmlentities($data->userProfiles->company).'</div>';},
//                    'editableOptions' => [
//                        'header' => 'Оплата',
//                        'inputType' => \kartik\editable\Editable::INPUT_TEXT,
//                        'options' => [
//                            'pluginOptions' => ['min' => 0]
//                        ]
//                    ],
//                ],
//                [
//                    'class' => 'kartik\grid\EditableColumn',
//                    'attribute' => 'sendopl',
////                    'readonly' => function($model, $key, $index, $widget) {
////                        return (!$model->status); // do not allow editing of inactive records
////                    },
//                    'editableOptions' => [
//                        'header' => 'Оплата',
//                        'inputType' => \kartik\editable\Editable::INPUT_TEXT,
//                        'options' => [
//                            'pluginOptions' => ['min' => 0]
//                        ]
//                    ],
//                    'hAlign' => 'right',
//                    'vAlign' => 'middle',
//                    'width' => '7%',
//                    'format' => ['decimal', 2],
//                    'pageSummary' => true
//                ],
//            ],
//            'striped'=>false,
//            'layout'=>"{items}",
//            'resizableColumns'=>true,
//            'pjax'=>true,
//            'pjaxSettings'=>[
//                'neverTimeout'=>true,
//            ],
//            'panel' => [],
//            'toolbar'=> []
//        ]);
//        ?>
        <?php
        //    	unset($attribs['attributes']['color']);
        //    	$attribs['attributes']['status'] = [
        //    	'type'=>TabularForm::INPUT_WIDGET,
        //    	'widgetClass'=>\kartik\widgets\SwitchInput::classname()
        //    	];

        echo TabularForm::widget([
        'dataProvider'=>$dp,
        //		'searchModel' => $searchModel,

        'form'=>$form,
            'attributes'=>[
                'tipposl'=>[
                    'type'=>TabularForm::INPUT_STATIC,
                    'label'=>'Послуга',
                    'columnOptions'=>['hAlign'=>GridView::ALIGN_LEFT, 'width'=>'140px']
                ],
                'dolgopl'=>[
                    'type'=>TabularForm::INPUT_STATIC,
                    'label'=>'Борг',
                    'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px'],
                    'format'=>['decimal', 2],
                ],
                'sendopl'=>[
                    'label'=>'Сума до сплати',
                    'type'=>TabularForm::INPUT_WIDGET,
                    'widgetClass'=>MaskedInput::className(),
                    'options'=>[
                        'clientOptions' => [

                          'alias' => 'decimal',
                          'digits' => 2,
                          'removeMaskOnSubmit' => true,
                        ],
                           ],
//                    'type'=>MaskedInput::className(), [
//                        'mask' => '9999',
//                    ],


                ],
            ],
            'actionColumn' => false,
            'checkboxColumn' => false,
        'gridSettings'=>[
        'pjax' => true,
        //    	'floatHeader'=>true,
        'panel'=>[
        'footer'=>false,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-usd"></i>'.' '.$this->title.'</h3>',
        'type' => GridView::TYPE_PRIMARY,
//        'after'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
//        Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
//        Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
        //			            'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add New', ['type'=>'button', 'class'=>'btn btn-success kv-batch-create']) . ' ' .
        //	Html::button('<i class="glyphicon glyphicon-remove"></i> Delete', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete']) . ' ' .
        //	Html::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['type'=>'button', 'class'=>'btn btn-primary kv-batch-save'])
        ]
        ]
        ]);


               ?>

        <?=	 $form->field($model, 'summ')->hiddenInput()->label(false) ?>
        <?=	 $form->field($model, 'id_abonent')->hiddenInput()->label(false)?>
        <?=	 $form->field($model, 'id_kart')->hiddenInput()->label(false)?>

        <div class="summa" style="color: #0d0c66;">

            <h3>Всього: <div id='paysumm'>0</div></h3>
        </div>



<!--        1 => Html::img($asset->baseUrl.'/p24.png', ['alt' => 'Наш логотип']),-->
<!--        2 => Html::img($asset->baseUrl.'/visa.png', ['alt' => 'Наш логотип'])-->


        <?= Html::submitButton('Зформувати платіж', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>


