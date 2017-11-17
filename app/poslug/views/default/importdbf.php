<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */

	use app\poslug\models\UtAbonent;
	use app\poslug\models\UtDom;
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
	use app\poslug\models\UtTipposl;
	use app\poslug\models\UtUlica;
	use app\poslug\models\UtVidlgot;
use app\poslug\models\UtVidpokaz;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
	use yii\bootstrap\Progress;
	use yii\helpers\Html;

	//	$_SESSION['RowsCount'] = $RowsCount;
//	$process = $_SESSION['process'];
	$_SESSION['Progress'] = $_SESSION['Progress'] + 1;
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
	$endbase = count($_SESSION['NameBase'])-1;



$t = true;

	while( $t) {
		$Base = $_SESSION['NameBase'][$nombase];
		if ($Base==null)
			break;
		$filename = $_SESSION['DirFiles'].'/'.$Base;
	    $dbf = @dbase_open($filename, 0) or die("Error!!!  Opening $filename");
	    @dbase_pack($dbf);
	     $rowsCount = dbase_numrecords($dbf);
		if ($_SESSION['Progress']==100 and $nombase==$endbase)
		{
			$process = $rowsCount-$nomrec;
		}
//	     $countRec = $rowsCount - $_SESSION['NomRec'];
//	     if ($countRec>$_SESSION['process'])
//		  $process=$_SESSION['NomRec']+$_SESSION['process'];
//	     else $process=$rowsCount;
		$functionname = 'import'.strstr($Base, '.', true);

		if (function_exists($functionname)) {

			for ($i = $start+1; $i <= $process; $i++)
			{
				$nomrec = $nomrec +1;
				if (!$functionname($dbf,$nomrec))
				      die("Error!!!  Return to false $functionname");

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




		}
	}

	$_SESSION['NomBase'] = $nombase;
	$_SESSION['NomRec'] = $nomrec;



function importUL($dbf,$i)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		$ulic = encodestr(trim(iconv('CP866','utf-8',$fields['UL'])));
		if (UtUlica::findOne(['ul' => $ulic])== null)
		{
			$ulic = encodestr(trim(iconv('CP866','utf-8',$fields['UL'])));

			$model = new UtUlica();
			$model->ul = $ulic;
			$model->kl = $fields['KL'];
			if ($model->validate() && $model->save())
			{
				return true;
			}
			else
			{
				die("Error!!!  Insert is $dbf  to UtUlica $ulic");
//				return false;
			}
		}
	}
	return true;
}

function importWIDS($dbf,$i)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		if (UtTipposl::findOne(['old_tipusl' => $fields['WID']])== null)
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
				die("Error!!!  Insert is $dbf  to UtTipposl $model->poslug");
//				return false;
			}

		}
	}
	return true;
}

function importORGAN($dbf,$i)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		if (UtRabota::findOne(['id_oldorg' => $fields['ORG']])== null )
		{

			$model = new UtRabota();
			$model->id_oldorg = $fields['ORG'];
			$model->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
			$model->id_org = 1;
			$model->fio_ruk = encodestr(trim(iconv('CP866','utf-8',$fields['RUK'])));
			if ($model->validate())
			{
				$model->save();
				return true;
			}
			else
			{
				die("Error!!!  Insert is $dbf  to UtRabota $model->name");
//			return false;
			}

		}
	}
	return true;
}

