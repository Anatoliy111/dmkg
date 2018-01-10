<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:46
	 */

	namespace app\poslug\models;

	use Yii;
	use yii\base\Model;
	use yii\web\UploadedFile;
	use yii\bootstrap\Alert;
    use ZipArchive;

    class UploadForm  extends Model
	{
		/**
		 * @var UploadedFile
		 */
		public static $UPLOADS_DIR = 'uploads/dbf';

		public $dbf;
		public $fields;
		public $File;
		public $Files;
		public $MonthYear;
		public $DateMonthYear;
		public $percent=0;
		public $title = 'Завантаження';
		public $progress;

		private $handler = false;

		public function rules()
		{
			return [
//				[['Files'], 'file', 'maxFiles' => 100],
				[['File'], 'file','skipOnEmpty' => false, 'extensions' => 'ZIP'],
				[['File'],'validateNameFile1'],
//				[['Files'], 'file', 'extensions' => 'DBF, dbf'],
//			    [['File','MonthYear'], 'required'],
//				[['MonthYear'], 'required'],
//				[['File'], 'file', 'extensions' => 'zip'],
//				[['MonthYear'], 'date', 'format' => 'mm-yyyy' ],
//				[['DateMonthYear'], 'date', 'format' => 'dd-mm-yyyy' ],
//				[['percent'], 'integer'],
			];
		}

		public function attributeLabels()
		{
			return [
				'File' => 'Архів з даними',
				'Files' => 'Виберіть файли для завантаження',
				'MonthYear' => 'Місяць завантаження даних',
			];
		}

        /**
         * @return bool
         */

		public function validateNameFile1()
		{
			if (strlen($this->File->baseName)<>6)
			{
				$errorMsg= 'Ви вибрали неправильний архів';
				$this->addError('File',$errorMsg);
			}
		}


        public function uploadFile()
		{
			if ($this->File && $this->validate()) {

				$uploadPath = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;

				$this->File->saveAs($uploadPath . $this->File->baseName . '.' . $this->File->extension);
				Yii::$app->session->setFlash($this->File->name, "Завантажено файл - ".$this->File->name."");

//                $this->ImportDbf($this->File);

				return true;
			} else {
				return false;
			}
		}

		public function uploadFiles()
		{
			if ($this->validate()) {
				$this->percent = 0;
				$pers = (100/count($this->Files));
				foreach ($this->Files as $file) {
					if ($file->extension == "dbf")
					{
						$file->saveAs('uploads/DBF/' . $file->baseName . '.' . $file->extension);
						Yii::$app->session->setFlash($file->name, "Завантажено файл - ".$file->name."");



					}
					else Yii::$app->session->setFlash($file->baseName, 'Файл '.$file->name.' не DBF',true);
//					$file->saveAs('uploads/DBF/' . $file->baseName . '.' . $file->extension);
				}
				Yii::$app->session->setFlash('success', 'Завантаження виконано!',true);
				return true;
			} else {
				return false;
			}


		}

		public function IntProgress($percent)
		{
			$this->percent = $this->percent+1;

				return $this->percent;

		}

		public function UnZIP($filename)
		{
			$zip = new ZipArchive;
			$uploadPath = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
			if ($zip->open($uploadPath.$filename) === TRUE) {
				$zip->extractTo($uploadPath.$filename->baseName);
				$zip->close();
//					Yii::$app->session->setFlash('success', 'Завантаження виконано!',true);
				Alert::begin(['options' => ['class' => 'alert-success'],]);


				echo "Завантаження виконано: '$filename'.'$zip->filename'\n";

				Alert::end();
				$this->MonthYear = date('Y-m-d',strtotime(substr($filename->baseName,0,4).'-'.substr($filename->baseName,4,2).'-01'));
				$_SESSION['DirFiles'] = $uploadPath.$filename->baseName;
				$_SESSION['PeriodBase'] = $this->MonthYear;
				return true;

			} else {
				Yii::$app->session->setFlash($this->File->name, "Не вдалося відкрити файл:".$uploadPath.$this->File->name." ".$uploadPath.$filename."--- ".$zip->filename);
//                    echo 'ошибка';
//				Alert::begin(['options' => ['class' => 'alert-danger'],]);
//				echo "Не вдалося відкрити файл: '$filename'\n";
//				Alert::end();
				return false;
			}

		}

		/**
		 * @param $UnPath
		 * @param $ImpFile
		 *
		 *
		 */





		public function Importolddomulica($UnPath)

		{

					$filename = $UnPath.'/'.'DOM.DBF';


					$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
					@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
					$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
					for ($i = 1; $i < $rowsCount; $i++)
					{
						$fields = dbase_get_record_with_names($dbf,$i);
						if ($fields['deleted'] <> 1)
						{
							$dom = trim(iconv('CP866','utf-8',$fields['DOM']));
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
							if (UtOlddom::findOne(['dom' => $dom])== null)
							{
								$modelOlddom = new UtOlddom();
								$ulic = trim(iconv('CP866','utf-8',$fields['UL']));
								$findul = UtOlddom::findOne(['ul' => $ulic]);
								if ($findul == null)
								{
									$colstr=strpos($ulic, " ");
									$str=substr($ulic, 0, $colstr);
									if (($str == "вул") or ($str == "вул.") or ($str == "вул.8") or ($str == "вул.I.") or ($str == "вул.Л.") or ($str == "вул.О") or ($str == "
пров") or ($str == "вул.Ольг.") or ($str == "вул.С.Горячка-") or ($str == "8") or ($str == "вул.Сонячна-") or ($str == "пров.Братiв") or ($str == "пров.") or ($str == "вул.О.") or ($str == "пров.Є.Коновальця-пров.") or ($str == "вул.i.") or ($str == "вул.Соборностi"))
									{
//										$strlen=($str);
										$ulic=substr_replace($ulic, '', $colstr, 1);
										$colstr=strpos($ulic, " ");
										$str=substr($ulic, 0, $colstr);
										if (($str == "пров.8") or ($str == "вул.Затишна-") or ($str == "вул.i."))
										{
											$ulic=substr_replace($ulic, '', $colstr, 1);
											$colstr=strpos($ulic, " ");
										}
									}
									$row = !$colstr ? $ulic : substr($ulic, 0, $colstr);
									$id_ul = UtUlica::findOne(['ul' => $row]);
									if ($id_ul== null)
									{
										if ($row == "")
										{
											$modelOlddom->id_ul = 1;
										}
										else
										{
											$modelUlica = new UtUlica();
											$modelUlica->ul = $row;
											$modelUlica->save();
											$modelOlddom->id_ul = $modelUlica->id;
										}

									}
									else
									{
										$modelOlddom->id_ul = $id_ul->id;
									}
								}
								else
								{
									$modelOlddom->id_ul = $findul->id_ul;
								}


								$modelOlddom->dom = $dom;
								$modelOlddom->ndom = trim($fields['NDOM']);
								$modelOlddom->real_dom = trim($fields['NDOM']);
								$modelOlddom->ul = $ulic;
								$modelOlddom->pod = $fields['POD'];
								$modelOlddom->rajon = trim(iconv('CP866','utf-8',$fields['RAJON']));
								if ($modelOlddom->validate())
								{
									$modelOlddom->save();
								}
								else
								{
									Alert::begin(['options' => ['class' => 'alert-danger'],]);
									echo "Не вдалося записати DOM: '$modelOlddom->dom'\n";
									Alert::end();
								}


							}
						}

//						foreach ($dbfarray[$i] as &$field)
//						{
//
//							if (is_string ($field))
//							{
//								$name = iconv('CP866','utf-8',$field);
//								$field = $name;
//							}
//							unset($field);
//							$this->percent = $this->percent + 1;
//						}
//						$dbfarray[$i];
//					$dbfarray[$i] = dbase_get_record_with_names($dbf,$i);
//					$name = iconv('CP866','utf-8',$dbfarray[$i]['UL']);
//					$dbfarray[$i]['UL'] = $name;

					}
		}

		public function Importoldkart($UnPath)

		{

			$filename = $UnPath.'/'.'KART.DBF';

			$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
			@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
			$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
			for ($i = 1; $i < $rowsCount; $i++)
			{
				$fields = dbase_get_record_with_names($dbf,$i);
				if ($fields['deleted'] <> 1)
				{
					$schet = trim($fields['SCHET']);
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
					if (UtOldkart::findOne(['schet' => $schet])== null)
					{
						$modelOldkart = new UtOldkart();
							$modelOldkart->schet = trim($fields['SCHET']);
							$modelOldkart->fio = trim(iconv('CP866','utf-8',$fields['FIO']));
							$modelOldkart->im = trim(iconv('CP866','utf-8',$fields['IM']));
							$modelOldkart->ot = trim(iconv('CP866','utf-8',$fields['OT']));
							$modelOldkart->idcod = trim($fields['IDCOD']);
							$modelOldkart->koli_lg = trim($fields['KOLI_LG']);
							$modelOldkart->koli_p = $fields['KOLI_P'];
							$modelOldkart->koli_pf = $fields['KOLI_PF'];
							$modelOldkart->koli_k = $fields['KOLI_K'];
							$modelOldkart->plos_bb = $fields['PLOS_BB'];
							$modelOldkart->plos_ob = $fields['PLOS_OB'];
							$modelOldkart->priv = trim(iconv('CP866','utf-8',$fields['PRIV']));
							$modelOldkart->etag = $fields['ETAG'];
						$modelOldkart->org = $fields['ORG'];
						$modelOldkart->note = trim(iconv('CP866','utf-8',$fields['NOTE']).' '.iconv('CP866','utf-8',$fields['NOTE1']));
						if ($modelOldkart->validate())
						{
							$modelOldkart->save();

						}
						else
						{
							Alert::begin(['options' => ['class' => 'alert-danger'],]);
							echo "Не вдалося записати SCHET: '$modelOldkart->schet'\n";
							Alert::end();
						}


					}
				}
			}

		}

		public function Importoldorg($UnPath)

		{
			$filename = $UnPath.'/'.'ORGAN.DBF';

			$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
			@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
			$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
			for ($i = 1; $i < $rowsCount; $i++)
			{
				$fields = dbase_get_record_with_names($dbf,$i);
				if ($fields['deleted'] <> 1)
				{
					$org = $fields['ORG'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
					if ($org<>0 or $org<>null)
					{
						if (UtOldorg::findOne(['org' => $org])== null)
						{
							$modelOldorg= new UtOldorg();
							$modelOldorg->org = $fields['ORG'];
							$modelOldorg->name = trim(iconv('CP866','utf-8',$fields['NAME']));
							$modelOldorg->ruk = trim(iconv('CP866','utf-8',$fields['RUK']));


							if ($modelOldorg->validate())
							{
								$modelOldorg->save();
							}
							else
							{
								Alert::begin(['options' => ['class' => 'alert-danger'],]);
								echo "Не вдалося записати ORG: '$modelOldorg->name'\n";
								Alert::end();
							}


						}
					}

				}
			}

		}

		public function ImportObor($UnPath)

		{
//			$obor = UtObor::findAll(['period' => $this->MonthYear]);
			UtObor::deleteAll('period = :period', [':period' => $this->MonthYear]);
//			if ($obor <> null)
//			{
//				$obor->delete();
//			}
			$filename = $UnPath.'/'.'OBOR.DBF';

			$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
			@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
			$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
			for ($i = 1; $i < $rowsCount; $i++)
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
						if ($abon <> null and $posl<>null)
						{
							$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $posl->id ]);
							if ($findposl==null)
							{
								$abonposl= new UtPosl();
								$abonposl->id_org = 1;
								$abonposl->id_abonent=$abon->id;
								$abonposl->period = $this->MonthYear;
								$abonposl->id_tipposl= $posl->id;
								$abonposl->n_dog = trim($fields['N_DOG']);
								$abonposl->date_dog = date('Y-m-d',strtotime(trim($fields['D_DOG'])));
//							$abonposl->nnorma =
//							$abonposl->flag_dom =
//							$abonposl->id_dom =
								$abonposl->activ = 1;


								if ($abonposl->validate() & $abonposl->save())
								{
//									$abonposl->save();
									$this->NewObor($abonposl,$fields);

								}
								else
								{
									Alert::begin(['options' => ['class' => 'alert-danger'],]);
									echo "Не вдалося записати UtPosl: '$abonposl->id'\n";
									Alert::end();
								}
							}
							else
							{
								$this->NewObor($findposl,$fields);
							}

						}
					}

				}
			}


		}

		public function ImportNach($UnPath)

		{
//			$obor = UtObor::findAll(['period' => $this->MonthYear]);
			UtNarah::deleteAll('period = :period', [':period' => $this->MonthYear]);
//			if ($obor <> null)
//			{
//				$obor->delete();
//			}
			$filename = $UnPath.'/'.'NACH.DBF';

			$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
			@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
			$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
			for ($i = 1; $i < $rowsCount; $i++)
			{
				$fields = dbase_get_record_with_names($dbf,$i);
				if ($fields['deleted'] <> 1)
				{
					$schet = trim(iconv('CP866','utf-8',$fields['SCHET']));
					$wid = trim($fields['WID']);
					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
					if ($schet<>0 or $schet<>null or $wid<>0 or $wid<>null or $sum<>0 or $sum<>null)
					{
						$tipposl = ($fields['FL_SCH'] == -1 and $wid=='hv') ? UtTipposl::findOne(['old_tipusl' => 'hvn']) : UtTipposl::findOne(['old_tipusl' => $wid]);
						$abon = UtAbonent::findOne(['schet' => $schet]);
						if ($abon <> null and $tipposl<>null)
						{
							$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id ]);
							if ($findposl==null)
							{
								$abonposl= new UtPosl();
								$abonposl->id_org = 1;
								$abonposl->id_abonent=$abon->id;
								$abonposl->period = $this->MonthYear;
								$abonposl->id_tipposl= $tipposl->id;
//							$abonposl->nnorma =
//							$abonposl->flag_dom =
//							$abonposl->id_dom =
								$abonposl->activ = 1;


								if ($abonposl->validate() & $abonposl->save())
								{
//									$abonposl->save();
									$this->NewNach($abonposl,$fields,$tipposl);

								}
								else
								{
									Alert::begin(['options' => ['class' => 'alert-danger'],]);
									echo "Не вдалося записати UtPosl: '$abonposl->id'\n";
									Alert::end();
								}
							}
							else
							{
								$this->NewNach($findposl,$fields,$tipposl);
							}

						}
					}

				}
			}


		}

		public function ImportOpl($UnPath)

		{
//			$obor = UtObor::findAll(['period' => $this->MonthYear]);
			UtOpl::deleteAll('period = :period', [':period' => $this->MonthYear]);
//			if ($obor <> null)
//			{
//				$obor->delete();
//			}
			$filename = $UnPath.'/'.'OPL.DBF';

			$dbf = @dbase_open($filename, 0) or die("Error opening $filename");
			@dbase_pack($dbf);
//					$fields = dbase_get_record_with_names($dbf,50);
//					$fields1 = dbase_get_record($dbf,50);
			$rowsCount = dbase_numrecords($dbf);
//					$dbfarray = array();
			for ($i = 1; $i < $rowsCount; $i++)
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
											$findposl1 = $tipposl<> null ? UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id ]) : null;
											if ($findposl1==null)
											{
												$tipposl = UtTipposl::findOne(['old_tipusl' => 'hvn']);
												$findposl2 = $tipposl<> null ? UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id ]) : null;
												$tipposl = $findposl2==null ? UtTipposl::findOne(['old_tipusl' => 'hv']) : $tipposl;
											}
											break;
									}


									if ($tipposl<> null)
									{
										$findposl = UtPosl::findOne(['id_abonent' => $abon->id,'id_tipposl' => $tipposl->id ]);
										if ($findposl==null)
										{
											$abonposl= new UtPosl();
											$abonposl->id_org = 1;
											$abonposl->id_abonent=$abon->id;
											$abonposl->period = $this->MonthYear;
											$abonposl->id_tipposl= $tipposl->id;
//								$abonposl->n_dog = trim($fields['N_DOG']);
//								$abonposl->date_dog = date('Y-m-d',strtotime(trim($fields['D_DOG'])));
//							$abonposl->nnorma =
//							$abonposl->flag_dom =
//							$abonposl->id_dom =
											$abonposl->activ = 1;


											if ($abonposl->validate() & $abonposl->save())
											{
//									$abonposl->save();
												$this->NewOpl($abonposl,$fields,$v);

											}
											else
											{
												Alert::begin(['options' => ['class' => 'alert-danger'],]);
												echo "Не вдалося записати UtPosl: '$abonposl->id'\n";
												Alert::end();
											}
										}
										else
										{
											$this->NewOpl($findposl,$fields,$v);
										}
									}



								}

							}



						}
					}

				}
			}


		}
		public function UpdateAbonentKart()

		{



			$oldkarts = UtOldkart::find()->all();
			foreach ($oldkarts as $kart)
			{
				if (UtAbonent::findOne(['schet' => $kart->schet])== null)
				{
					$UtAbonent = new UtAbonent();

					$UtAbonent->id_org = 1;
					$UtAbonent->schet = $kart->schet;
					$UtAbonent->fio = $kart->fio.' '.$kart->im.' '.$kart->ot;
					$schet = $kart->schet;
					$id = $kart->id;
//					$UtAbonent->id_kart = function($kart)
//					{
					$FindKart = UtKart::findOne(['id_oldkart' => $kart->id]);
					if ($FindKart == null)
					{
						$NewKart = new UtKart();
						$NewKart->name_f =$kart->fio;
						$NewKart->name_i =$kart->im;
						$NewKart->name_o =$kart->ot;
						$NewKart->fio = $kart->fio.' '.$kart->im.' '.$kart->ot;
						$NewKart->idcod = $kart->idcod;
						$FindDom = UtOlddom::findOne(['dom' => substr($kart->schet, 0, 4)]);
						if ($FindDom <> null)
						{
							$NewKart->id_ulica = $FindDom->id_ul;
							$NewKart->dom = $FindDom->real_dom;
//									$NewKart->korp = $FindDom->id_ul
							$NewKart->kv = (int)(substr($kart->schet, 4, 3));
						}
						else
						{
							Alert::begin(['options' => ['class' => 'alert-danger'],]);
							echo "Адрес не знайдено по рахунку : '$kart->schet'\n";
							Alert::end();

						}
//							$NewKart->ur_fiz = 0

						$NewKart->pass = $kart->schet;
//							$NewKart->telef = Y
						$NewKart->id_oldkart = $kart->id;
						if ($NewKart->validate())
						{
							$NewKart->save();
							$UtAbonent->id_kart = $NewKart->id;
						}
						else
						{
							Alert::begin(['options' => ['class' => 'alert-danger'],]);
							echo "Не вдалося записати картка: $kart->schet'\n";
							Alert::end();
//								isset($NewKart);
//								$NewKart->unlink();
						}

					}
					else $UtAbonent->id_kart = $FindKart->id;
//					};
//					$UtAbonent->id_rabota =
					if ($kart->org <> 0 or $kart->org <> null)
					{
						$FindOrg = UtOldorg::findOne(['org' => $kart->org]);
						if ($FindOrg <> null)
						{
							$FindOrg2 = UtRabota::findOne(['id_oldorg' => $FindOrg->id]);
							if ($FindOrg2 <> null)
								$UtAbonent->id_rabota = $FindOrg2->id;
							else
							{
								$Rabota = new UtRabota();
								$Rabota->name = $FindOrg->name;
								$Rabota->fio_ruk = $FindOrg->ruk;
								$Rabota->id_oldorg = $FindOrg->id;
								if ($Rabota->validate())
								{
									$Rabota->save();
									$UtAbonent->id_rabota = $Rabota->id;
								}
								else
								{
									Alert::begin(['options' => ['class' => 'alert-danger'],]);
									echo "Не вдалося записати работа: '$Rabota->name'\n";
									Alert::end();
								}

							}
						}
					}


					$UtAbonent->note = $kart->note;
//					$UtAbonent->ur_fiz =>
//					$UtAbonent->id_dom =>
					$UtAbonent->privat = $kart->priv = 'p' ? 1 : 0;
					$UtAbonent->id_oldkart = $kart->id;
//					$UtAbonent->save();
					if ($UtAbonent->validate())
					{
						$UtAbonent->save();
					}
					else
					{
						Alert::begin(['options' => ['class' => 'alert-danger'],]);
						echo "Не вдалося записати абонента: '$UtAbonent->schet'\n";
						Alert::end();
					}
				}
			}

		}

		public function NewObor($findposl,$fields)

		{
			$obor = new UtObor();

				$obor->id_org = 1;
				$obor->period = $this->MonthYear;
				$obor->id_abonent = $findposl->id_abonent;
				$obor->id_posl = $findposl->id;
				$obor->dolg = $fields['DOLG'];
				$obor->nach = $fields['NACH'];
				$obor->subs = $fields['SUBS'];
				$obor->opl = $fields['OPL'];
				$obor->uder = $fields['UDER'];
				$obor->sal = $fields['SAL'];
			if ($obor->validate())
			{
				$obor->save();
				return true;
			}
			else return false;
		}

		public function NewNach($findposl,$fields,$tipposl)

		{
			$narah = new UtNarah();

			$narah->id_org = 1;
			$narah->period = $this->MonthYear;
			$narah->id_abonent = $findposl->id_abonent;
			$narah->id_posl = $findposl->id;
			$narah->id_tipposl = $findposl->id_tipposl;

			$narah->id_vidlgot = $fields['LGOTA'] <> '' ? UtVidlgot::findOne(['lgota' => trim(iconv('CP866','utf-8',$fields['LGOTA']))])->id : null;
//			$narah->id_tarif = $fields['OPL'];
			$narah->tarif = $fields['TARIF'];
			$narah->id_vidpokaz = $tipposl->id_vidpokaz;
			$narah->pokaznik = $fields['FL_SCH'] == -1 ? $fields['LG_KOLI'] : $fields['RAZN'];
			$narah->nnorma = $fields['FL_SCH'] == -1 ? $fields['RAZN'] : 0;
//			$narah->pokaznik = UtPokaz::findOne(['id_abonent' => $narah->id_abonent,'id_vidpokaz' => $narah->id_vidpokaz ])->pokaznik;
			$narah->ed_izm = $tipposl->ed_izm;
			$narah->sum = $fields['SUM'];



			if ($narah->validate())
			{
				$narah->save();
				return true;
			}
			else return false;
		}

		public function NewOpl($findposl,$fields,$v)

		{
			$narah = new UtOpl();

			$narah->id_org = 1;
			$narah->period = $this->MonthYear;
			$narah->id_abonent = $findposl->id_abonent;
			$narah->id_posl = $findposl->id;
			$narah->id_tipposl = $findposl->id_tipposl;
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





	}

?>