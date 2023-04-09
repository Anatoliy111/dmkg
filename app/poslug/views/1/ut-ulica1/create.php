<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUlica */

$this->title = Yii::t('easyii', 'Create Ut Ulica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Ulicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-ulica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
