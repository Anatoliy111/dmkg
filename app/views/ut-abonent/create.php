<?php

use kartik\form\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UtAbonent $model */

$this->title = 'Реєстрація в кабінет споживача';
//$this->params['breadcrumbs'][] = ['label' => 'Ut Abonents', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>

    <div class="well well-large">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="ut-abonent-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pass1')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pass2')->passwordInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Далі', ['class' => 'btn btn-success']) ?>
            </div>


<!--            --><?//= Html::a("Змінити пароль", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#regmodal','class'=>'btn btn-danger'])?>


            <?php ActiveForm::end(); ?>

        </div>
    </div>

