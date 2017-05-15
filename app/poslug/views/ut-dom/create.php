<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDom */

$this->title = Yii::t('easyii', 'Create Ut Dom');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Doms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-dom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
