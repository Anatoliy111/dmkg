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
use app\poslug\models\UtTarif;
use app\poslug\models\UtTarifab;
use app\poslug\models\UtTarifinfo;
use app\poslug\models\UtTarifplan;
	use app\poslug\models\UtUtrim;
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






$ZipBase = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','POSLTAR.DBF','TARPF.DBF','TARINFO.DBF','OBOR.DBF','NACH.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];

$t = false;
$DirFiles  = $_SESSION['DirFiles'];
//
if ($DirFiles<>'') {
//	if (!file_exists($_SESSION['DirUpd'] . 'import.txt')) {
//		$fp = fopen($_SESSION['DirUpd'] . 'import.txt', 'w');
		$t = true;
//	}
}
if ($t)
{

//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
//	UtObor::deleteAll('period = :period', [':period' => $this->MonthYear]);

	$RowsCount = 0;
	$NameBase[0]='';
$k=0;

	for ($i = 0; $i <= count($ZipBase)-1; $i++)
	{
		$filename = $DirFiles.'/'.$ZipBase[$i];

		if (file_exists($filename)) {
			$dbf = @dbase_open($filename, 0) or die("Error!!! Opening $filename $RowsCount");
			@dbase_pack($dbf);

//		$KartCount = dbase_numrecords($dbf);
			$NameBase[$k] = $ZipBase[$i];
			$RowsCount = $RowsCount + dbase_numrecords($dbf);
			switch ($NameBase[$k]) {
				case 'POSLTAR.DBF':
					UtTarif::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					UtTarifab::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'TARPF.DBF':
					UtTarifplan::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'OBOR.DBF':
					UtObor::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'NACH.DBF':
					UtNarah::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'OPL.DBF':
					UtOpl::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'SUBS.DBF':
					UtSubs::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
				case 'UDER.DBF':
					UtUtrim::deleteAll('period = :period', [':period' => $_SESSION['PeriodBase']]);
					break;
			}
			$k=$k+1;
		}
	};


//	$process = floor($RowsCount/100)==0 ? 1 : floor($RowsCount/100);


	$process = 100;
	$_SESSION['RowsCount'] = $RowsCount;
	$_SESSION['process'] = $process;
	$_SESSION['NameBase'] = $NameBase;
	$_SESSION['Progress'] = 0;
//	$_SESSION['endprogress'] = $colround;
	$_SESSION['NomBase']= 0;
	$_SESSION['NomRec']= 0;
	$_SESSION['EndCount'] = $RowsCount;

}
else
	echo ("Error !!!");

?>


