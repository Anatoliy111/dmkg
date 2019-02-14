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
	$NameBase=array();
	$d=0;

	$Base = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','POSLTAR.DBF','201901TR.DBF','201901IN.DBF','OBOR.DBF','NACH.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];

	foreach ($DirFiles as $dir=>$files)
	{
		$period="";
		$dirname = mb_strtolower(substr(strrchr($dir, '/'), -6));
		if (intval($dirname)>201801){
			$period = date('Y-m-d',strtotime(substr($dirname,0,4).'-'.substr($dirname,4,2).'-01'));
	    }

		foreach ($files as $file) {
			$fname = '';
			$filename = $dir . '/' . $file;
			if ($dirname=='import'){
				$fname = mb_strtolower(substr($file, 0,6));
				if (intval($fname)>201801){
					$period = date('Y-m-d',strtotime(substr($fname,0,4).'-'.substr($fname,4,2).'-01'));
				}
			}

			if ($period=="")
				continue;

//			$Base = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','POSLTAR.DBF',$fname.'TR.DBF',$fname.'IN.DBF','OBOR.DBF','NACH.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];
//			$Base = ['POSLTAR.DBF'];
			$Base = ['WIDS.DBF','UL.DBF','ORGAN.DBF','KART.DBF','POSLTAR.DBF','201901TR.DBF','201901IN.DBF','OBOR.DBF','NACH.DBF','OPL.DBF','SUBS.DBF','UDER.DBF'];



			if (file_exists($filename) && in_array(mb_strtoupper($file), $Base)) {
				$dbf = @dbase_open($filename, 0) or die("Error!!! Opening $filename $RowsCount");
				@dbase_pack($dbf);

//		$KartCount = dbase_numrecords($dbf);
				$key = array_search(mb_strtoupper($file), $Base);
				if ($key!==null)
				   $NameBase[$key] = [$dir => $file];

				$RowsCount = $RowsCount + dbase_numrecords($dbf);
				switch ($file) {
					case 'POSLTAR.DBF':
						UtTarif::deleteAll('period = :period', [':period' => $period]);
						UtTarifab::deleteAll('period = :period', [':period' => $period]);
						break;
					case $fname.'tr.DBF':
						UtTarifplan::deleteAll('period = :period', [':period' => $period]);
						break;
					case 'OBOR.DBF':
						UtObor::deleteAll('period = :period', [':period' => $period]);
						break;
					case 'NACH.DBF':
						UtNarah::deleteAll('period = :period', [':period' => $period]);
						break;
					case 'OPL.DBF':
						UtOpl::deleteAll('period = :period', [':period' => $period]);
						break;
					case 'SUBS.DBF':
						UtSubs::deleteAll('period = :period', [':period' => $period]);
						break;
					case 'UDER.DBF':
						UtUtrim::deleteAll('period = :period', [':period' => $period]);
						break;
				}
				$d = $d + 1;
			}
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
	$_SESSION['countBase'] = count($Base)-1;

}
else
	echo ("Error !!!");

?>


