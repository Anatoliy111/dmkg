<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUtrim */

$this->title = Yii::t('easyii', 'Create Ut Utrim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Utrims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-utrim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
