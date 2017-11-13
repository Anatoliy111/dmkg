<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNarah */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Narah',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ut Narahs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ut-narah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
