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
use yii\widgets\Pjax;

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
                    'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
                ],
                'dolgopl'=>[
                    'type'=>TabularForm::INPUT_STATIC,
                    'label'=>'Борг',
                    'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
                ],
                'sendopl'=>[
                    'label'=>'Сума оплати',
                    'type'=>TabularForm::INPUT_TEXT,
                    'pageSummary' => true,
                    'value' => function ($model, $key){
                        $www=$key;
                    },
                ],
            ],
            'actionColumn' => false,
            'checkboxColumn' => false,
        'gridSettings'=>[
        'pjax' => true,
        //    	'floatHeader'=>true,
        'panel'=>[
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


        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    function ($)
    {
        $("pay-form").on("submit", function(){
            return false;
        })
    }


</script>