function importKART($dbf,$i)
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

					if (importAbon($fields,$schet,$modelKt->id))
					   return true;
					else
						die("Error!!!  Insert is $dbf  to UtAbonent $schet");

				}
				else
				{
					die("Error!!!  Insert is $dbf  to UtKart $schet $modelKt->fio $Abon");
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
							return true;
						}
						else
							die("Error!!!  Edit id_kart is $dbf  to UtAbonent $Abon->schet");

					}
					else
					{

						die("Error!!! Insert is $dbf  to UtKart $schet $modelKt->fio $Abon->schet");

					}



				}
				importPokaz($fields,$Abon);
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
		$ulica = encodestr(trim(iconv('CP866','utf-8',$fields['ULNAIM'])));
		$FindUl = UtUlica::findOne(['ul' => $ulica]);
		if ($FindUl <> null)
		{
			$modelKt->id_ulica = $FindUl->id;
		}
		else
		{
			if (trim($ulica)<>'')
			{
				$ul = new UtUlica();
				$ul->ul = $ulica;
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
		$modelKt->privat = trim($fields['PRIV']) == 'p' ? 1 : null;
		$modelKt->ur_fiz = 0;
		$modelKt->telef = encodestr(trim(iconv('CP866','utf-8',$fields['TELEF'])));

		return $modelKt;

	}


function importAbon($fields,$schet,$idkart)
{
	$modelAb = new UtAbonent();
	$modelAb->id_org = 1;
	$modelAb->schet = $schet;
	$modelAb->id_kart =  $idkart;
	$modelAb->note = encodestr(trim(iconv('CP866','utf-8',$fields['NOTE']).' '.iconv('CP866','utf-8',$fields['NOTE1'])));

	if ($modelAb->validate())
	{
		$modelAb->save();
		if (importPokaz($fields,$modelAb))
		return true;
	}
	else
	{
		die("Error!!!  Insert is UtAbonent $schet $idkart ");
	}

	return true;

}

function importPokaz($fields,$idabon)
{
	$array = ['KOLI_PF' => 12,'KOLI_P' => 5,'KOLI_K' => 4,'PLOS_BB' => 3,'PLOS_OB' => 2];

	foreach ($array as $k => $v)
	{
		$FindPF = UtPokaz::findOne(['id_abonent' => $idabon->id,'id_vidpokaz' => $v]);
		if ($FindPF == null)
		{
			$model = new UtPokaz();
			$model->id_vidpokaz = $v;
			$model->id_abonent = $idabon->id;
			$model->id_org = 1;
			$model->pokaznik = $fields[$k];
			if ($model->validate())
			{
				$model->save();
			}
			else
				die("Error!!!  Insert to UtPokaz $idabon->schet $model->pokaznik");

		}
	}

    return true;
}

function importNTARIF($dbf,$i)
{
	$fields = dbase_get_record_with_names($dbf,$i);
	if ($fields['deleted'] <> 1)
	{
		if (UtTarif::findOne(['kl' => $fields['KL']])== null)
		{

			$model = new UtTarif();
			$Find = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
			if ($Find <> null)
			{
				$model->id_tipposl = $Find->id;
				$model->id_vidpokaz = $Find->id_vidpokaz;
			}

			$model->kl = $fields['KL'];
			$model->tarif1 = $fields['TARIF'];
			$model->id_org = 1;
			$model->name = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
			if ($model->validate())
			{
				$model->save();
				return true;
			}
			else
			{
				die("Error!!!  Insert is $dbf  to UtTarif $model->name");
//			return false;
			}

		}
	}
	return true;
}

	function importPOSLTAR($dbf,$i)
	{
		$fields = dbase_get_record_with_names($dbf,$i);
		if ($fields['deleted'] <> 1)
		{
			$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));

			$FindAbon =  UtAbonent::findOne(['schet' => $schet]);
			$FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
			if ($FindTipPosl<> null and $FindAbon <> null)
			{
				$FindTarifab = UtTarifab::findOne(['id_tipposl' => $FindTipPosl->id,'id_abonent' => $FindAbon->id]);
				if ($FindTarifab == null)
				{
					$model = new UtTarifab();
					$model->id_org = 1;
					$model->id_tipposl = $FindTipPosl->id;
					$model->id_abonent = $FindAbon->id;
					$model->nametarif = encodestr(trim(iconv('CP866','utf-8',$fields['NAME'])));
					$model->tarif = $fields['TARIF'];
					$model->kortarif = $fields['KORTARIF'];
					$model->endtarif = $fields['ENDTARIF'];
					$model->days = $fields['DAYS'];
					if ($model->validate())
					{
						$model->save();
						return true;
					}
					else
					{
						die("Error!!!  Insert is $dbf  to UtTarifab $schet $FindAbon->schet");
//			return false;
					}
				}


			}
			else
				return true;

		}
		return true;
	}

	 function importNach($dbf,$i)
	{
		$fields = dbase_get_record_with_names($dbf,$i);
		if ($fields['deleted'] <> 1)
		{
			$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
			$lgot = encodestr(trim(iconv('CP866','utf-8',$fields['LGOTA'])));
			$FindAbon =  UtAbonent::findOne(['schet' => $schet]);
			$FindTipPosl = UtTipposl::findOne(['old_tipusl' => $fields['WID']]);
			if ($FindTipPosl<>null and $FindAbon<>null)
			    $FindPosl = UtPosl::findOne(['id_tipposl' => $FindTipPosl->id,'id_abonent' => $FindAbon->id]);
			$FindLgot = UtVidlgot::findOne(['lgota' => $lgot]);
			if ($FindAbon <> null)
			{
				$narah = new UtNarah();

				$narah->id_org = 1;
				$narah->period = $_SESSION['PeriodBase'];
				$narah->id_abonent = $FindAbon->id;
				$narah->id_posl = $FindPosl->id;
				$narah->id_tipposl = $FindTipPosl->id;
				$narah->tipposl = $FindTipPosl->poslug;
				$narah->id_vidlgot = trim($fields['LGOTA']) <> '' ? UtVidlgot::findOne(['lgota' => encodestr(trim(iconv('CP866','utf-8',$fields['LGOTA'])))])->id : null;
				$narah->lgot = encodestr(trim(iconv('CP866','utf-8',$fields['LGOTA'])));
				$narah->tarif = $fields['TARIF'];
				$narah->id_vidpokaz = $fields['FL_SCH'] == -1 ? 13 : $FindTipPosl->id_vidpokaz;
				$narah->vidpokaz = UtVidpokaz::findOne(['id' => $narah->id_vidpokaz])->vid_pokaz;
				$narah->pokaznik = $fields['RAZN'];
				$narah->nnorma = $fields['FL_SCH'] == -1 ? $fields['RAZN'] : 0;
//			$narah->pokaznik = UtPokaz::findOne(['id_abonent' => $narah->id_abonent,'id_vidpokaz' => $narah->id_vidpokaz ])->pokaznik;
				$narah->ed_izm = $FindTipPosl->ed_izm;
				$narah->sum = $fields['SUM'];



				if ($narah->validate())
				{
					$narah->save();
					return true;
				}
				else
					die("Error!!!  Insert is $dbf  to UtNarah $schet $FindTipPosl->poslug");
			}
		}
		return true;

	}

	function importObor($dbf,$i)
	{
		$fields = dbase_get_record_with_names($dbf,$i);
		if ($fields['deleted'] <> 1)
		{
			$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
			$wid = trim($fields['WID']);
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
			if ($schet<>0 or $schet<>null or $wid<>0 or $wid<>null)
			{
				$posl = UtTipposl::findOne(['old_tipusl' => $wid]);
				$abon = UtAbonent::findOne(['schet' => $schet]);
				if ($abon <> null)
				{
					$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $posl->id ]);
					if ($findposl==null)
					{
						$abonposl= new UtPosl();
						$abonposl->id_org = 1;
						$abonposl->id_abonent=$abon->id;
						$abonposl->id_tipposl= $posl->id;
						$abonposl->n_dog = trim($fields['N_DOG']);
						$abonposl->date_dog = trim($fields['D_DOG'])<>'' ? date('Y-m-d',strtotime(trim($fields['D_DOG']))) : null;

						if ($abonposl->validate() & $abonposl->save())
						{
//									$abonposl->save();
							if (NewObor($abonposl,$fields))
								return true;
							else
								die("Error!!!  Insert is $dbf  to UtObor $schet $wid");


						}
						else
						{
							die("Error!!! Insert to poslug $wid to abonent $schet");
						}
					}
					else
					{
						if (NewObor($findposl,$fields))
							return true;
						else
							die("Error!!!  Insert is $dbf  to UtObor $schet $wid");
					}




				}


			}


		}

		return true;


	}



	function NewObor($findposl,$fields)

