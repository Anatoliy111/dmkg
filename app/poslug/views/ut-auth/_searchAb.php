<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\SearchUtAbonent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ut-abonent-search">

<!--    --><?php //$form = ActiveForm::begin([
//        'action' => ['index'],
//        'method' => 'get',
//        'options' => [
//            'data-pjax' => 1
//        ],
//    ]); ?>

	<?php $form = ActiveForm::begin(); ?>




    <?= $form->field($model, 'schet') ?>





    <div class="form-group">
        <?= Html::submitButton(Yii::t('easyii', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('easyii', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
