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

            <p>Дякуємо за підтвердження! <?= Html::encode($model->fio) ?> введіть ваш новий пароль! </p>

            <?=	 $form->field($model, 'pass1')->passwordInput(['maxlength' => true])?>
            <?=    $form->field($model, 'pass2')->passwordInput(['maxlength' => true])?>
            <div class="buttons" style="padding-bottom: 20px">
                <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>


            <?php ActiveForm::end(); ?>

        </div>
    </div>

