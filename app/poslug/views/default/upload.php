<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */


	use app\poslug\models\UploadForm;
	use kartik\datecontrol\DateControl;
	use yii\bootstrap\Html;
//	use yii\helpers\Html;
//	use yii\;
	use yii\bootstrap\Progress;
	use yii\easyii\modules\page\api\Page;
use yii\easyii\widgets\DateTimePicker;
	use yii\web\JsExpression;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
use yii\base\Event;



	Modal::begin([
		'header' => '<h2>Завантаження даних...</h2>',
		'options'=>[
			'id'=>'Modalprogress1'

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


//	echo 'Завантаження даних...';

	$progres = Progress::widget([
	'percent' => 10,
	'id'=>'upprogress',

	'barOptions' => [
		'class' => 'progress-bar-success'
	],
	'options' => [
		'class' => 'active progress-striped'
	]
]);
	echo $progres;


//	$model = new UploadForm();
//	$this->render('ImportProgress', ['model' => $model]);


	Modal::end();

//	Pjax::begin(['id' => 'upload']);

	$this->title = $model->title;
	$this->params['breadcrumbs'][] = $this->title;

	if ($model->progress)
	{
		$this->registerJs(
			"$('#Modalprogress1').modal('show');",
			yii\web\View::POS_READY
		);

		$js = <<< JS
				function repeat_import() {
					$.ajax({
							url: "/importdbf.php",
							timeout: 50000,
							success: function(data, textStatus){
										$("#upprogress").append("I");
										if (data == "The End") {
											$("#content").html("<h2>������ ��������!</h2>");
										}
										else {
											$("#content").html("<p>" + data + "</p>");
											repeat_import();
										}
									},
							complete: function(xhr, textStatus){
										if (textStatus != "success") {
											$("#upprogress").append("I");
											repeat_import();
										}
									}
					});
				}

				$(function (){
					repeat_import();
				})(jQuery);

JS;
		$this->registerJs($js);

	}

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
<?//=$form->field($model, 'MonthYear')->widget(DatePicker::classname(), [
//			'options' => ['placeholder' => 'Виберіть місяць...'],
////			'attribute2'=>'to_date',
//			'type' => DatePicker::TYPE_INPUT,
//			'pluginOptions' => [
//				'autoclose' => true,
//				'startView'=>'year',
//				'minViewMode'=>'months',
//				'format' => 'mm-yyyy'
//			]
//			])?>



<!--    --><?//= $form->field($model, 'Files[]')->fileInput(['multiple' => true, 'accept' => 'zip/zip']) ?>
		<?=$form->field($model, 'File')->widget(FileInput::classname(), [
//		'options' => ['accept' => 'zip/*.zip'],
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => false
			]
		]);?>



	<?=Html::submitButton('Завантажити все', ['class' => 'btn-lg btn-success'])?>


<?//= Html::submitButton('Завантажити', ['class' => 'btn-lg btn-success']) ?>
<?//= Html::a("Refresh", ['upload'], ['class' => 'btn btn-lg btn-primary']);?>
<?= Html::resetButton('Очистити',['class' => 'btn-lg btn-primary']) ?>
<?= Html::a('Оновити абонентів', ['index'], ['class' => 'btn-lg btn-success']) ?>

<?= Html::a('Назад', ['index'], ['class' => 'btn-lg btn-danger pull-right']) ?>
<?//= Html::a('Оновити довідники', ['updatesprav'], ['class' => 'btn-lg btn-success']) ?>
<?//= Html::a('Оновити базу', ['updatebase'], ['class' => 'btn-lg btn-success']) ?>

<br/>
<br/>


<?php
		foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
		echo '<div class="info' . $key . '">' . $message . "</div>\n";
		}
	?>

<?php ActiveForm::end() ?>

<?//=Event::on ($model::className(), $model::EVENT_AFTER_VALIDATE, function ($event) {
//	Yii::trace(get_class($event->sender) . ' добавлен');
//});?>

<?php //Pjax::end() ?>


<?//=$form->field($model, 'MonthYear')->widget(DatePicker::classname(), [
//	'options' => ['placeholder' => 'Виберіть місяць'],
//	'pluginOptions' => [
//		'calendarWeeks' => true,
//		'daysOfWeekDisabled' => [0, 6],
//		'format' => 'mm-yyyy',
////				'type' => DatePicker::CALENDAR_ICON,
//		'value' => Yii::$app->formatter->asDatetime($model->MonthYear),
////				'format' => 'mm-yyyy',
//		'autoclose' => true,
//	]
//])?>


<?//=DateControl::widget([
//'name'=>'kartik-date',
//'type'=>DateControl::FORMAT_DATE, // uses DatePicker
//'displayFormat'=>'d-M-Y', // your display format (can be set globally at module level)
//'saveFormat'=>'Y-m-d', // your save format (can be set globally at module level)
//'options'=>[  // this will now become the widget options for DatePicker
//'pluginOptions'=>['autoclose'=>true],// datepicker plugin options
//'convertFormat'=>true // autoconvert PHP date to JS date format
//]
//]);?>

<?//= $form->field($model, 'MonthYear')->widget(DatePicker::className(),
//
//
//	[
//
//		'clientOptions' =>[
//			'dateFormat' => 'd-m-yy',
//			'showAnim'=>'fold',
//			'yearRange' => 'c-25:c+0',
//			'changeMonth'=> true,
//			'changeYear'=> true,
//			'autoSize'=>true,
//			'showOn'=> "button",
//			//'buttonImage'=> "images/calendar.gif",
//			'htmlOptions'=>[
//				'style'=>'width:80px;',
//				'font-weight'=>'x-small',
//			],]]) ?>



<!--	--><?php


	//	echo FileInput::widget([
	//		'model' => $model,
	//		'attribute' => 'attachment_1[]',
	//		'options' => ['multiple' => true]
	//	]);
	//		$message = Yii::$app->session->getFlash('success');
	//
	//		echo '<div class="info">' . $message . "</div>\n";
?>
<?//= yii\helpers\Html::fileInput('File', null, [
	//	'id' => 'file',
	////	'class' => 'hidden',
	//	'multiple' => 'multiple',
	//])
	//?>
<!--	<input type="file" name="file" class="btn-lg btn-success">-->
<!--</div>-->
<?php
	//for($i=1;$i++;$i=100)
	//{
	//	echo Progress::widget([
	//		'label' => 'test',
	//		'percent' => $i,
	//		'barOptions' => [
	//			'class' => 'progress-bar-success'
	//		],
	//		'options' => [
	//			'class' => 'active progress-striped'
	//		]
	//	]);
	//}





?>

<?//= Html::submitButton('Завантажити', ['class' => 'btn-lg btn-success']) ?>
<?//= Html::a('Завантажити', ['index'], ['class' => 'btn-lg btn-danger pull-right']) ?>


