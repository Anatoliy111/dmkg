<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDomnaryad */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Domnaryad',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Domnaryads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('easyii', 'Update');
?>
<div class="ut-domnaryad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	<?php
	if ($model->proveden == null)
	{
	?>
	<?=Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success']);?>
	<?= Html::submitButton('Зберегти та Провести', ['class' => 'btn btn-danger','name' => 'prov-t', 'value' => 'true']) ;?>
	<?php
		}
		else
	?>
			  <?=  Html::submitButton('Відмінити проведення', ['class' => 'btn btn-danger','name' => 'prov-f', 'value' => 'true']);?>

</div>
