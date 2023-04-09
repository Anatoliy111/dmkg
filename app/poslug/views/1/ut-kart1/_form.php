<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-kart-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDCOD')->textInput() ?>

    <?= $form->field($model, 'id_ulica')->textInput() ?>

    <?= $form->field($model, 'DOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KV')->textInput() ?>

    <?= $form->field($model, 'UR_FIZ')->textInput() ?>

    <?= $form->field($model, 'PASS')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_DOM')->textInput() ?>

    <?= $form->field($model, 'KOL_KOM')->textInput() ?>

    <?= $form->field($model, 'KOL_LUD')->textInput() ?>

    <?= $form->field($model, 'PLOS_Z')->textInput() ?>

    <?= $form->field($model, 'PLOS_O')->textInput() ?>

    <?= $form->field($model, 'ETAG')->textInput() ?>

    <?= $form->field($model, 'ID_LGOT')->textInput() ?>

    <?= $form->field($model, 'PRIVAT')->textInput() ?>

    <?= $form->field($model, 'lift')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telef')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_oldkart')->textInput() ?>

    <?= $form->field($model, 'id_uslug')->textInput() ?>

    <?= $form->field($model, 'id_rabota')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
