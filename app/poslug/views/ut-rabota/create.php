<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtRabota */

$this->title = Yii::t('easyii', 'Create Ut Rabota');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Rabotas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-rabota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
