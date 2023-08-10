<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */


	use app\poslug\models\UploadForm;
	use kartik\datecontrol\DateControl;
use kartik\grid\GridView;
use yii\bootstrap\Html;
//	use yii\helpers\Html;
//	use yii\;
	use yii\bootstrap\Progress;
	use yii\easyii\modules\page\api\Page;
use yii\easyii\widgets\DateTimePicker;
use yii\helpers\Url;
use yii\web\JsExpression;
	use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
use yii\base\Event;



	Modal::begin([
		'header' => '<h2>Завантаження даних...</h2>',
		'options'=>[
			'id'=>'Modalprogress7',
			'backdrop' => 'static',

		],
		'size'=> 'modal-lg',
//		'toggleButton' => [
//
//
//			'tag' => 'button',
//			'class' => 'advisor ',
//			'label' => 'Нажмите здесь, забавная штука!',
//		]
	]);
	//    echo "<script src=".'app/media/js/import-dbf.js'." type=".'text/javascript'."></script>";
?>
<div class="base">База</div>
<div class="results">Ждем ответа</div>

<?php


	$progres = Progress::widget([
		'percent' => 0,
		'id'=>'upprogress',

		'barOptions' => [
			'class' => 'progress-bar-success'
		],
		'options' => [
			'class' => 'active progress-striped'
		]
	]);
	echo $progres;



	Modal::end();


	$this->title = $model->title;
	$this->params['breadcrumbs'][] = $this->title;

?>





<?php $form = ActiveForm::begin([
	'id'=>'UploadAF',
	'options' => [
	'enctype' => 'multipart/form-data',
//	'data-pjax' => true,
//	'enableAjaxValidation'=>true,
//	'validateOnSubmit'=>true,
	]])
?>

<?php

?>
<!--не удалять-->
<!--//=$form->field($model, 'MonthYear')->widget(DatePicker::classname(), [-->
<!--//			'options' => ['placeholder' => 'Виберіть місяць...'],-->
<!--////			'attribute2'=>'to_date',-->
<!--//			'type' => DatePicker::TYPE_INPUT,-->
<!--//			'pluginOptions' => [-->
<!--//				'autoclose' => true,-->
<!--//				'startView'=>'year',-->
<!--//				'minViewMode'=>'months',-->
<!--//				'format' => 'mm-yyyy'-->
<!--//			]-->
<!--//			])-->




		<?=$form->field($model, 'File')->widget(FileInput::classname(), [
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => false
			]
		]);?>


<?=Html::submitButton('Завантажити', ['class' => 'btn-lg btn-success'])?>
<?= Html::resetButton('Очистити',['class' => 'btn-lg btn-primary']) ?>


<?= Html::a('Назад', ['index'], ['class' => 'btn-lg btn-danger pull-right']) ?>


<br/>
<br/>

<?php
		foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
			if (gettype($message)=='array')
			{
				foreach($message as $mes)
				{
					echo '<div class="info' . $key . '">' . $mes . "</div>\n";
				}
			}
			else
				echo '<div class="info' . $key . '">' . $message . "</div>\n";
		}
	?>

<?php ActiveForm::end() ?>


<?php

