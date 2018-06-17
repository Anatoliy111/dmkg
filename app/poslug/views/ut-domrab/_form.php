<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomrab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domrab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'id_dom')->textInput() ?>

    <?= $form->field($model, 'id_tarifvid')->textInput() ?>

    <?= $form->field($model, 'id_naryad')->textInput() ?>

    <?= $form->field($model, 'id_normrab')->textInput() ?>

    <?= $form->field($model, 'ed_izm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'norm_ed')->textInput() ?>

    <?= $form->field($model, 'kol_day')->textInput() ?>

    <?= $form->field($model, 'obiem')->textInput() ?>

    <?= $form->field($model, 'norm_chas')->textInput() ?>

    <?= $form->field($model, 'notevid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summa')->textInput() ?>

    <?= $form->field($model, 'proveden')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
