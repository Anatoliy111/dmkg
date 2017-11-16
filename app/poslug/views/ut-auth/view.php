<?php

	use kartik\grid\GridView;
	use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtAuth */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Auths'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('easyii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('easyii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('easyii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'fio_p',
            'fio_i',
            'fio_b',
            'telef',
            'email:email',
            'status',
        ],
    ]) ?>

	<?=
		GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				[
					'label' => 'Організація',
					'value' => 'org.naim',
				],
				'schet',
//			'fio',

				[
					'attribute' => 'note:ntext',
					'label'=>'Нотатки',
					'value' => 'note',

				],
				// 'ur_fiz',
				// 'id_dom',

//			[
//				'attribute'=>'privat',
//				'label'=>'Приватизація',
//				'format'=>'raw',
//				'value'=>$dataProvider->privat==0 ? '<span class="label label-success">Так</span>' : '<span class="label label-danger">Ні</span>',
////				'type'=>DetailView::TYPE_INFO,
////				'widgetOptions' => [
////					'pluginOptions' => [
////						'0' => 'Yes',
////						'1' => 'No',
////					]
////				],
//				'valueColOptions'=>['style'=>'width:30%']
//			],
				// 'id_oldkart',

//			['class' => 'yii\grid\ActionColumn'],
			],
		]); ?>

	<?= Html::a('Зареєструвати', ['activ', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('Відхилити',  ['cansel', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

</div>
