<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryad */

$this->title = Yii::t('easyii', 'Create Ut Domnaryad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domnaryads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-domnaryad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'DPrabota' => $DPrabota,
		'DPmat' => $DPmat,
    ]) ?>
	<?=Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']);?>
</div>
