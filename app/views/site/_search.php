<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use app\models\KomUlica;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\CardUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
//        'layout'=> 'inline',
    ]); ?>


    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'id_ulica')->dropDownList
            (ArrayHelper::map(KomUlica::find()->all(), 'ID', 'UL'),
                [
                    'prompt' => Yii::t('easyii', 'Select the street...')
                ]
            ) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'DOM') ?>
        </div>
        <div class="col-sm-1">
            <?=  $form->field($model, 'korpus')->dropDownList([
                'а'=>'а','б'=>'б','в'=>'в','г'=>'г'
            ],
                [
                    'prompt' => Yii::t('easyii', 'Select the body if there is...')
                ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'KV') ?>
        </div>
    </div>


<!--    --><?//= $form->field($model, 'korpus')->dropDownList(array('','а','б','в','г')) ?>
<!---->
<!--    --><?//= Html::dropDownList('korpus', 'null',array('а','б','в','г')) ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
