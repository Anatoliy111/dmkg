<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifplan */

$this->title = Yii::t('easyii', 'Create Ut Tarifplan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifplans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifplan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
