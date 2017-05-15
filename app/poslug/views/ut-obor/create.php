<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtObor */

$this->title = Yii::t('easyii', 'Create Ut Obor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Obors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-obor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
