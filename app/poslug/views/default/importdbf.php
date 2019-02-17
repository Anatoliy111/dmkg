<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */

	use app\poslug\models\UtAbonent;
	use app\poslug\models\UtDom;
use app\poslug\models\UtDominfo;
use app\poslug\models\UtKart;
use app\poslug\models\UtNarah;
	use app\poslug\models\UtObor;
	use app\poslug\models\UtOpl;
	use app\poslug\models\UtPokaz;
	use app\poslug\models\UtPosl;
	use app\poslug\models\UtRabota;
	use app\poslug\models\UtSubs;
	use app\poslug\models\UtTarif;
	use app\poslug\models\UtTarifab;
use app\poslug\models\UtTarifinfo;
use app\poslug\models\UtTarifplan;
use app\poslug\models\UtTarifvid;
use app\poslug\models\UtTipposl;
	use app\poslug\models\UtUlica;
	use app\poslug\models\UtUtrim;
	use app\poslug\models\UtVidlgot;
use app\poslug\models\UtVidpokaz;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
	use yii\bootstrap\Progress;
	use yii\helpers\Html;

global $period;


	//	$_SESSION['RowsCount'] = $RowsCount;
//	$process = $_SESSION['process'];
//	$_SESSION['Progress'] = $_SESSION['Progress'] + 1;

//	$_SESSION['NameBase'] = $NameBase;
//	$_SESSION['NomBase']= 0;
//	$_SESSION['EndCount'] = $RowsCount;
//
//	$Base = $_SESSION['NameBase'][$_SESSION['NomBase']];
//?>
<!---->
<!--	--><?//= Html::tag('p', Html::encode($Base), ['class' => 'base']) ?>
<!---->
<!---->

<?php
//	$filename = $_SESSION['DirFiles'].'/'.$Base;
//	$dbf = @dbase_open($filename, 0) or die("Error!!!  Opening $filename");
//	@dbase_pack($dbf);
//	$rowsCount = dbase_numrecords($dbf);
//	$countRec = $rowsCount - $_SESSION['NomRec'];
//	if ($countRec>$_SESSION['process'])
//		$process=$_SESSION['NomRec']+$_SESSION['process'];
//	else $process=$rowsCount;
//
//
////	if ($process > $rowsCount)
////		$process = $rowsCount;
////	if ($_SESSION['NomRec']+$process )
//
//	$type = 'png';
//	$functionname = 'import'.strstr($Base, '.', true);;
//	if (function_exists($functionname)) {
//
//		for ($i = $_SESSION['NomRec']+1; $i <= $process; $i++)
//		{
//			if (!$functionname($dbf,$i))
//				die("Error!!!  Return to false $functionname");
//		};
//		if ($i==$rowsCount+1)
//		{
//			$_SESSION['NomRec'] = 0;
//			$_SESSION['EndCount'] = $_SESSION['EndCount'] - $process - $_SESSION['NomRec']+1;
//			if ($_SESSION['Progress']<100)
//			     $_SESSION['process'] = floor($_SESSION['EndCount']/(100-$_SESSION['Progress']));
//			$_SESSION['NomBase'] = $_SESSION['NomBase'] + 1;
//		}
//		else
//		{
//			$_SESSION['NomRec'] = $i;
//			$_SESSION['EndCount'] = $_SESSION['EndCount'] - $_SESSION['process'];
//		}
//
//	}
//	else
//		die("Error!!!  Opening $functionname");

	$process = $_SESSION['process'];
	$nomrec = $_SESSION['NomRec'];
	$nombase = $_SESSION['NomBase'];
	$start = 0;
	$endbase = $_SESSION['countBase'];
	//newmes();


$t = true;

	while( $t) {
		if ($nombase>$endbase){
			echo ("End import!!!");
//			removeDirectory($_SESSION['DirUpd']);
			break;
		}


		if (empty($_SESSION['NameBase'][$nombase])){
			$nombase = $nombase + 1;
			break;
		}

		$Base = $_SESSION['NameBase'][$nombase];


		$filename = key($Base).'/'.current($Base);
        if (!file_exists($filename)) {
			$nombase = $nombase + 1;
			break;
		}
	    $dbf = @dbase_open($filename, 0) or die("Error!!!  Opening $filename");
	    @dbase_pack($dbf);
	     $rowsCount = dbase_numrecords($dbf);
		$GLOBALS["period"]="";
		$fname = '';
		$dirname = mb_strtolower(substr(strrchr(key($Base), '/'), -6));
		if (intval($dirname)>201801){
			$GLOBALS["period"] = date('Y-m-d',strtotime(substr($dirname,0,4).'-'.substr($dirname,4,2).'-01'));
			$fname = current($Base);
		}
		else{
			$datename = '';
			if ($dirname=='import'){
				$datename = mb_strtolower(substr(current($Base), 0,6));
				if (intval($datename)>201801){
					$GLOBALS["period"] = date('Y-m-d',strtotime(substr($datename,0,4).'-'.substr($datename,4,2).'-01'));
					$fname = mb_strtoupper(substr(current($Base), 6));
				}
			}
		}

		if ($GLOBALS["period"]==""){
			$nombase = $nombase + 1;
			break;
		}


//		if ($_SESSION['Progress']>=1000 and $nombase==$endbase)
//		{
//			$process = $rowsCount-$nomrec;
//		}
//	     $countRec = $rowsCount - $_SESSION['NomRec'];
//	     if ($countRec>$_SESSION['process'])
//		  $process=$_SESSION['NomRec']+$_SESSION['process'];
//	     else $process=$rowsCount;
		$functionname = 'import'.strstr($fname, '.', true);

		if (function_exists($functionname)) {

			for ($i = $start+1; $i <= $process; $i++)
			{
				$nomrec = $nomrec +1;
				if (!$functionname($dbf,$nomrec,current($Base)))
					  Yii::$app->session->AddFlash('alert-danger', 'Return to false '.$functionname);
//				      die("Error!!!  Return to false $functionname");

				if ($nomrec==$rowsCount)
				{
					$nombase = $nombase + 1;
					$nomrec = 0;
					if ($i==$process)
						$t = false;
					break;
				}
			}

			$start = $i;
			if ($i==$process+1)
				$t = false;


//			if ($_SESSION['Progress']==1000)
//			{
//				newmes();
//			}



		}
		else
			$nombase = $nombase + 1;
	}

	$_SESSION['NomBase'] = $nombase;
	$_SESSION['NomRec'] = $nomrec;


