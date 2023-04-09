<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UtAbonent $model */

$this->title = 'Update Ut Abonent: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ut Abonents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ut-abonent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
