<?php

use app\models\DolgUl;
use app\poslug\models\UtUlica;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\SearchDolgKart */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin(); ?>

<div class="ut-abonent-adres">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-sm-8">
            <?= $form->field($model, 'kl_ul')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(DolgUl::getUL(), 'kl', 'ul'),
                'language' => 'uk',
                'options' => ['placeholder' => Yii::t('easyii', 'Select the street...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'nomdom')?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'nomkv') ?>

        </div>


    </div>


    <?php
    if ($dataProvider->getTotalCount() <> 0) {
        ?>

        <div class="row">
            <div class="col-sm-3">

                <?=	$form->field($model, 'enterpass')->passwordInput();	?>

            </div>
        </div>
        <?php
    }
    ?>





    <div class="form-group">
        <?= Html::submitButton('Далі',['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages):
        foreach($messages as $message):

            Alert::begin([
                'options' => [
                    'class' => $type, 'style' => 'float:bottom; margin-top:50px',
                ],
            ]);

            echo $message;

            Alert::end();
        endforeach;
    endforeach ?>



</div>

<?php Pjax::end(); ?>
