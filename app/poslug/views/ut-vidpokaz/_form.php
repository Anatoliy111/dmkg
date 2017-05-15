<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\poslug\models\UtEdizm;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidpokaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-vidpokaz-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'vid_pokaz')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'ed_izm')->dropDownList
            (ArrayHelper::map(UtEdizm::find()->all(), 'edizm', 'edizm'),
                [
                    'prompt' => Yii::t('easyii', 'Select the edizm...')
                ]
            ) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'flag_lich')->checkbox(['uncheck' => '0']) ?>
        </div>
        <div class="col-sm-2">
                <?= $form->field($model, 'flag_lichskl')->checkbox(['uncheck' => '0']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'flag_dom')->checkbox(['uncheck' => '0']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
