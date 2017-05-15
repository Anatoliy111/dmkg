<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtDom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-dom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'n_dom') ?>

    <?= $form->field($model, 'id_ulica') ?>

    <?= $form->field($model, 'kol_kv') ?>

    <?= $form->field($model, 'kol_pod') ?>

    <?php // echo $form->field($model, 'kol_etag') ?>

    <?php // echo $form->field($model, 'lift') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'id_olddom') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
