<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLichskl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lichskl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'id_abonent')->textInput() ?>

    <?= $form->field($model, 'id_pokaz')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'pokaz_nt1')->textInput() ?>

    <?= $form->field($model, 'pokaz_nt2')->textInput() ?>

    <?= $form->field($model, 'pokaz_nt3')->textInput() ?>

    <?= $form->field($model, 'pokaz_kt1')->textInput() ?>

    <?= $form->field($model, 'pokaz_kt2')->textInput() ?>

    <?= $form->field($model, 'pokaz_kt3')->textInput() ?>

    <?= $form->field($model, 'rizn_t1')->textInput() ?>

    <?= $form->field($model, 'rizn_t2')->textInput() ?>

    <?= $form->field($model, 'rizn_t3')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
