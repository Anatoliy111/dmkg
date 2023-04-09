<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\Viber */

$this->title = Yii::t('easyii', 'Create Viber');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Vibers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
