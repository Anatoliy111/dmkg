<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtEdizm */

$this->title = Yii::t('easyii', 'Create Ut Edizm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Edizms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-edizm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
