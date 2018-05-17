<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtTarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-tarif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'id_tipposl') ?>

    <?= $form->field($model, 'id_vidpokaz') ?>

    <?= $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'tarifplan') ?>

    <?php // echo $form->field($model, 'tariffakt') ?>

    <?php // echo $form->field($model, 'tarifend') ?>

    <?php // echo $form->field($model, 'kl') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'id_dom') ?>

    <?php // echo $form->field($model, 'podezd') ?>

    <?php // echo $form->field($model, 'id_dom') ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
