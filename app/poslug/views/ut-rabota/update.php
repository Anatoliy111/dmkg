<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtRabota */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Rabota',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Rabotas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="ut-rabota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
