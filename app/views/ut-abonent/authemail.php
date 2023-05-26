<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SearchUtAbonent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ut-abonent-email">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
//        'options' => [
//            'data-pjax' => 1
//        ],
    ]); ?>

            <div class="row">

                <div class="col-sm-offset-2 col-sm-6">

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'pass')->passwordInput(); ?>



                    <div class="form-group">
                        <?= Html::submitButton('Вхід',['class' => 'btn btn-primary']) ?>
                    </div>







                </div>

                <div class="col-sm-offset-2 col-sm-6">

                            <?= Html::a('Реєстрація', ['ut-abonent/auth'], ['class' => 'btn btn-danger']) ?>

                        <div class="empty pass" style="float: right">
                            <?= Html::a('Забули пароль?', ['ut-abonent/fogotpass'], ['class="label label-info']) ?>
                        </div>

                </div>



            </div>

    <?php ActiveForm::end(); ?>

</div>