echo GridView::widget([
	'id'=>'gridfile',
	'dataProvider' =>  $provider,

	'columns' => [
		['class' => '\kartik\grid\SerialColumn'],
		[
			'class' => 'kartik\grid\CheckboxColumn',
//			'headerOptions' => ['class' => 'kartik-sheet-style'],
//			'rowSelectedClass'=>GridView::TYPE_DEFAULT,
//			'checkboxOptions' => function ($model, $key, $index, $column) {
//				if (!substr(strrchr($model, '.'), 1)) {
////					return Html::a($data, ['/poslug/ut-kart/view', 'id' => 1]);
////					$column->noWrap = true;
////					$column->hidden = true;
////					$column->visible = false;
//////					return ['value' => $model];
////					return ['hidden'=>'true','rowHighlight'=>'false','rowSelectedClass'=>GridView::TYPE_DEFAULT];
////					return ['rowSelectedClass'=>GridView::TYPE_SUCCESS];
////					return ['hidden'=>'true','rowSelectedClass'=>'GridView::TYPE_SUCCESS'];
////					return ['disabled' => 'true'];
//
//				}
////				else
////					return ['checked'=>"checked"];
//
//			}

//			'checkboxOptions' => function ($model, $key, $index, $column) {
//				return ['value' => $model->id];
//			}

		],
//		[
//			'attribute' => 'id',
//			'format' => 'raw',
//			'value' => function ($data,$id,$key) {
//                if (!substr(strrchr($data, '.'), 1)) {
////					return Html::a($data, ['/poslug/ut-kart/view', 'id' => 1]);
//					return Html::a($data, 'upload');
//				}
//				return $data;
//			},
//		],

		'id',

	],
//		'layout' => $layout,
//				'layout'=>"{items}",
	'resizableColumns'=>true,

//		'pjax'=>false,
	'striped'=>true,
	'panel' => [
		'heading'=>$uploadDir,
		'type'=>'success',
		'footer'=>false
	],

	'floatHeaderOptions'=>['scrollingTop'=>'50'],

	'toolbar'=> [

	]
]);

?>

<?php
echo Html::button('Імпорт', [
	'id' => 'btn-imp',
	'class' => 'btn btn-success',

]);
?>


<?php echo Html::button(Yii::t('easyii', 'Delete'), [
	'id' => 'btn-delimp',
	'class' => 'btn btn-danger',
    ])
?>


<script type="text/javascript">
	function deletefile()
	{

		var keys = $('#gridfile').yiiGridView('getSelectedRows');
		if (keys.length != 0){
			var hi= confirm("Ви впевненні що хочете видалити ці11 файли?");
			if (hi== true){
			$.ajax({
				url: "/poslug/default/delfile",
				type: 'post',
				data: {keys},
				success: function(s) {
	//				alert(s);
				}

			});

			}
		}


	}

	function importfile() {
		var keys = $('#gridfile').yiiGridView('getSelectedRows');
		$.ajax({
			url: "/poslug/default/impfile",
			type: 'post',
			data: {keys},
			success: function () {
				$(function () {
					$('#Modalprogress7').show();
					$('#Modalprogress7').modal({backdrop: false});
					percent = 0;
					formclose = 0;
					$.ajax({
						url: "importprogress",
						success: function (data, succ, hhh) {
							//$('.results').html(data);
							str = data;
							if (str.indexOf("Error!!!") < 0) {
								refreshProgress(percent = 1, formclose);
							}
							else
								closeImport(str);
						}
					});

				});

				function refreshProgress(percent, formclose) {
					$.ajax({
						url: "importdbf",
						success: function (data, succ, hhh) {
							$('.results').html(percent);
							str = data;
							if (str.indexOf("Error!!!") >= 0)
								formclose = closeImport(str);
							if (str.indexOf("End import!!!") >= 0)
								formclose = 1;
							percent = percent + 1;
							$("#upprogress").html('<div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1000" style="width:' + percent + '%"><span class="sr-only">' + percent + '% Complete</span></div>');
							//$("#message").html(data.message);
							$("#mess").html("<p>" + percent + "</p>");
							// If the process is completed, we should stop the checking process.

							if ($('#Modalprogress7').is(':visible')) {
								if (formclose == 1) {
									$("#mess").html("<p>" + percent + "</p>");


									$("#Modalprogress7").modal('hide');


									alert("Импорт завершен");
									window.location.href = url

								}
								else {
									refreshProgress(percent, formclose);
								}

							}
							else {
								alert("Импорт прерван");
								window.clearInterval(timer);
							}


						}
					});
				}

				function completed() {
					$("#message").html("Completed");
					window.clearInterval(timer);
				}

				function closeImport(str) {

					$("#Modalprogress7").modal('hide');

					alert("Импорт прерван ");
					window.clearInterval(timer);
					return 1;


				}


			}
		});
	}


</script>

