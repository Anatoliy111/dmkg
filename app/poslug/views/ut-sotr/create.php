<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtSotr */

$this->title = Yii::t('easyii', 'Create Ut Sotr');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Sotrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-sotr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
