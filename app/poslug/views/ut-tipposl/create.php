<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTipposl */

$this->title = Yii::t('easyii', 'Create Ut Tipposl');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tipposls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tipposl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
