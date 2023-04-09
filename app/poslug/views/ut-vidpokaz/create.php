<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidpokaz */

$this->title = Yii::t('easyii', 'Create Ut Vidpokaz');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Vidpokazs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-vidpokaz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