{
	$obor = new UtObor();

	$obor->id_org = 1;
	$obor->period = $_SESSION['PeriodBase'];
	$obor->id_abonent = $findposl->id_abonent;
	$obor->id_posl = $findposl->id;
	$obor->tipposl = $findposl->getTipposl()->asArray()->one()['poslug'];
	$obor->dolg = $fields['DOLG'];
	$obor->nach = $fields['NACH'];
	$obor->subs = $fields['SUBS'];
	$obor->opl = $fields['OPL']+$fields['UDER']+$fields['WZMZ'];
	$obor->pere = $fields['PERE']+$fields['WOZW'];
	$obor->sal = $fields['SAL'];
	if ($obor->validate())
	{
		$obor->save();
		return true;
	}
	else
		return false;
}

	function importOPL($dbf,$i)

{
	$fields = dbase_get_record_with_names($dbf,$i);

	if ($fields['deleted'] <> 1)
	{
		$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
		if ($schet<>0 or $schet<>null)
		{


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

			$abon = UtAbonent::findOne(['schet' => $schet]);
			if ($abon <> null )
			{

				foreach ($fields as $k => $v )
				{
					if ($v<>0)
					{
						$tipposl= null;
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
						}


						if ($tipposl<> null)
						{
							$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id]);
							if ($findposl==null)
							{
//								die("Error!!!  Not find is $dbf  to UtPosl $schet $k");
								Alert::begin(['options' => ['class' => 'alert-danger'],]);
								echo "Not find is UtPosl: '$schet $k'\n";
								Alert::end();
							}
							else
							{
								if (NewOpl($findposl,$tipposl,$fields,$v))
									return true;
								else
									die("Error!!!  Insert is $dbf  to UtOpl $schet $k");
							}
						}



					}

				}



			}
		}

	}

	return true;

}

	function NewOpl($findposl,$tipposl,$fields,$v)

