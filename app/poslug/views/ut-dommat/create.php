<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDommat */

$this->title = Yii::t('easyii', 'Create Ut Dommat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Dommats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-dommat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
