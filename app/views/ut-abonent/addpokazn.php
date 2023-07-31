<?php


use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SearchUtKart $modelkart */

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

<?=  $form->field($modelkart, 'schet')->textInput(['maxlength' => true])  ?>
<?=    $form->field($modelkart, 'name_f')->textInput(['maxlength' => true])  ?>
<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php
ActiveForm::end();
?>


















