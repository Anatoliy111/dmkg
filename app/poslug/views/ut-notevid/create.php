<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNotevid */

$this->title = Yii::t('easyii', 'Create Ut Notevid');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Notevids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-notevid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
