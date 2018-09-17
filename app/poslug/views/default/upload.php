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
use yii\helpers\Url;
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

	if ($model->progress)
	{
		$js1 = <<< JS
		   var timer;
		   var url = 'upload';


    // The function to refresh the progress bar.
    function refreshProgress(percent) {
      $.ajax({
        url: "importdbf",
        success:function(data,succ,hhh){
           $('.results').html(percent);
                str = data;
				if (str.indexOf("Error!!!")>=0)
				   percent = closeImport(str);
				if (str.indexOf("End import!!!")>=0)
				   percent = 1000;
			percent = percent + 1;
          $("#upprogress").html('<div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1000" style="width:'+ percent +'%"><span class="sr-only">'+ percent +'% Complete</span></div>');
          //$("#message").html(data.message);
          $("#mess").html("<p>" + percent + "</p>");
          // If the process is completed, we should stop the checking process.

          if($('#Modalprogress7').is(':visible')){
            if (percent >= 1001) {
            $("#mess").html("<p>" + percent + "</p>");
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
       return 1000;

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
               $('.results').html(data);
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




