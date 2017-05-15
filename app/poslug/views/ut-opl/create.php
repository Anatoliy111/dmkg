<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOpl */

$this->title = Yii::t('easyii', 'Create Ut Opl');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Opls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-opl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
