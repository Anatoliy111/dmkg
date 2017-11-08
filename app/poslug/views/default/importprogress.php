<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */


	use app\poslug\models\UtObor;
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







$DirFiles  = $_SESSION['DirFiles'];

if ($DirFiles<>'')
{
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
//	UtObor::deleteAll('period = :period', [':period' => $this->MonthYear]);

	$RowsCount = 0;

	$filename = $DirFiles.'/'.'KART.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$KartCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $KartCount;
	$filename = $DirFiles.'/'.'NACH.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$NACHCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $NACHCount;
	$filename = $DirFiles.'/'.'NTARIF.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$NTARIFCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $NTARIFCount;
	$filename = $DirFiles.'/'.'OBOR.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$OborCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $OborCount;
	$filename = $DirFiles.'/'.'OPL.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$OPLCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $OPLCount;
	$filename = $DirFiles.'/'.'ORGAN.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$ORGANCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $ORGANCount;
	$filename = $DirFiles.'/'.'POSL.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$POSLCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $POSLCount;
	$filename = $DirFiles.'/'.'SUBS.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$SUBSCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $SUBSCount;
	$filename = $DirFiles.'/'.'UDER.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$UDERCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $UDERCount;
	$filename = $DirFiles.'/'.'UL.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$ULCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $ULCount;
	$filename = $DirFiles.'/'.'WIDS.DBF';
	$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
	@dbase_pack($dbf);
	$WIDSCount = dbase_numrecords($dbf);
	$RowsCount = $RowsCount + $WIDSCount;

	$progress = ceil($RowsCount/100);





}








//Pjax::end()
?>


