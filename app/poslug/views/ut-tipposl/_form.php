<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTipposl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tipposl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

<!--    --><?//=$form->field($model, 'period')->widget(DatePicker::classname(), [
//    			'options' => ['placeholder' => 'Виберіть місяць'],
//    //			'attribute2'=>'to_date',
//    			'type' => DatePicker::TYPE_INPUT,
//    			'pluginOptions' => [
//    				'autoclose' => true,
//    				'startView'=>'year',
//    				'minViewMode'=>'months',
////    				'format' => 'dd-mm-yyyy'
//                    'format' => 'yyyy-mm-dd'
//    			]
//    			])?>

    <?= $form->field($model, 'poslug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_groupposl')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtGroupposl::find()->all(), 'id', 'groups'),
        [
            'prompt' => Yii::t('easyii', 'Select the edizm...')
        ]
    ) ?>

    <?= $form->field($model, 'old_tipusl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ed_izm')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtEdizm::find()->all(), 'edizm', 'edizm'),
        [
            'prompt' => Yii::t('easyii', 'Select the edizm...')
        ]
    ) ?>

    <?= $form->field($model, 'id_vidpokaz')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtVidpokaz::find()->all(), 'id', 'vid_pokaz'),
        [
            'prompt' => Yii::t('easyii', 'Select the vid_pokaz...')
        ]
    ) ?>

    <?= $form->field($model, 'flag_nar')->checkbox(['uncheck' => '0']) ?>

    <?= $form->field($model, 'flag_norm')->checkbox(['uncheck' => '0']) ?>

    <?= $form->field($model, 'flag_lgot')->checkbox(['uncheck' => '0']) ?>

    <?= $form->field($model, 'flag_dom')->checkbox(['uncheck' => '0']) ?>

    <?= $form->field($model, 'id_vidpokazprop')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtVidpokaz::find()->all(), 'id', 'vid_pokaz'),
        [
            'prompt' => Yii::t('easyii', 'Select the vid_pokaz...')
        ]
    ) ?>

    <?= $form->field($model, 'del')->checkbox(['uncheck' => '0']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