function importUL($dbf,$i,$Base)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$ulic = encodestr(trim(iconv('CP866','utf-8',$fields['UL'])));
		$FindModel = UtUlica::findOne(['kl' => $fields['KL']]);
		if ($FindModel== null)
		{
			$model = new UtUlica();
			$model->ul = $ulic;
			$model->kl = $fields['KL'];
			$model->val = $fields['VAL'];
			if ($model->validate() && $model->save())
			{
				return true;
			}
			else
			{
//				Yii::$app->session->AddFlash('alert-danger', 'Помилка імпорту '.$dbf.' '.$ulic.' ' );
				Flash($Base,$model,$model->ul);
//				die("Error!!!  Insert is $dbf  to UtUlica $ulic");
//				return false;
			}
		}
		elseif ($FindModel->val != $fields['VAL'])
		{
			$FindModel->ul = $ulic;
			$FindModel->kl = $fields['KL'];
			$FindModel->val = $fields['VAL'];
			if ($FindModel->validate() && $FindModel->save())
			{
				return true;
			}
			else
			{
				Flash($Base,$FindModel,$FindModel->ul);
//				return false;
			}
		}
	}
	return true;
}

function importWIDS($dbf,$i,$Base)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$FindModel = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
		if ($FindModel== null)
		{

			$model = new UtTipposl();
			$model->old_tipusl = $fields['WID'];
			$model->poslug = encodestr(trim(iconv('CP866','utf-8',$fields['NAIM'])));
			$model->id_org = 1;
			$model->ed_izm = encodestr(trim(iconv('CP866','utf-8',$fields['PAR'])));
			$model->id_vidpokaz = 8;
			if ($model->validate())
			{
				$model->save();
				return true;
			}
			else
			{
				Flash($Base,$model,$model->poslug);
			}

		}
//		elseif ($FindModel->val != $fields['VAL'])
//		{
//			$FindModel->old_tipusl = $fields['WID'];
//			$FindModel->poslug = encodestr(trim(iconv('CP866','utf-8',$fields['NAIM'])));
//			$FindModel->ed_izm = encodestr(trim(iconv('CP866','utf-8',$fields['PAR'])));
//			if ($FindModel->validate())
//			{
//				$FindModel->save();
//				return true;
//			}
//			else
//			{
//				Flash($Base,$FindModel,$FindModel->poslug);
//				die("Error!!!  Insert is $Base  to UtTipposl $FindModel->poslug");
////				return false;
//			}
//		}
	}
	return true;
}

function importORGAN($dbf,$i,$Base)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$FindModel = UtRabota::findOne(['id_oldorg' => $fields['ORG']]);
		if ($FindModel== null )
		{

			$model = new UtRabota();
			$model->id_oldorg = $fields['ORG'];
			$model->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
			$model->id_org = 1;
			$model->fio_ruk = encodestr(trim(iconv('CP866','utf-8',$fields['RUK'])));
			$model->val = $fields['VAL'];
			if ($model->validate())
			{
				$model->save();
				return true;
			}
			else
			{
				Flash($Base,$model,$model->name);
//				die("Error!!!  Insert is $dbf  to UtRabota $model->name");
//			return false;
			}

		}
		elseif ($FindModel->val != $fields['VAL'])
		{
			$FindModel->id_oldorg = $fields['ORG'];
			$FindModel->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
			$FindModel->id_org = 1;
			$FindModel->fio_ruk = encodestr(trim(iconv('CP866','utf-8',$fields['RUK'])));
			$FindModel->val = $fields['VAL'];
			if ($FindModel->validate())
			{
				$FindModel->save();
				return true;
			}
			else
			{
				Flash($Base,$FindModel,$FindModel->name);
//				die("Error!!!  Insert is $dbf  to UtRabota $FindModel->name");
//			return false;
			}
		}
	}
	return true;
}

