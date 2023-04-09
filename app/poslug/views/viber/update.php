<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\Viber */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Viber',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Vibers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="viber-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
