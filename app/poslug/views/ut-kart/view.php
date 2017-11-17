<?php


	use kartik\dialog\Dialog;

	use kartik\form\ActiveForm;
	use kartik\grid\GridView;

	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;
	use \kartik\switchinput\SwitchInput;
	use yii\widgets\DetailView;


	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//	$model->ulica.ul;
Modal::begin([
		'header' => '<h4 class="modal-title">Авторизація абонента</h4>',
//		'toggleButton' => ['label' => '<i class="glyphicon glyphicon-th-list"></i> Detail View in Modal', 'class' => 'btn btn-primary'],
		'options' => [
			'tabindex' => false,
			'id'=>'pwd',
			],
	]);?>
<?php
//	$model->scenario = 'password';
?>
<?php $form = ActiveForm::begin([
	'id' => 'pass-form',
	'options' => [
		'data-pjax' => '1'
	],
//	'enableAjaxValidation' => true,

]); ?>


    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [    'pluginOptions'=>[
		'size' => 'large',
		'onText'=>'Авторизований',
		'offText'=>'Не авторизований',
		'onColor' => 'success',
		'offColor' => 'danger',
	]]); ?>

	<?= $form->field($model, 'pass1')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pass2')->passwordInput(['maxlength' => true]) ?>

<p class="text">Якщо ви натисните кнопку Зберегти з пустим паролем, авторизація буде знята</p>
<div class="form-group">
	<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success','target'=>'_blank','data-toggle'=>'tooltip']) ?>

<!--	--><?php //echo Html::a('Распечатать .PDF', ['/poslug/ut-kart/report', 'id' => $model->id, 'pass' => $model->pass2], [
//		'class'=>'btn btn-default',
//		'target'=>'_blank',
//		'data-toggle'=>'tooltip',
//		'title'=>'Will open the generated PDF file in a new window'
//	]);?>
<!--<!---->
<!--	--><?php //echo Html::a(Yii::t('easyii', 'Save'), ['/poslug/ut-kart/repor9t', 'id' => $model->id], [
//		'method' => 'post',
//		'params' => [
//			'action' => 'view'
//		],
//		'class' => 'btn btn-success',
//		'target'=>'_blank',
//		'data-toggle'=>'tooltip',
//		'title'=>'Will open the generated PDF file in a new window'
//	]);?>
<!---->
<!--	--><?php //echo Html::a('Update', ['/poslug/ut-kart/update', 'id' => $model->id],[
//			'class'=>'btn btn-default',
//		'target'=>'_blank',
//		'data-toggle'=>'tooltip',
//		'title'=>'Will open the generated PDF file in a new window'
//		]);?>


</div>
<?php ActiveForm::end(); ?>

<?php Modal::end() ?>



<div class="ut-kart-view">

    <h1><?= Html::encode($this->title) ?></h1>

	<?=
		DetailView::widget([
			'model'=>$model,
//			'condensed'=>true,
//			'panel'=>[
////							'heading'=>$model->getOrg()->asArray()->one()['naim'],
//				'heading'=>'gdfhsdfh',
//				'headingOptions' => [
//					'tag' => 'asfsdgasd',
//					'template' => '{title}{buttons}',
//				],
//				'type'=>DetailView::TYPE_INFO,
//				'enableEditMode' => true,
//			],
			'attributes'=>[
			        	'fio',
                        'idcod',
//			        'ulica.ul',
//	                [
//			        	'attribute' => 'ulica',
//			        	'label' => 'Вулиця',
////		        		'value' =>$model->ulica,
//			        	'value' => function ($model, $key, $index, $widget) {
//			        				return $model->ulica;
//			        	},
//			        ],
			        [
			        	'label' => Yii::t('easyii', 'Adress'),

			        	'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
			        ],
			        [
			        	'attribute'=>'ur_fiz',
			        	'label'=>'Юр. чи Фіз.',
			        	'format'=>'raw',
			        	'value'=>$model->ur_fiz==0 ? '<span class="label label-success">Фізична особа</span>' : '<span class="label label-danger">Юридична особа</span>',
//			        	'type'=>DetailView::TYPE_INFO,
//			        	'widgetOptions' => [
//			        		'pluginOptions' => [
//			        			'0' => 'Yes',
//			        			'1' => 'No',
//			        		]
//			        	],
			        	'valueColOptions'=>['style'=>'width:30%']
			        ],
			        [
			        	'attribute'=>'pass',
			        	'label'=>'Авторизація',
			        	'format'=>'raw',
			        	'value'=>(!empty($model->pass) ? '<span class="label label-success">Авторизований</span> '
			        	: '<span class="label label-danger">Не авторизований</span>') ,

			        	],
				[
					'label'=>' ',
					'format'=>'raw',
					'value'=>function ($model, $key){
						if (!empty($key->model['pass']))
						{
							return Html::a("Змінити", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#pwd','class'=>'btn-sm btn-success']);
						}
						else
						{
							return Html::a("Зареєструвати", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#pwd','class'=>'btn-sm btn-success']);
						}

					}
				],




//			        	'valueColOptions'=> array('style' =>'width:30%')),
                    'telef',
				[
					'attribute'=>'privat',
					'label'=>'Приватизація',
					'format'=>'raw',
					'value'=>$model->privat==1 ? '<span class="label label-success">Приватизована</span>': $model->privat,
					'valueColOptions'=>['style'=>'width:30%']
				],
				[
					'attribute' => 'id_rabota',
//					'label'=>'Робота',
					'value' => $model->getRabota()->asArray()->one()['name'],
				],
 			]
		]);
	?>




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



</div>
