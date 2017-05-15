<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtKart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-kart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'IDCOD') ?>

    <?= $form->field($model, 'id_ulica') ?>

    <?php // echo $form->field($model, 'DOM') ?>

    <?php // echo $form->field($model, 'KV') ?>

    <?php // echo $form->field($model, 'UR_FIZ') ?>

    <?php // echo $form->field($model, 'PASS') ?>

    <?php // echo $form->field($model, 'ID_DOM') ?>

    <?php // echo $form->field($model, 'KOL_KOM') ?>

    <?php // echo $form->field($model, 'KOL_LUD') ?>

    <?php // echo $form->field($model, 'PLOS_Z') ?>

    <?php // echo $form->field($model, 'PLOS_O') ?>

    <?php // echo $form->field($model, 'ETAG') ?>

    <?php // echo $form->field($model, 'ID_LGOT') ?>

    <?php // echo $form->field($model, 'PRIVAT') ?>

    <?php // echo $form->field($model, 'lift') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'telef') ?>

    <?php // echo $form->field($model, 'id_oldkart') ?>

    <?php // echo $form->field($model, 'id_uslug') ?>

    <?php // echo $form->field($model, 'id_rabota') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
