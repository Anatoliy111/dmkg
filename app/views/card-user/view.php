<?php

use app\models\KomUlica;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $model app\models\CardUser */

$this->title = $model->FIO;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Card Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//$ddd = $model->getIdUlica($model-ID);
//$query = $model->getKomUslugs()->all();
//$dataProvider = new ActiveDataProvider([
//    'query' => $query,
//]);


?>
<div class="card-user-view">

     <h1><?= Html::encode($this->title) ?></h1>
	<h1><?= Html::encode($model->fileDBF) ?></h1>


	<?php $form = ActiveForm::begin([
		'options' => ['data' => ['pjax' => true]],
		'action' => ['uslug', 'id' => $model->ID],
		'method' => 'get',
//        'layout'=> 'inline',
	]); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'ID',
            'SCHET',
            'FIO',
//            'IDCOD',

            [
                'label' => Yii::t('easyii', 'Adress'),

                'value' => $model->UlicaName.Yii::t('easyii', ' house №').$model->DOM.Yii::t('easyii', ' ap.').$model->KV,
            ],
        ],

    ]) ?>


	<?php if ($this->context->action->actionMethod == "actionIndex"): ?>
		<?=
		$form->field($model, 'enterschet');

		echo Button::widget([
			'label' => 'Далі',
			'options' => [
				'class' => 'btn-primary',
				'style' => 'margin:5px',
			],
		]);
		?>
<!--		--><?//= Html::a(Yii::t('easyii', 'Utilities'), ['uslug', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
<!--		--><?//= Html::submitButton('Искать', ['class' => 'btn btn-primary'])?>
	<?php endif; ?>

	<?php ActiveForm::end(); ?>
</div>
