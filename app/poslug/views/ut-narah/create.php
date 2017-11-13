<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNarah */

$this->title = Yii::t('app', 'Create Ut Narah');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ut Narahs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-narah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