function importKART($dbf,$i,$Base)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
		if ($schet<>0 or $schet<>null)
		{
			$Abon = UtAbonent::findOne(['schet' => $schet]);
			if ($Abon== null)
			{

				$modelKt = NewUpKart($fields,null);

				if ($modelKt->validate())
				{
					$modelKt->save();

					if (importAbon($fields,$schet,$modelKt->id,$Abon))
					   return true;
					else
						Flash($Base,$Abon,$schet);
//						die("Error!!!  Insert is $dbf  to UtAbonent $schet");

				}
				else
				{
					Flash($Base,$modelKt,$schet.' '.$modelKt->fio);
//					die("Error!!!  Insert is $dbf  to UtKart $schet $modelKt->fio $Abon");
//			        return false;
				}



			}
			else
			{

				if ($Abon->id_kart == null)
				{
					$modelKt = NewUpKart($fields,null);
					if ($modelKt->validate())
					{
						$modelKt->save();
						$Abon->id_kart = $modelKt->id;
						if ($Abon->validate())
						{
							$Abon->save();
							if ($Abon->val != $fields['VAL'])
							{
								importAbon($fields,$schet,$modelKt->id,$Abon);
							}
						}
						else
							Flash($Base,$Abon,$schet);
//							die("Error!!!  Edit id_kart is $dbf  to UtAbonent $Abon->schet");
					}
					else
					{
						Flash($Base,$modelKt,$schet.' '.$modelKt->fio);
//						die("Error!!! Insert is $dbf  to UtKart $schet $modelKt->fio $Abon->schet");
					}
				}
				else//
					if ($Abon->val != $fields['VAL'])
				{
					$modelKt = UtKart::findOne(['id' => $Abon->id_kart]);
					$modelKt = NewUpKart($fields,$modelKt);
					if ($modelKt->validate())
					{
						$modelKt->save();
					}
					else
					{
						Flash($Base,$modelKt,$schet.' '.$modelKt->fio);
//						die("Error!!! Insert is $dbf  to UtKart $schet $modelKt->fio $Abon->schet");
					}
					importAbon($fields,$schet,$modelKt->id,$Abon);

				}


			}
		}
	}
	return true;
}

	function NewUpKart($fields,$model)
	{
		if ($model==null)
			$modelKt = new UtKart();
		else
			$modelKt=$model;
		$modelKt->scenario = 'adres';
		$modelKt->name_f =encodestr(trim(iconv('CP866','utf-8',$fields['FIO'])));
		$modelKt->name_i =encodestr(trim(iconv('CP866','utf-8',$fields['IM'])));
		$modelKt->name_o =encodestr(trim(iconv('CP866','utf-8',$fields['OT'])));
		$modelKt->fio = $modelKt->name_f.' '.$modelKt->name_i.' '.$modelKt->name_o;
		if (trim($modelKt->fio)=='')
		{
			$modelKt->name_f = 'невідомий абонент';
			$modelKt->fio = 'невідомий абонент';
		}
		$modelKt->idcod = trim($fields['IDCOD']);
		$ulica = $fields['KL_UL'];
		$FindUl = UtUlica::findOne(['kl' => $ulica]);
		if ($FindUl <> null)
		{
			$modelKt->id_ulica = $FindUl->id;
		}
		else
		{
			if ($ulica<>0)
			{
				$ul = new UtUlica();
				$ul->kl = $ulica;
				$ul->ul = encodestr(trim(iconv('CP866','utf-8',$fields['ULNAIM'])));
				if ($ul->validate() && $ul->save())
				{
					$modelKt->id_ulica = $ul->id;
				}
			}
			else
				$modelKt->id_ulica = 1;
		}
		$modelKt->dom = encodestr(trim(iconv('CP866','utf-8',$fields['NOMDOM'])));
		$modelKt->kv = trim($fields['NOMKV']);
		$FindRb = UtRabota::findOne(['id_oldorg' => $fields['ORG']]);
		if ($FindRb <> null)
		{
			$modelKt->id_rabota = $FindRb->id;
		}
		$FindDom = UtDom::findOne(['n_dom' => $modelKt->dom,'id_ulica' => $modelKt->id_ulica]);
		if ($FindDom <> null)
		{
			$modelKt->id_dom = $FindDom->id;
		}
		elseif($modelKt->dom<>'' and $modelKt->id_ulica<>null)
		{
			$dom = new UtDom();
			$dom->id_ulica = $modelKt->id_ulica;
			$dom->n_dom = $modelKt->dom;
			$dom->save();
			$dominfo = new UtDominfo();
			$dominfo->id_dom = $dom->id;
			$dominfo->save();
			$modelKt->id_dom = $dom->id;
		}
		$modelKt->privat = trim($fields['PRIV']) == 'p' ? 1 : null;
		$modelKt->ur_fiz = 0;
		$modelKt->telef = encodestr(trim(iconv('CP866','utf-8',$fields['TELEF'])));

		return $modelKt;

	}


function importAbon($fields,$schet,$idkart,$Abon)
{
	if ($Abon==null)
	{
		$modelAb = new UtAbonent();
		$modelAb->id_org = 1;
		$modelAb->schet = $schet;
		$modelAb->id_kart =  $idkart;
		$modelAb->note = encodestr(trim(iconv('CP866','utf-8',$fields['NOTE']).' '.iconv('CP866','utf-8',$fields['NOTE1'])));
		$modelAb->val = $fields['VAL'];
	}

	else
	{
		$modelAb = $Abon;
		$modelAb->note = encodestr(trim(iconv('CP866','utf-8',$fields['NOTE']).' '.iconv('CP866','utf-8',$fields['NOTE1'])));
		$modelAb->val = $fields['VAL'];
	}



	if ($modelAb->validate())
	{
		$modelAb->save();
		if (importPokaz($fields,$modelAb,$Abon))
		return true;
	}
	else
	{
		Flash('KART.DBF',$modelAb,$schet);
//		die("Error!!!  Insert is UtAbonent $schet $idkart ");
	}

	return true;

}

