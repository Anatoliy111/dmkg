<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtPokaz */

$this->title = Yii::t('easyii', 'Create Ut Pokaz');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Pokazs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-pokaz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
