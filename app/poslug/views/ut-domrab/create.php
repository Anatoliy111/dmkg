<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomrab */

$this->title = Yii::t('easyii', 'Create Ut Domrab');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domrabs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domrab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