function importPokaz($fields,$modelAb,$st)
{
	$array = ['KOLI_PF' => 12,'KOLI_P' => 5,'KOLI_K' => 4,'PLOS_BB' => 3,'PLOS_OB' => 2];

	foreach ($array as $k => $v)
	{
		$FindPF = UtPokaz::findOne(['id_abonent' => $modelAb->id,'id_vidpokaz' => $v]);
		if ($FindPF == null)
		{
			$model = new UtPokaz();
			$model->id_vidpokaz = $v;
			$model->id_abonent = $modelAb->id;
			$model->id_org = 1;
			$model->pokaznik = $fields[$k];
			if ($model->validate())
			{
				$model->save();
			}
			else
				Flash('KART.DBF',$model,$modelAb->schet);

		}
		elseif ($st<>null)
		{
			$model = $FindPF;
			$model->id_vidpokaz = $v;
			$model->id_abonent = $modelAb->id;
			$model->id_org = 1;
			$model->pokaznik = $fields[$k];
			if ($model->validate())
			{
				$model->save();
			}
			else
				Flash('KART.DBF',$model,$modelAb->schet);
//				die("Error!!!  Insert to UtPokaz $modelAb->schet $model->pokaznik");
		}
	}

    return true;
}

//function importNTARIF($dbf,$i,$Base)
//{
//	$fields = dbase_get_record_with_names($dbf,$i);
//	if ($fields['deleted'] <> 1)
//	{
//
//		if (UtTarif::findOne(['kl' => $fields['KL']])== null)
//		{
//
//			$model = new UtTarif();
//			$Find = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
//			if ($Find <> null)
//			{
//				$model->id_tipposl = $Find->id;
//				$model->id_vidpokaz = $Find->id_vidpokaz;
//			}
//
//			$model->kl = $fields['KL'];
//			$model->tarif1 = $fields['TARIF'];
//			$model->id_org = 1;
//			$model->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
//			if ($model->validate())
//			{
//				$model->save();
//				return true;
//			}
//			else
//			{
//				Flash($Base,$model,$model->name);
////				die("Error!!!  Insert is $dbf  to UtTarif $model->name");
////			return false;
//			}
//
//		}
//	}
//	return true;
//}

	function importPOSLTAR($dbf,$i,$Base)
	{
		$fields = dbase_get_record_with_names($dbf,$i);
		if ($fields['deleted'] <> 1)
		{
			$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));

			$FindAbon =  UtAbonent::findOne(['schet' => $schet]);
			$FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
			if ($FindTipPosl<> null and $FindAbon <> null)
			{
				$FindKart=UtKart::findOne(['id' => $FindAbon->id_kart]);
				if ($FindKart == null)
				{
					Flash($Base,$FindKart,$schet.' '.$FindKart->fio);
					return true;
				}
				if ($FindKart->id_dom == null or UtDom::findOne($FindKart->id_dom)==null)
				{
					$FindDom = UtDom::findOne(['n_dom' => $FindKart->dom,'id_ulica' => $FindKart->id_ulica]);
					if ($FindDom <> null)
					{
						$FindKart->id_dom = $FindDom->id;
						$FindKart->save();
					}
					elseif($FindKart->dom<>'' and $FindKart->id_ulica<>null)
					{
						$dom = new UtDom();
						$dom->id_ulica = $FindKart->id_ulica;
						$dom->n_dom = $FindKart->dom;
						$dom->save();
						$dominfo = new UtDominfo();
						$dominfo->id_dom = $dom->id;
						$dominfo->save();
						$FindKart->id_dom = $dom->id;
						$FindKart->save();
					}
					else
						return true;
				}
				$FindTarif = UtTarif::findOne(['id_dom' => $FindKart->id_dom,'period' => $GLOBALS["period"],'kl' => $fields['KL_NTAR']]);
				if ($FindTarif == null)
				{
					$model = new UtTarif();
					$model->id_org = 1;
					$model->id_tipposl = $FindTipPosl->id;
					$model->id_vidpokaz = $FindTipPosl->id_vidpokaz;
					$model->id_dom = $FindKart->id_dom;
					$model->period = $GLOBALS["period"];
					$model->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
					$model->kl = $fields['KL_NTAR'];
					$model->tariffakt = $fields['TARIF'];
					$model->norma = !empty($fields['NORMA']) ? $fields['NORMA'] : 0;
//					$model->tariffakt = $fields['KORTARIF'];
//					if ($fields['KORTARIF']<>0)
//					{
//						$model->tariffakt=$fields['KORTARIF'];
//					}
//					else
//						$model->tariffakt = $fields['TARIF'];

					if ($model->validate())
					{
						$model->save();
						$Tarifab = new UtTarifab();
						$Tarifab->id_org = 1;
						$Tarifab->id_abonent = $FindAbon->id;
						$Tarifab->period = $GLOBALS["period"];
						$Tarifab->id_tarif = $model->id;
						$Tarifab->sumtarif = $fields['SUMTARIF'];
						$Tarifab->kortarif = $fields['KORTARIF'];
						$Tarifab->endtarif = $fields['ENDTARIF'];
						$Tarifab->tarif = $fields['TARIF'];
						$Tarifab->days = $fields['DAYS'];
						$Tarifab->daymes = $fields['DAYSMES'];
						$Tarifab->norma = !empty($fields['NORMA']) ? $fields['NORMA'] : 0;


						if ($Tarifab->validate())
						{
							$Tarifab->save();
							return true;
						}
						return true;
					}
					else
					{
						Flash($Base,$model,$schet.' '.$model->name);
//						die("Error!!!  Insert is $dbf  to UtTarifab $schet $FindAbon->schet");
//			return false;
					}
				}
				else
				{
					$Tarifab = new UtTarifab();
					$Tarifab->id_org = 1;
					$Tarifab->id_abonent = $FindAbon->id;
					$Tarifab->period = $GLOBALS["period"];
					$Tarifab->id_tarif = $FindTarif->id;
					$Tarifab->sumtarif = $fields['SUMTARIF'];
					$Tarifab->kortarif = $fields['KORTARIF'];
					$Tarifab->endtarif = $fields['ENDTARIF'];
					$Tarifab->tarif = $fields['TARIF'];
					$Tarifab->days = $fields['DAYS'];
					$Tarifab->daymes = $fields['DAYSMES'];
					$Tarifab->norma = !empty($fields['NORMA']) ? $fields['NORMA'] : 0;
					if ($Tarifab->validate())
					{
						$Tarifab->save();
						return true;
					}
					return true;
				}
//				elseif ($FindTarifab->val != $fields['VAL'])
//				{
//					$model = $FindTarifab;
//					$model->id_org = 1;
//					$model->nametarif = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
//					$model->kl = $fields['KL_NTAR'];
//					$model->tarif = $fields['TARIF'];
//					$model->kortarif = $fields['KORTARIF'];
//					$model->endtarif = $fields['ENDTARIF'];
//					$model->days = $fields['DAYS'];
//					$model->val = $fields['VAL'];
//					if ($model->validate())
//					{
//						$model->save();
//						return true;
//					}
//					else
//						Flash($Base,$model,$schet.' '.$model->nametarif);
////					   die("Error!!!  Insert is $dbf  to UtTarifab $schet $FindAbon->schet");
//				}


			}
			else
				return true;

		}
		return true;
	}

