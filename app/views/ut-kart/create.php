<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UtKart */

$this->title = Yii::t('easyii', 'Create Ut Kart');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-kart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
