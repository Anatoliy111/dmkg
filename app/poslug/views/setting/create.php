<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtOrg */

$this->title = Yii::t('easyii', 'Create Ut Org');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-org-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
