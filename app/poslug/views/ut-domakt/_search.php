<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDomakt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-domakt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'period') ?>

    <?= $form->field($model, 'id_dom') ?>

    <?= $form->field($model, 'id_postach') ?>

    <?php // echo $form->field($model, 'id_tarifvid') ?>

    <?php // echo $form->field($model, 'n_akt') ?>

    <?php // echo $form->field($model, 'obem') ?>

    <?php // echo $form->field($model, 'cena') ?>

    <?php // echo $form->field($model, 'kol') ?>

    <?php // echo $form->field($model, 'summa') ?>

    <?php // echo $form->field($model, 'notevid') ?>

    <?php // echo $form->field($model, 'proveden') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
