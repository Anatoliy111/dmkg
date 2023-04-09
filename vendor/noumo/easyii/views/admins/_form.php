<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'username')->textInput($this->context->action->id === 'edit' ? ['disabled' => 'disabled'] : []) ?>
<?= $form->field($model, 'password')->passwordInput(['value' => '']) ?>
<?= $form->field($model, 'roles')->dropDownList
            (ArrayHelper::map(\app\models\EaRoles::find()->all(), 'roles', 'roles'),
                [
                    'prompt' => Yii::t('easyii', 'Select the roles...')
                ]
            ); ?>
<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>