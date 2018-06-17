<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtMat */

$this->title = Yii::t('easyii', 'Create Ut Mat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Mats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-mat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
