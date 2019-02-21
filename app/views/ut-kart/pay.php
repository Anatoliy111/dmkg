<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 20.02.2019
 * Time: 13:37
 */
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

?>


<?php $form = ActiveForm::begin(['id' => 'pay-form']); ?>

    <div class="form-group">
        <h4>Особовий рахунок <?= Html::encode($model->getAbonent()->one()['schet'])?></h4>

        <?php
        echo GridView::widget([
            'dataProvider' =>  $dp,

        				'showPageSummary' => true,
            'columns' => [
                'tipposl',
                [
                    'attribute' => 'dolgopl',
                    'label'=>'Борг'
                ],
                [
                    'attribute' => 'sendopl',
                    'label' => 'Оплата',
                        'format'=>['decimal', 2],
                        'pageSummary'=>true,
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'sendopl',
                    'pageSummary' => true,
                    'readonly' => false,
                    'value' => 'sendopl',
                    'content' => function($data,$model){return '<div class="text_content">'.htmlentities($data->userProfiles->company).'</div>';},
                    'editableOptions' => [
                        'header' => 'Оплата',
                        'inputType' => TabularForm::INPUT_TEXT,
                        'options' => [
                            'pluginOptions' => ['min' => 0]
                        ]
                    ],
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'sendopl',
                    'readonly' => function($model, $key, $index, $widget) {
                        return (!$model->status); // do not allow editing of inactive records
                    },
                    'editableOptions' => [
                        'header' => 'Оплата',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0]
                        ]
                    ],
                    'hAlign' => 'right',
                    'vAlign' => 'middle',
                    'width' => '7%',
                    'format' => ['decimal', 2],
                    'pageSummary' => true
                ],
            ],
            'striped'=>false,
            'layout'=>"{items}",
            'resizableColumns'=>true,
            'pjax'=>true,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
            ],
            'panel' => [],
            'toolbar'=> []
        ]);
        ?>


        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

