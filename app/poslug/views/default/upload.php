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
<div class="results">Ждем ответа</div>
<div class="base">Ждем ответа</div>

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


	//	$model = new UploadForm();
	//	$this->render('ImportProgress', ['model' => $model]);


	Modal::end();

//	Pjax::begin(['id' => 'upload']);

	$this->title = $model->title;
	$this->params['breadcrumbs'][] = $this->title;

	if ($model->progress)
	{
//		$this->registerJs(
////			"$('#Modalprogress1').modal('show');
//		"$('#Modalprogress1').modal({backdrop: false})",
//			yii\web\View::POS_READY
//		);

//		$js = <<< JS
//				function repeat_import() {
//					$.ajax({
//							url: "/poslug/default/download",
//							//timeout: 50000,
//							success: function(data, textStatus){
//										$("#upprogress").append("I");
//
//										if (data == "The End") {
//											$("#content").html("<h2>������ ��������!</h2>");
//										}
//										else {
//											$("#content").html("<p>" + data + "</p>");
//											//repeat_import();
//										}
//									},
//							complete: function(xhr, textStatus){
//
//       									 if (textStatus != "success") {
//											$("#upprogress").append("I");
//											//repeat_import();
//										}
//									}
//					});
//				}
				//$("#upprogress").append("I");

//				$(function (){
		//			    var win = $('#Modalprogress7');
		//win.modal({backdrop: false});

//					repeat_import();
//				});
//								       									$("#Modalprogress7").on('hidden.bs.modal', function(){
//											alert("Modal window has been completely closed.");
//										});

//JS;

		$js1 = <<< JS
		   var timer;
		   var url = 'upload';
		   //var ttt = document.getElementById('percent1').value;

    // The function to refresh the progress bar.
    function refreshProgress(percent) {
      $.ajax({
        url: "importdbf",
        success:function(data,succ,hhh){
           $('.results').html(percent);
                str = data;
				if (str.indexOf("Error!!!")>=0)
				   percent = closeImport(str);
			percent = percent + 1;
          $("#upprogress").html('<div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:'+ percent +'%"><span class="sr-only">'+ percent +'% Complete</span></div>');
          //$("#message").html(data.message);
          $("#mess").html("<p>" + percent + "</p>");
          // If the process is completed, we should stop the checking process.

          if($('#Modalprogress7').is(':visible')){
            if (percent >= 101) {
            //window.clearInterval(timer);
            //timer = window.setInterval(completed, 1000);
            //$('#Modalprogress7').modal('close');
            //$('#Modalprogress7').removeClass('show');
            $("#Modalprogress7").modal('hide');

            //$('#Modalprogress7').modal({show: false});
             //$('#Modalprogress7').remove();
				alert("Импорт завершен");
				window.location.href = url
				//location.replace();
			  }
			  else {
				 refreshProgress(percent);
			  }
            //      alert("Вы почему окно закрыли, а?");
            //window.clearInterval(timer);
            //timer = window.setInterval(completed, 1000);
          }
          else{
             alert("Импорт прерван");
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

       alert("Импорт прерван "+str);
       window.clearInterval(timer);
       return 100;

       //location.replace();
      //$("#Modalprogress7").modal('hide');

    }



				//$("#upprogress").append("I");

	$(function (){
	    //var win = $('#Modalprogress7');
	    //var url = "'.Url::toRoute('default/upload').'";
        //$('#Modalprogress7').modal({backdrop: false});
        //$.ajax({url: "importprogress"});
 	    $('#Modalprogress7').show();
	    $('#Modalprogress7').modal({backdrop: false});
        percent = 0;
        $.ajax({
        url: "importprogress",
        success:function(data,succ,hhh){
               //$('.results').html(data);
               str = data;
				if (str.indexOf("Error!!!")<0)
				{
					refreshProgress(percent=1);
				}
				else
				 	closeImport(str);
        }
        });


       //timer = window.setInterval(refreshProgress, 1000);
       //refreshProgress(percent);
	});
//								       									$("#Modalprogress7").on('hidden.bs.modal', function(){
//											alert("Modal window has been completely closed.");
//										});

JS;

		$this->registerJs($js1,\yii\web\View::POS_READY);

		$model->progress = false;
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


	<?=Html::submitButton('Завантажити', ['class' => 'btn-lg btn-success'])?>


<?//= Html::submitButton('Завантажити', ['class' => 'btn-lg btn-success']) ?>
<?//= Html::a("Refresh", ['upload'], ['class' => 'btn btn-lg btn-primary']);?>
<?= Html::resetButton('Очистити',['class' => 'btn-lg btn-primary']) ?>
<?//= Html::a('Оновити абонентів', ['index'], ['class' => 'btn-lg btn-success']) ?>

<?= Html::a('Назад', ['index'], ['class' => 'btn-lg btn-danger pull-right']) ?>
<?//= Html::a('Оновити довідники', ['updatesprav'], ['class' => 'btn-lg btn-success']) ?>
<?//= Html::a('Оновити базу', ['updatebase'], ['class' => 'btn-lg btn-success']) ?>

<br/>
<br/>


<?php
		foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="info">Імпорт виконано з помилками:</div>';
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