function importTR($dbf,$i,$Base)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
		if ($FindTipPosl==null)
		{
			Flash($Base,null,'нема послуги '.$fields['WID']);
		}
		$FindDom = UtDom::findOne(['id_impdom' => $fields['ID_DOM']]);
		if ($FindDom == null) {
			$FindUL = UtUlica::findOne(['id_impul' => $fields['ID_UL']]);
			if ($FindUL == null) {
				$FindUL = UtUlica::findOne(['kl' => $fields['KL_UL']]);
				if ($FindUL == null) {
					Flash($Base, null, 'нема вулиці ' . trim(iconv('CP866','utf-8',$fields['UL'])));
				}
				else{
					$FindUL->id_impul = $fields['ID_UL'];
					$FindUL->save();
				}
				
			}
			if ($FindUL != null)
				$FindDom = UtDom::findOne(['n_dom' => trim(iconv('CP866','utf-8',$fields['DOM'])),'id_ulica' => $FindUL->id]);
		}
		if ($FindDom != null) {
			if ($FindDom->id_impdom == null){
				$FindDom->id_impdom=$fields['ID_DOM'];
				$FindDom->save();
			}
			if ($FindDom->id_house == 0)
			{
				$FindDom->id_house = $fields['ID_HOUSE'];
				$FindDom->save();
			}
			$FindTarifPlan = UtTarifplan::findOne(['id_dom' => $FindDom->id, 'period' => $GLOBALS["period"], 'id_tipposl' => $FindTipPosl->id]);
			if ($FindTarifPlan == null && $fields['PLAN']<>0) {
				$model = new UtTarifplan();
				$model->id_tipposl = $FindTipPosl->id;
				$model->id_vidpokaz = $FindTipPosl->id_vidpokaz;
				$model->id_dom = $FindDom->id;
				$model->period = $GLOBALS["period"];
				$model->tarifplan = $fields['PLAN'];
				$model->tariffact = $fields['FACT'];
				if ($model->validate()) {
					$model->save();
					$FindTarifPlan = $model;
					}
			}
			return true;
		}
		else {
			Flash($Base, null, 'нема будинку ' . trim(iconv('CP866','utf-8',$fields['UL'])) . ' ' . trim(iconv('CP866','utf-8',$fields['DOM'])));
		}
	}
	return true;
}

