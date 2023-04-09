<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtAbonent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-abonent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'schet') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'id_kart') ?>

    <?php // echo $form->field($model, 'id_rabota') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'ur_fiz') ?>

    <?php // echo $form->field($model, 'id_dom') ?>

    <?php // echo $form->field($model, 'privat') ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