{
	$narah = new UtOpl();

	$narah->id_org = 1;
	$narah->period = $_SESSION['PeriodBase'];
	$narah->id_abonent = $findposl->id_abonent;
	$narah->id_posl = $findposl->id;
	$narah->id_tipposl = $findposl->id_tipposl;
	$narah->tipposl = $tipposl->poslug;
	$narah->dt = date('Y-m-d',strtotime(substr($fields['DT'],0,4).'-'.substr($fields['DT'],4,2).'-'.substr($fields['DT'],6,2)));
	$narah->pach = $fields['PACH'];
	$narah->sum = $v;
	$narah->note = trim($fields['NOTE']);




	if ($narah->validate())
	{
		$narah->save();
		return true;
	}
	else return false;
}

	function importSUBS($dbf,$i)

	{
		$fields = dbase_get_record_with_names($dbf,$i);

		if ($fields['deleted'] <> 1)
		{
			$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
			if ($schet<>0 or $schet<>null)
			{


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

				$abon = UtAbonent::findOne(['schet' => $schet]);
				if ($abon <> null )
				{

					foreach ($fields as $k => $v )
					{
						if ($v<>0)
						{
							$tipposl= null;
							$sum = null;
							$sum_ob = null;
							switch ($k) {
								case 'S_EL':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'el']);
									$sum = $fields['S_EL'];
									$sum_ob = $fields['OB_EL'];
									break;
								case 'S_KV':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'kv']);
									$sum = $fields['S_KV'];
									$sum_ob = $fields['OB_KV'];
									break;
								case 'S_OM':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'om']);
									$sum = $fields['S_OM'];
									$sum_ob = $fields['OB_OM'];
									break;
								case 'S_OT':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'ot']);
									$sum = $fields['S_OT'];
									$sum_ob = $fields['OB_OT'];
									break;
								case 'S_SM':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'sm']);
									$sum = $fields['S_SM'];
									$sum_ob = $fields['OB_SM'];
									break;
								case 'S_HV':
									$tipposl = UtTipposl::findOne(['old_tipusl' => 'hv']);
									$sum = $fields['S_HV'];
									$sum_ob = $fields['OB_HV'];
									break;
							}


							if ($tipposl<> null)
							{
								$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id]);
								if ($findposl==null)
								{
									die("Error!!!  Not find is $dbf  to UtPosl $schet $k");
								}
								else
								{
									if (NewSubs($findposl,$fields,$tipposl,$sum,$sum_ob))
										return true;
									else
										die("Error!!!  Insert is $dbf  to UtSubs $schet $k");
								}
							}



						}

					}



				}
			}

		}

		return true;

	}

	function NewSubs($findposl,$fields,$tipposl,$sum,$sum_ob)

	{
		$narah = new UtSubs();

		$narah->id_org = 1;
		$narah->period = $_SESSION['PeriodBase'];
		$narah->id_abonent = $findposl->id_abonent;
		$narah->id_tipposl = $findposl->id_tipposl;
		$narah->tipposl = $tipposl->poslug;
	    $narah->sum_ob = $sum_ob;
		$narah->sum = $sum;

		if ($narah->validate())
		{
			$narah->save();
			return true;
		}
		else return false;
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

?>