function importIN($dbf,$i,$Base)
{
    $fields = dbase_get_record_with_names($dbf, $i);
    if ($fields['deleted'] <> 1) {
        $FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
		if ($FindTipPosl==null)
		{
			Flash($Base,null,'нема послуги '.$fields['WID']);
		}
		$FindDom = UtDom::findOne(['id_impdom' => $fields['ID_DOM']]);
		if ($FindDom == null) {
			$FindUL = UtUlica::findOne(['id_impul' => $fields['ID_UL']]);
			if ($FindUL == null) {
					Flash($Base, null, 'нема вулиці ' . trim(iconv('CP866','utf-8',$fields['UL'])));
			}
			if ($FindUL != null)
				$FindDom = UtDom::findOne(['n_dom' => trim(iconv('CP866','utf-8',$fields['DOM'])),'id_ulica' => $FindUL->id]);
		}
            if ($FindDom <> null) {
                $FindTarifPlan = UtTarifplan::findOne(['id_dom' => $FindDom->id, 'period' => $GLOBALS["period"], 'id_tipposl' => $FindTipPosl->id]);
                if ($FindTarifPlan == null) {
                    Flash($Base, null, 'План не найден ' . trim(iconv('CP866','utf-8',$fields['UL'])) . ' ' . trim(iconv('CP866','utf-8',$fields['DOM'])));
                } else {
                    $FindTarifvid = UtTarifvid::findOne(['id_tipposl' => $FindTipPosl->id, 'code_servi' => $fields['CODE_SER']]);
                    if ($FindTarifvid == null) {
                        $Tarifvid = new UtTarifvid();
                        $Tarifvid->id_tipposl = $FindTipPosl->id;
                        $Tarifvid->name = trim(iconv('CP866', 'utf-8', $fields['NAME']));
						$Tarifvid->code_servi = $fields['CODE_SER'];
                        if ($Tarifvid->validate()) {
                            $Tarifvid->save();
                            $FindTarifvid = $Tarifvid;
                        }
                    }
                    $FindTarifinfo = UtTarifinfo::findOne(['id_tarifplan' => $FindTarifPlan->id, 'id_tarifvid' => $FindTarifvid->id]);

                    if ($FindTarifinfo == null) {
                        $Tarifinfo = new UtTarifinfo();
                        $Tarifinfo->id_tarifplan = $FindTarifPlan->id;
                        $Tarifinfo->id_tarifvid = $FindTarifvid->id;
                        $Tarifinfo->tarifplan = $fields['PLAN'];
                        $Tarifinfo->tariffact = $fields['FACT'];
                        if ($Tarifinfo->validate()) {
                            $Tarifinfo->save();
                            return true;
                        }
                    } else {
                        $FindTarifinfo->tarifplan = $fields['PLAN'];
                        $FindTarifinfo->tariffact = $fields['FACT'];
                        if ($FindTarifinfo->validate()) {
                            $FindTarifinfo->save();
                            return true;
                        }

                    }

                    return true;
                }

            } else
				Flash($Base, null, 'нема будинку ' . trim(iconv('CP866','utf-8',$fields['UL'])) . ' ' . trim(iconv('CP866','utf-8',$fields['DOM'])));

        }
        return true;
}

    function importNach($dbf, $i, $Base)
    {
        $fields = dbase_get_record_with_names($dbf, $i);
        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
            $lgot = encodestr(trim(iconv('CP866', 'utf-8', $fields['LGOTA'])));
            $FindAbon = UtAbonent::findOne(['schet' => $schet]);
            $FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
            if ($FindTipPosl <> null and $FindAbon <> null) {

				$FindPosl = UtPosl::findOne(['id_tipposl' => $FindTipPosl->id, 'id_abonent' => $FindAbon->id]);
				$FindLgot = UtVidlgot::findOne(['lgota' => $lgot]);
				if ($FindPosl <> null) {
					$narah = new UtNarah();

					$narah->id_org = 1;
					$narah->period = $GLOBALS["period"];
					$narah->id_abonent = $FindAbon->id;
					$narah->id_posl = $FindPosl->id;
					$narah->id_tipposl = $FindTipPosl->id;
					$narah->tipposl = $FindTipPosl->poslug;
					//				$narah->id_vidlgot = trim($fields['LGOTA']) <> '' ? UtVidlgot::findOne(['lgota' => encodestr(trim(iconv('CP866','utf-8',$fields['LGOTA'])))])->id : null;
					$narah->lgot = encodestr(trim(iconv('CP866', 'utf-8', $fields['LGOTA'])));
					$narah->tarif = $fields['TARIF'];
					$narah->id_vidpokaz = $fields['FL_SCH'] == -1 ? 13 : $FindTipPosl->id_vidpokaz;
					$narah->vidpokaz = UtVidpokaz::findOne(['id' => $narah->id_vidpokaz])->vid_pokaz;
					$narah->pokaznik = $fields['RAZN'];
					$narah->nnorma = $fields['FL_SCH'] == -1 ? $fields['RAZN'] : 0;
					//			$narah->pokaznik = UtPokaz::findOne(['id_abonent' => $narah->id_abonent,'id_vidpokaz' => $narah->id_vidpokaz ])->pokaznik;
					$narah->ed_izm = $FindTipPosl->ed_izm;
					$narah->sum = $fields['SUM'];


					if ($narah->validate()) {
						$narah->save();
						return true;
					} else
						Flash($Base, $narah, $schet . ' ' . $narah->tipposl);
					//					die("Error!!!  Insert is $dbf  to UtNarah $schet $FindTipPosl->poslug");
				}
			}
        }
        return true;

    }

    function importObor($dbf, $i, $Base)
    {
        $fields = dbase_get_record_with_names($dbf, $i);
        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
            $wid = trim($fields['WID']);
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
            if ($schet <> 0 or $schet <> null or $wid <> 0 or $wid <> null) {
                $posl = UtTipposl::findOne(['old_tipusl' => $wid]);
                $abon = UtAbonent::findOne(['schet' => $schet]);
                if ($abon <> null && $posl <> null) {
                    $findposl = UtPosl::findOne(['id_abonent' => $abon->id, 'id_tipposl' => $posl->id]);
                    if ($findposl == null) {
                        $abonposl = new UtPosl();
                        $abonposl->id_org = 1;
                        $abonposl->id_abonent = $abon->id;
                        $abonposl->id_tipposl = $posl->id;
                        $abonposl->n_dog = trim($fields['N_DOG']);
                        $abonposl->date_dog = trim($fields['D_DOG']) <> '' ? trim($fields['D_DOG']) : null;

                        if ($abonposl->validate() & $abonposl->save()) {
                            NewObor($abonposl, $fields);

                        } else {
                            Flash($Base, $abonposl, $schet);
//							die("Error!!! Insert to poslug $wid to abonent $schet");
                        }
                    } else {

                        $findposl->n_dog = trim($fields['N_DOG']);
                        $findposl->date_dog = trim($fields['D_DOG']) <> '' ? trim($fields['D_DOG']) : null;
                        $findposl->save();
                        NewObor($findposl, $fields);

                    }


                } else
                    Flash($Base, $abon, $posl);


            }


        }

        return true;


    }


    function NewObor($findposl, $fields)

    {
        $obor = new UtObor();

        $obor->id_org = 1;
        $obor->period = $GLOBALS["period"];
        $obor->id_abonent = $findposl->id_abonent;
        $obor->id_posl = $findposl->id;
        $obor->tipposl = $findposl->getTipposl()->asArray()->one()['poslug'];
        $obor->dolg = $fields['DOLG'];
        $obor->nach = $fields['NACH'];
        $obor->subs = $fields['SUBS'];
        $obor->opl = $fields['OPL'] + $fields['UDER'] + $fields['WZMZ'];
        $obor->pere = $fields['PERE'] + $fields['WOZW'];
        $obor->sal = $fields['SAL'];
        if ($obor->validate()) {
            $obor->save();
            return true;
        } else
            Flash('OBOR.DBF', $obor, $findposl->getAbonent()->asArray()->one()['schet'] . ' ' . $obor->tipposl);
        return true;
    }

    function importOPL($dbf, $i, $Base)

    {
        $fields = dbase_get_record_with_names($dbf, $i);

        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
            if ($schet <> 0 or $schet <> null) {


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

                $abon = UtAbonent::findOne(['schet' => $schet]);
                if ($abon <> null and $GLOBALS["period"] = date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . '01'))) {

                    foreach ($fields as $k => $v) {
                        if ($v <> 0) {
                            $tipposl = null;
                            switch ($k) {
                                case 'OPL_EL':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'el']);
                                    break;
                                case 'OPL_KV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'kv']);
                                    break;
                                case 'OPL_OM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'om']);
                                    break;
                                case 'OPL_OT':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'ot']);
                                    break;
                                case 'OPL_SM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'sm']);
                                    break;
                                case 'OPL_HV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'hv']);
                                    break;
								case 'OPL_UB':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'ub']);
									break;
								case 'OPL_SN':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'sn']);
									break;
                            }


                            if ($tipposl <> null) {
                                $findposl = UtPosl::findOne(['id_abonent' => $abon->id, 'id_tipposl' => $tipposl->id]);
                                if ($findposl == null) {
//								die("Error!!!  Not find is $dbf  to UtPosl $schet $k");

                                    Flash($Base, $findposl, 'По абоненту ' . $schet . ' не знайдено послуги ' . $k . ' ' . $tipposl->poslug .' '. date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . substr($fields['DT'], 6, 2))).' '.$v);
                                } else {
                                    NewOpl($findposl, $tipposl, $fields, $v);


                                }
                            }


                        }

                    }


                }
            }

        }

        return true;

    }

    function NewOpl($findposl, $tipposl, $fields, $v)

    {
        $narah = new UtOpl();

        $narah->id_org = 1;
        $narah->period = $GLOBALS["period"];
        $narah->id_abonent = $findposl->id_abonent;
        $narah->id_posl = $findposl->id;
        $narah->id_tipposl = $findposl->id_tipposl;
        $narah->tipposl = $tipposl->poslug;
        $narah->dt = date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . substr($fields['DT'], 6, 2)));
        $narah->pach = $fields['PACH'];
        $narah->sum = $v;
        $narah->note = trim($fields['NOTE']);


        if ($narah->validate()) {
            $narah->save();
            return true;
        } else
            Flash('OPL.DBF', $narah, $findposl->getAbonent()->asArray()->one()['schet'] . ' ' . $tipposl->tipposl);
        return true;
    }

    function importSUBS($dbf, $i, $Base)

    {
        $fields = dbase_get_record_with_names($dbf, $i);

        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
            if ($schet <> 0 or $schet <> null) {


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

                $abon = UtAbonent::findOne(['schet' => $schet]);
                if ($abon <> null) {

                    foreach ($fields as $k => $v) {
                        if ($v <> 0) {
                            $tipposl = null;
                            $sum = null;
                            $sum_ob = null;
                            switch ($k) {
                                case 'S_EL':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'el']);
//                                    $sum = UtObor::findOne(['old_tipusl' => 'el']);
                                    $sum_ob = $fields['OB_EL'];
                                    break;
                                case 'S_KV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'kv']);
//                                    $sum = $fields['S_KV'];
                                    $sum_ob = $fields['OB_KV'];
                                    break;
                                case 'S_OM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'om']);
//                                    $sum = $fields['S_OM'];
                                    $sum_ob = $fields['OB_OM'];
                                    break;
                                case 'S_OT':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'ot']);
//                                    $sum = $fields['S_OT'];
                                    $sum_ob = $fields['OB_OT'];
                                    break;
                                case 'S_SM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'sm']);
//                                    $sum = $fields['S_SM'];
                                    $sum_ob = $fields['OB_SM'];
                                    break;
                                case 'S_HV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'hv']);
//                                    $sum = $fields['S_HV'];
                                    $sum_ob = $fields['OB_HV'];
                                    break;
                            }


                            if ($tipposl <> null) {
                                $findposl = UtPosl::findOne(['id_abonent' => $abon->id, 'id_tipposl' => $tipposl->id]);
                                if ($findposl == null) {
                                    Flash($Base, $findposl, 'По абоненту ' . $schet . ' незнайдено послуги ' . $k . ' ' . $tipposl->poslug);
//									die("Error!!!  Not find is $dbf  to UtPosl $schet $k");
                                } else {
                                    NewSubs($findposl, $fields, $tipposl, $sum_ob);

                                }
                            }


                        }

                    }


                }
            }

        }

        return true;

    }

    function NewSubs($findposl, $fields, $tipposl, $sum_ob)

    {
        $narah = new UtSubs();

        $narah->id_org = 1;
        $narah->period = $GLOBALS["period"];
        $narah->id_abonent = $findposl->id_abonent;
        $narah->id_tipposl = $findposl->id_tipposl;
        $narah->tipposl = $tipposl->poslug;
        $narah->sum_ob = $sum_ob;
//		$oborsubs = UtObor::findOne(['id_abonent' => $findposl->id_abonent,'period'=> $GLOBALS["period"]]);
		$oborsubs = UtObor::find();
		$oborsubs->joinWith('posl')->where(['ut_posl.id_tipposl' => $findposl->id_tipposl,'ut_obor.id_abonent' => $findposl->id_abonent,'ut_obor.period'=> $GLOBALS["period"]]);
		$res = $oborsubs->one();
		if ($res<>null)
            $narah->sum = $res->subs;

        if ($narah->validate()) {
            $narah->save();
            return true;
        } else
            Flash('SUBS.DBF', $narah, $findposl->getAbonent()->asArray()->one()['schet'] . ' ' . $tipposl->tipposl);
        return false;
    }


    function importUDER($dbf, $i, $Base)

    {
        $fields = dbase_get_record_with_names($dbf, $i);

        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
            if ($schet <> 0 or $schet <> null) {


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

                $abon = UtAbonent::findOne(['schet' => $schet]);
                if ($abon <> null) {

                    foreach ($fields as $k => $v) {
                        if ($v <> 0) {
                            $tipposl = null;
                            $sum = null;
                            switch ($k) {
                                case 'SUM_EL':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'el']);
                                    $sum = $fields['SUM_EL'];
                                    break;
                                case 'SUM_KV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'kv']);
                                    $sum = $fields['SUM_KV'];
                                    break;
                                case 'SUM_OM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'om']);
                                    $sum = $fields['SUM_OM'];
                                    break;
                                case 'SUM_OT':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'ot']);
                                    $sum = $fields['SUM_OT'];
                                    break;
                                case 'SUM_SM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'sm']);
                                    $sum = $fields['SUM_SM'];
                                    break;
                                case 'SUM_HV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'hv']);
                                    $sum = $fields['SUM_HV'];
                                    break;
								case 'SUM_SN':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'sn']);
									$sum = $fields['SUM_SN'];
									break;
								case 'SUM_UB':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'ub']);
									$sum = $fields['SUM_UB'];
									break;
                            }


                            if ($tipposl <> null) {
                                $findposl = UtPosl::findOne(['id_abonent' => $abon->id, 'id_tipposl' => $tipposl->id]);
                                if ($findposl == null) {
                                    Flash($Base, $findposl, 'По абоненту ' . $schet . ' незнайдено послуги ' . $k . ' ' . $tipposl->poslug);
//									die("Error!!!  Not find is $dbf  to UtPosl $schet $k");
                                } else {
                                    NewUder($findposl, $fields, $tipposl, $sum);

                                }
                            }


                        }

                    }


                }
            }

        }

        return true;

    }

    function NewUder($findposl, $fields, $tipposl, $sum)

    {
        $utrim = new UtUtrim();

        $utrim->id_org = 1;
        $utrim->period = $GLOBALS["period"];
        $utrim->id_abonent = $findposl->id_abonent;
        $utrim->id_tipposl = $findposl->id_tipposl;
        $utrim->tipposl = $tipposl->poslug;
        $utrim->summa = $sum;

        if ($utrim->validate()) {
            $utrim->save();
            return true;
        } else
            Flash('UDER.DBF', $utrim, $findposl->getAbonent()->asArray()->one()['schet'] . ' ' . $tipposl->tipposl);
        return false;
    }


    //    $percent1 = 50;
