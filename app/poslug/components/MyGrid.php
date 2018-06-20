<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 26.03.2017
	 * Time: 19:38
	 */

namespace app\poslug\components;

	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use kartik\grid\GridView;


	class MyGrid extends Widget
	{
		public $dataProvider;
		public $searchModel;
		public $columns;
		public $modelnames;
		public $grid;


		public function init()
		{
//			parent::init();
//			if ($this->message === null) {
//				$this->message = 'Hello World';
//			}
//
//			$this->searchModel
			$this->columns = ['NAME','IDCOD',
						'id_ulica',
						'DOM',
						'KV',
						'UR_FIZ'];
		}

		public function run()
		{
			$grid=  GridView::widget([
					'dataProvider' => $this->dataProvider,
					'filterModel'=>$this->searchModel,
					'columns' => [
						['class' => '\kartik\grid\SerialColumn'],

				//            'id',
				//			'ID',
//						'NAME',
//				//			'fio',
//						'IDCOD',
//						'id_ulica',
//						'DOM',
//						'KV',
//						'UR_FIZ',
						// 'PASS',
						// 'ID_DOM',
						// 'KOL_KOM',
						// 'KOL_LUD',
						// 'PLOS_Z',
						// 'PLOS_O',
						// 'ETAG',
						// 'ID_LGOT',
						// 'PRIVAT',
						// 'lift',
						// 'note:ntext',
						// 'telef',
						// 'id_oldkart',
						// 'id_uslug',
						// 'id_rabota',
						[
							'class' => '\kartik\grid\ActionColumn',
				//				'viewOptions' => ['label' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				//				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				//				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
							'dropdown' => true,
							'dropdownOptions' => ['class' => 'pull-right'],
						]
					],
					'resizableColumns'=>true,
					'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
				//		'floatHeader'=>true,
				//		'floatHeaderOptions'=>['scrollingTop'=>'50'],
				//		'showPageSummary' => true,
					'pjax'=>true,
					'pjaxSettings'=>[
						'neverTimeout'=>true,
				//			'beforeGrid'=>'My fancy content before.',
				//			'afterGrid'=>'My fancy content after.',
					],
				//		'panel' => [
				//			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i>'. Yii::t('easyii', 'Ut Karts').'</h3>',
				//			'type'=>'success',
				//			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('easyii', 'Create Ut Kart'), ['create'], ['class' => 'btn btn-success']),
				//			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
				//			'footer'=>false
				//		],
					'panel'=>[
						'type'=>GridView::TYPE_PRIMARY,
						'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-asterisk"></i> '. Yii::t('easyii', 'Ut Karts').'</h3>',
						'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('easyii', 'Create'), ['create'], ['class' => 'btn btn-success']),

					],
				//		'panelBeforeTemplate' => [
				//			'{before}' => 'true',
				//		],
					'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
					'headerRowOptions'=>['class'=>'kartik-sheet-style'],
					'filterRowOptions'=>['class'=>'kartik-sheet-style'],
					'toolbar'=> [
				//			['content'=>
				//				 Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
				//				 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
				//			],
						'{export}',
						'{toggleData}',
					]
				]);


			return $grid;
		}
	}
?>