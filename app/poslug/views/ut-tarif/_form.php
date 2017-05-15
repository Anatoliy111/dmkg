<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarif-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_tipposl')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtTipposl::find()->all(), 'id', 'poslug'),
        [
            'prompt' => Yii::t('easyii', 'Select the poslug...')
        ]
    ) ?>

    <?= $form->field($model, 'id_vidpokaz')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtVidpokaz::find()->all(), 'id', 'vid_pokaz'),
        [
            'prompt' => Yii::t('easyii', 'Select the vid_pokaz...')
        ]
    ) ?>

    <?= $form->field($model, 'period')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Виберіть місяць'],
        //			'attribute2'=>'to_date',
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose' => true,
            'startView'=>'year',
            'minViewMode'=>'months',
//    				'format' => 'dd-mm-yyyy'
            'format' => 'yyyy-mm-dd'
        ]
    ])?>

    <?= $form->field($model, 'tarif1')->textInput() ?>

    <?= $form->field($model, 'tarif2')->textInput() ?>

    <?= $form->field($model, 'tarif3')->textInput() ?>

    <?= $form->field($model, 'koef_skl')->textInput() ?>

    <?= $form->field($model, 'norma')->textInput() ?>

    <?= $form->field($model, 'normalgot')->textInput() ?>

    <?= $form->field($model, 'normalgotsm')->textInput() ?>

    <?= $form->field($model, 'activ')->checkbox(['uncheck' => '0']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
