<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-dom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'n_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ulica')->textInput() ?>

    <?= $form->field($model, 'kol_kv')->textInput() ?>

    <?= $form->field($model, 'kol_pod')->textInput() ?>

    <?= $form->field($model, 'kol_etag')->textInput() ?>

    <?= $form->field($model, 'lift')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_olddom')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
