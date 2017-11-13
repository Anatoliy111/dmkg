<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */


	use app\poslug\models\UtNarah;
	use app\poslug\models\UtObor;
	use app\poslug\models\UtOpl;
	use app\poslug\models\UtSubs;
	use kartik\datecontrol\DateControl;
	use kartik\dialog\Dialog;
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
use yii\bootstrap\Alert;

//	Pjax::begin(['id' => 'upload']);

// echo Progress::widget([
//	'percent' => 0,
//    'id' => 'progress',
//	'barOptions' => [
//		'class' => 'progress-bar-success'
//	],
//	'options' => [
//		'class' => 'active progress-striped'
//	]
//]);



	$NameBase = ['WIDS.DBF','UL.DBF','ORGAN.DBF','NTARIF.DBF','OBOR.DBF','POSL.DBF','NACH.DBF','OPL.DBF','SUBS.DBF'];
//	$NameBase = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','NTARIF.DBF','OBOR.DBF','POSL.DBF','NACH.DBF','OPL.DBF','SUBS.DBF'];
//	$NameBase = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','NTARIF.DBF','OBOR.DBF','POSL.DBF','NACH.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];
//	$NameBase = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','NTARIF.DBF','NACH.DBF','OBOR.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];



$DirFiles  = $_SESSION['DirFiles'];

if ($DirFiles<>'')
{
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
//	UtObor::deleteAll('period = :period', [':period' => $this->MonthYear]);

	$RowsCount = 0;


	for ($i = 0; $i <= count($NameBase)-1; $i++)
	{
		$filename = $DirFiles.'/'.$NameBase[$i];
		$dbf = @dbase_open($filename, 0) or die("Error!!! Opening $filename");
		@dbase_pack($dbf);
//		$KartCount = dbase_numrecords($dbf);
		$RowsCount = $RowsCount + dbase_numrecords($dbf);
	};

	$process = floor($RowsCount/100);

	$_SESSION['RowsCount'] = $RowsCount;
	$_SESSION['process'] = $process;
	$_SESSION['NameBase'] = $NameBase;
	$_SESSION['Progress'] = 0;
	$_SESSION['NomBase']= 0;
	$_SESSION['NomRec']= 0;
	$_SESSION['EndCount'] = $RowsCount;
    UtNarah::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
	UtObor::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
	UtOpl::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
	UtSubs::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);


}








//Pjax::end()
?>


