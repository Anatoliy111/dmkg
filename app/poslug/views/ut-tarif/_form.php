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

    <?= $form->field($model, 'id_dom')->dropDownList
    (ArrayHelper::map(\app\poslug\models\UtDom::find()->all(), 'id', 'note'),
        [
            'prompt' => Yii::t('easyii', 'Select the dom...')
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

    <?= $form->field($model, 'tarifplan')->textInput() ?>

    <?= $form->field($model, 'tariffakt')->textInput() ?>

    <?= $form->field($model, 'tarifend')->textInput() ?>

    <?= $form->field($model, 'kl')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'podezd')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
