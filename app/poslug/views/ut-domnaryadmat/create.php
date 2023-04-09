<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryadmat */

$this->title = Yii::t('easyii', 'Create Ut Domnaryadmat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domnaryadmats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domnaryadmat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
