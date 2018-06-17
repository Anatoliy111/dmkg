<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomakt */

$this->title = Yii::t('easyii', 'Create Ut Domakt');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domakts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domakt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
