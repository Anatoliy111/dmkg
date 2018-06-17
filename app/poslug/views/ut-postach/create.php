<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPostach */

$this->title = Yii::t('easyii', 'Create Ut Postach');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Postaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-postach-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
