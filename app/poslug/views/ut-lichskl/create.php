<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLichskl */

$this->title = Yii::t('easyii', 'Create Ut Lichskl');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Lichskls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lichskl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
