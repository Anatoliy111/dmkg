<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtVidutrim */

$this->title = Yii::t('easyii', 'Create Ut Vidutrim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Vidutrims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-vidutrim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
