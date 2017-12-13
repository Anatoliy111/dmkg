<?php



	use kartik\dialog\Dialog;

	use kartik\form\ActiveForm;
	use kartik\grid\GridView;

	use kartik\growl\Growl;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use kartik\select2\Select2;
	use \kartik\switchinput\SwitchInput;
	use yii\widgets\DetailView;
	use yii\widgets\Pjax;


	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//	$model->ulica.ul;
	//= Html::a("Змінити", ['/poslug/ut-kart/pass', 'id' => $model->id],['id'=>'modal-btn','class'=>'btn-sm btn-success'])
?>



<div class="ut-kart-view">

	<?php Pjax::begin(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

<!--	--><?php
//		echo SwitchInput::widget(['name' => 'status',
//			'readonly' => $mode=='view' ? true : false,
//								  'value'=>$model->status,
//								  'pluginOptions'=>[
//									  'size' => 'large',
//									  'onText'=>'Авторизований',
//									  'offText'=>'Не авторизований',
//									  'onColor' => 'success',
//									  'offColor' => 'danger',
//								  ]]);
//	?>

	<?php
		Modal::begin([
			'header' => '<h2>Реєстрація користувача</h2>',

//			'toggleButton' => ['label' => 'click me'],
			'footer' => 'Низ окна',
			'id' => 'passmodal',
			'size' => 'modal-md',

		]);
	?>
		<div id='contentpass'>Введіть пароль1111</div>

	<?php
		echo 'Введіть пароль';
		Modal::end();
	?>
<!--	<a href='/poslug/ut-kart/pass' id="modal-btn" class='btn-sm btn-success' data-target='/poslug/ut-kart/pass'>Заказать</a>-->




		<?php $form = ActiveForm::begin([
		]); ?>

	<?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
		'readonly' => $mode=='edit' ? false : true,
		'pluginOptions'=>[
			'size' => 'large',
			'onText'=>'Авторизований',
			'offText'=>'Не авторизований',
			'onColor' => 'success',
			'offColor' => 'danger',
		]]); ?>

	<?php
		if ($mode=="edit")
		{
	?>
			<?=	 $form->field($model, 'pass1')->passwordInput(['maxlength' => true])?>
			<?=    $form->field($model, 'pass2')->passwordInput(['maxlength' => true])?>
			<div class="buttons" style="padding-bottom: 20px">
				<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-success','name' => 'print', 'value' => '']) ?>
				<?= Html::submitButton(Yii::t('easyii', 'Save and Print'), ['class' => 'btn btn-success','name' => 'print', 'value' => 'true','target'=>'_blank']) ?>


			</div>

	<?php
		}else
		{
	?>

			<div class="buttons" style="padding-bottom: 20px">
				<?= 		Html::a(Yii::t('easyii', 'Update'), ['view', 'id' => $model->id,'mode' => 'edit'], ['class' => 'btn btn-primary',]) ?>
			</div>

			<?php }
		 ActiveForm::end();
	?>



	<?=
		DetailView::widget([
			'model'=>$model,
			'attributes'=>[
			        	'fio',
                        'idcod',
			        [
			        	'label' => Yii::t('easyii', 'Adress'),
			        	'value' => $model->getUlica()->asArray()->one()['ul'].' '.Yii::t('easyii', 'house №').$model->dom.' '.Yii::t('easyii', 'ap.').$model->kv,
			        ],
			        [
			        	'attribute'=>'ur_fiz',
			        	'label'=>'Юр. чи Фіз.',
			        	'format'=>'raw',
			        	'value'=>$model->ur_fiz==0 ? '<span class="label label-success">Фізична особа</span>' : '<span class="label label-danger">Юридична особа</span>',
			        	'valueColOptions'=>['style'=>'width:30%']
			        ],

//			        [
//			        	'attribute'=>'pass',
//			        	'label'=>'Авторизація',
//			        	'format'=>'raw',
//			        	'value'=>(!empty($model->pass) ? '<span class="label label-success">Авторизований</span> '
//			        	: '<span class="label label-danger">Не авторизований</span>') ,
//
//			        	],
//				[
//					'label'=>' ',
//					'format'=>'raw',
//					'value'=>function ($model, $key){
//						if (!empty($key->model['pass']))
//						{
//							return Html::a("Змінити", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#pwd','class'=>'btn-sm btn-success']);
//						}
//						else
//						{
//							return Html::a("Зареєструвати", ['#'], ['data-toggle' =>'modal', 'data-target' =>'#pwd','class'=>'btn-sm btn-success']);
//						}
//
//					}
//				],
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
		],
	]); ?>

	<?php Pjax::end(); ?>


	<?php
		foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
			if (gettype($message)=='array')
			{
				foreach($message as $mes)
				{

					echo Growl::widget([
						'type' => Growl::TYPE_DANGER,
						'title' => 'Помилка!',
						'icon' => 'glyphicon glyphicon-remove-sign',
						'body' => $mes,
						'showSeparator' => true,
						'delay' => false,
						'pluginOptions' => [
//						'showProgressbar' => true,
							'placement' => [
								'from' => 'top',
								'align' => 'right',
							]
						]
					]);
				}
			}
			else

			echo Growl::widget([
				'type' => Growl::TYPE_DANGER,
				'title' => 'Помилка!',
				'icon' => 'glyphicon glyphicon-remove-sign',
				'body' => $message,
				'showSeparator' => true,
				'delay' => false,
				'pluginOptions' => [
//						'showProgressbar' => true,
					'placement' => [
						'from' => 'top',
						'align' => 'right',
					]
				]
			]);
		}
	?>

</div>
