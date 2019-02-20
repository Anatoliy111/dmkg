<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 20.02.2019
 * Time: 13:37
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

?>


<?php $form = ActiveForm::begin(['id' => 'pay-form']); ?>

    <div class="form-group">
        <h4>Особовий рахунок <?= Html::encode($model->schet)?></h4>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

