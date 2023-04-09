<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarif */

$this->title = Yii::t('easyii', 'Create Ut Tarif');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
