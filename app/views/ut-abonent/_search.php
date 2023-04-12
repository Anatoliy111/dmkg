<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ut-abonent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo  $form->field($model, 'id_org') ?>

    <?php // echo  $form->field($model, 'schet') ?>

    <?php // echo $form->field($model, 'fio') ?>

    <?php // echo  $form->field($model, 'id_kart') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'val') ?>

    <?php // echo $form->field($model, 'del') ?>



    <?php // echo $form->field($model, 'date_pass') ?>

    <?php // echo $form->field($model, 'passopen') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'pass')->passwordInput(); ?>

    <?php // echo $form->field($model, 'telefon') ?>

    <?php // echo $form->field($model, 'date_entry') ?>

    <?php // echo $form->field($model, 'vb_api_key') ?>

    <?php // echo $form->field($model, 'vb_date') ?>

    <?php // echo $form->field($model, 'vb_org') ?>

    <?php // echo $form->field($model, 'vb_receiver') ?>

    <?php // echo $form->field($model, 'vb_name') ?>

    <?php // echo $form->field($model, 'vb_status') ?>

<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
<!--    </div>-->

    <div class="form-group">
        <?= Html::submitButton('Далі',['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
