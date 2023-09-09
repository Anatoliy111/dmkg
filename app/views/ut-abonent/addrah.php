<?php


use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SearchDolgKart $modelkart */

  $asset = \app\assets\AppAsset::register($this);

?>


<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin([
    'id' => 'rah-form1',
    'method' => 'post',
      'enableAjaxValidation' => true,
//       'enableClientValidation' => false,
    'options' => ['data-pjax' => true]
]); ?>

<?//=  $form->field($modelkart, iconv('UTF-8','windows-1251', 'schet'))->textInput(['maxlength' => true]) ?>
<?=  $form->field($modelkart, 'schet')->textInput(['maxlength' => true]) ?>
<?=    $form->field($modelkart, 'fio')->textInput(['maxlength' => true])  ?>

<?//=    $form->field($modelkart, 'fio')->textInput(['maxlength' => true,'value' => function ($model) {
//    // Convert the character encoding from one_encoding to another_encoding
//    return iconv('UTF-8', 'windows-1251', $model->fio);
//},])  ?>
<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php
ActiveForm::end();
?>


















