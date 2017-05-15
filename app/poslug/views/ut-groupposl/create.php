<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtGroupposl */

$this->title = Yii::t('easyii', 'Create Ut Groupposl');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Groupposls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-groupposl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
