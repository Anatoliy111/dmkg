<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAbonent */

$this->title = Yii::t('easyii', 'Create Ut Abonent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Abonents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-abonent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
