<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtSubs */

$this->title = Yii::t('easyii', 'Create Ut Subs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Subs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-subs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
