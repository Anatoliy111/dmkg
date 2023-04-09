<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtUtrim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-utrim-search">

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

    <?= $form->field($model, 'period') ?>

    <?= $form->field($model, 'id_posl') ?>

    <?php // echo $form->field($model, 'id_tipposl') ?>

    <?php // echo $form->field($model, 'id_vidutr') ?>

    <?php // echo $form->field($model, 'id_rabota') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <?php // echo $form->field($model, 'procent') ?>

    <?php // echo $form->field($model, 'data_n') ?>

    <?php // echo $form->field($model, 'data_k') ?>

    <?php // echo $form->field($model, 'zayav') ?>

    <?php // echo $form->field($model, 'flag_vrem') ?>

    <?php // echo $form->field($model, 'activ') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
