<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOlddom */

$this->title = Yii::t('easyii', 'Create Ut Olddom');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Olddoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-olddom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
