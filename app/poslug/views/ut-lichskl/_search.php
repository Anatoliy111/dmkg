<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtLichskl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-lichskl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'id_abonent') ?>

    <?= $form->field($model, 'id_pokaz') ?>

    <?= $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'pokaz_nt1') ?>

    <?php // echo $form->field($model, 'pokaz_nt2') ?>

    <?php // echo $form->field($model, 'pokaz_nt3') ?>

    <?php // echo $form->field($model, 'pokaz_kt1') ?>

    <?php // echo $form->field($model, 'pokaz_kt2') ?>

    <?php // echo $form->field($model, 'pokaz_kt3') ?>

    <?php // echo $form->field($model, 'rizn_t1') ?>

    <?php // echo $form->field($model, 'rizn_t2') ?>

    <?php // echo $form->field($model, 'rizn_t3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
