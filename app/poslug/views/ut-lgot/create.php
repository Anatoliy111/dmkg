<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLgot */

$this->title = Yii::t('easyii', 'Create Ut Lgot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Lgots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lgot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
