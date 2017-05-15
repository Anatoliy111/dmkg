<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */


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
use yii\bootstrap\modal;
use yii\base\Event;

	Pjax::begin(['id' => 'upload']);

 echo Progress::widget([
	'percent' => $model->percent,

	'barOptions' => [
		'class' => 'progress-bar-success'
	],
	'options' => [
		'class' => 'active progress-striped'
	]
]);


Pjax::end() ?>


