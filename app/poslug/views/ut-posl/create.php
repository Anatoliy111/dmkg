<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPosl */

$this->title = Yii::t('easyii', 'Create Ut Posl');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Posls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-posl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
