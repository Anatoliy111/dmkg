<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidlgot */

$this->title = Yii::t('easyii', 'Create Ut Vidlgot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Vidlgots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-vidlgot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
