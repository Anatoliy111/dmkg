<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifinfo */

$this->title = Yii::t('easyii', 'Create Ut Tarifinfo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifinfos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
