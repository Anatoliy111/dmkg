<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAbonent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-abonent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'schet')->textInput() ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kart')->textInput() ?>

    <?= $form->field($model, 'id_rabota')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ur_fiz')->textInput() ?>

    <?= $form->field($model, 'id_dom')->textInput() ?>

    <?= $form->field($model, 'privat')->textInput() ?>

    <?= $form->field($model, 'id_oldkart')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
