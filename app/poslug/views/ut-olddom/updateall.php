<?php

	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
	use \app\poslug\models\UtUlica;


/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUlica */

$this->title = Yii::t('easyii', 'Update {modelClass}: ', [
    'modelClass' => 'Ut Olddom',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Olddom'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$title = $this->title;
?>
<div class="ut-olddom--update">

<!--    --><?//= Html::a(Yii::t('easyii', 'Back'),Yii::$app->request->referrer, ['data-pjax'=>0, 'class'=>'btn btn-success pull-right', 'title'=>'Back'])?>
    <!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->




    <?php

    	$form = ActiveForm::begin();
//        $attribs = $Model->formAttribs;
//    	unset($attribs['attributes']['color']);
//    	$attribs['attributes']['status'] = [
//    	'type'=>TabularForm::INPUT_WIDGET,
//    	'widgetClass'=>\kartik\widgets\SwitchInput::classname()
//    	];

    	echo TabularForm::widget([
    	'dataProvider'=>$dataProvider,
//		'searchModel' => $searchModel,
    	'form'=>$form,
			// set defaults for rendering your attributes
		'attributeDefaults'=>[
			'type'=>TabularForm::INPUT_TEXT,
		],

			// configure attributes to display
		'attributes'=>[
//			'id'=>['label'=>'book_id', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
//			'name'=>['label'=>'Book Name'],
//			'publish_date'=>['label'=>'Published On', 'type'=>TabularForm::INPUT_STATIC],

//    		 'id_ul'=>[
//				 'type'=>TabularForm::INPUT_DROPDOWN_LIST,
//			 ],
			 'id_ul'=>[
				 'type'=>TabularForm::INPUT_DROPDOWN_LIST,
				 'items'=>ArrayHelper::map(UtUlica::find()->orderBy('ul')->asArray()->all(), 'id', 'ul'),
				 'columnOptions'=>['width'=>'285px']
			 ],
			 'dom' =>['type'=>TabularForm::INPUT_STATIC],
			 'ndom' =>['type'=>TabularForm::INPUT_STATIC],
			 'real_dom'=>['type'=>TabularForm::INPUT_TEXT],
			 'ul' => ['type'=>TabularForm::INPUT_STATIC],
			 'pod' => ['type'=>TabularForm::INPUT_STATIC],
			 'rajon' =>['type'=>TabularForm::INPUT_HIDDEN_STATIC],


		],
    	'gridSettings'=>[
//    	'floatHeader'=>true,
    	'panel'=>[
    	'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>'.' '.$this->title.'</h3>',
    	'type' => GridView::TYPE_PRIMARY,
    	'after'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
    	Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
    	Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
//			            'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add New', ['type'=>'button', 'class'=>'btn btn-success kv-batch-create']) . ' ' .
//	Html::button('<i class="glyphicon glyphicon-remove"></i> Delete', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete']) . ' ' .
//	Html::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['type'=>'button', 'class'=>'btn btn-primary kv-batch-save'])
    	]
    	]
    	]);
    	ActiveForm::end(); ?>

</div>
