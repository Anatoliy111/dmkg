<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNormrab */

$this->title = Yii::t('easyii', 'Create Ut Normrab');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Normrabs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-normrab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
