<?php


use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pokazn $modelpokazn */

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

<?=    $form->field($modelpokazn, 'pokazn')->input('float',['maxlength' => true])  ?>
<div class="buttons" style="padding-bottom: 20px">
    <?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php
ActiveForm::end();
?>


















