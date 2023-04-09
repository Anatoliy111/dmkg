<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUlica */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Ulica',
]) . $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Ulicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="ut-ulica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
