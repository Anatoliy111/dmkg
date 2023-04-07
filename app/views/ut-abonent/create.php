<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UtAbonent $model */

$this->title = 'Create Ut Abonent';
$this->params['breadcrumbs'][] = ['label' => 'Ut Abonents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-abonent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
