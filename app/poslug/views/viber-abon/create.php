<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\ViberAbon */

$this->title = Yii::t('easyii', 'Create Viber Abon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Viber Abons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viber-abon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
