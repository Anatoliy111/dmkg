<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOpl */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Opl',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Opls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="ut-opl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
