<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTarifvid */

$this->title = Yii::t('easyii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tarifvids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tarifvid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
