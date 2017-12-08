<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomzatrat */

$this->title = $model->ulica['ul'] . ' ' . $model->dom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domzatrats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ulica['ul'] . ' ' . $model->dom, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="ut-domzatrat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
