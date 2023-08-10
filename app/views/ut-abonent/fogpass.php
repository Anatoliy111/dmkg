<?php

use kartik\form\ActiveForm;
use kartik\growl\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UtAbonent $model */

$this->title = 'Відновлення паролю';
//$this->params['breadcrumbs'][] = ['label' => 'Ut Abonents', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>

    <div class="ut-abonent col-xs-12 col-sm-8 col-md-8 col-lg-6 col-xl-6 col-xxl-6 align-self-center well">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="ut-abonent-form">

            <?php $form = ActiveForm::begin(); ?>

            <p>Для відновлення паролю введіть вашу зареєстровану електронну пошту! </p>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Далі', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