//
//	echo 'percent1 '.$percent1;


    function encodestr($str)
    {
        $patterns[0] = "/H/";
        $patterns[1] = "/h/";
        $patterns[2] = "/C/";
        $patterns[3] = "/c/";
        $patterns[4] = "/I/";
        $patterns[5] = "/i/";

        $replacements[0] = "Н";
        $replacements[1] = "н";
        $replacements[2] = "С";
        $replacements[3] = "с";
        $replacements[4] = "І";
        $replacements[5] = "і";

        ksort($patterns);
        ksort($replacements);

        return preg_replace($patterns, $replacements, $str);

    }

    function Flash($Base, $Model, $str)
    {
        if ($Model <> null) {
            $errors = $Model->getErrors();
            foreach ($errors as $key => $err) {
                if (gettype($err) == 'array') {
                    foreach ($err as $er) {
                        Yii::$app->session->AddFlash('alert-danger', 'Помилка імпорту ' . $Base . ' ' . $Model->formName() . ' ' . $str . ' ' . $er . ' ' . $Model->getAttribute($key));
                    }
                } else
                    Yii::$app->session->AddFlash('alert-danger', 'Помилка імпорту ' . $Base . ' ' . $Model->formName() . ' ' . $str . ' ' . $err . ' ' . $Model->getAttribute($key));
            }
        } else
            Yii::$app->session->AddFlash('alert-danger', 'Помилка імпорту ' . $Base . ' ' . $str);


        return true;
    }

	function cleanDir($dir) {
		$files = glob($dir."/*");
		$c = count($files);
		if (count($files) > 0) {
			foreach ($files as $file) {
				if (file_exists($file)) {
					unlink($file);
				}
			}
		}
	}

//	function removeDirectory($dir) {
//		if ($objs = glob($dir."*")) {
//			foreach($objs as $obj) {
//				if (is_dir($obj))
//					rmdir($obj);
//				else
//					unlink($obj);
////				is_dir($obj) ? rmdir($obj) : unlink($obj);
//			}
//		}
//	}
?>

