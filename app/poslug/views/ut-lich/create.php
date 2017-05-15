<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLich */

$this->title = Yii::t('easyii', 'Create Ut Lich');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Liches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lich-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
