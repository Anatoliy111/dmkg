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
		public static $UPLOADS_DIR = 'uploads/import';
		public static $arc_DIR = 'uploads/arc';

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
//				[['File'], 'file','skipOnEmpty' => false, 'extensions' => 'dbf'],
//				[['File'],'validateNameFile1'],
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
				if (!is_dir($uploadPath)) {
					mkdir($uploadPath);
				}

				$this->File->saveAs($uploadPath . $this->File->baseName . '.' . $this->File->extension);
				$this->File->name = mb_strtolower($this->File->name);
				Yii::$app->session->addFlash($this->File->name, "Завантажено файл - ".$this->File->name."");

//                $this->ImportDbf($this->File);

				return true;
			} else {
				return false;
			}
		}

		public function uploadPath()
		{
			$uploadPath = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath);
			}
			return $uploadPath;
		}

		public function uploadDir()
		{
			$uploadDir = DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
			return $uploadDir;
		}



		public function remDir() {
			$dir = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
            $this->removeDir($dir);
			if (!is_dir($dir)) {
				return mkdir($dir);
			}
			return true;
		}



		private function removeDir($dir) {
			if (!file_exists($dir)) {
				return true;
			}

			if (!is_dir($dir)) {
				return unlink($dir);
			}

			foreach (scandir($dir) as $item) {
				if ($item == '.' || $item == '..') {
					continue;
				}

				if (!$this->removeDir($dir . DIRECTORY_SEPARATOR . $item)) {
					return false;
				}

			}

			return rmdir($dir);
		}

		function delFolder($dir)
		{
			$files = array_diff(scandir($dir), array('.','..'));
			foreach ($files as $file) {
				(is_dir("$dir/$file")) ? $this->delFolder("$dir/$file") : unlink("$dir/$file");
			}
			return rmdir($dir);
		}

		public function uploadFiles()
		{
			if ($this->validate()) {
				$this->percent = 0;
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
//			$zip = new PclZip("arch.zip");
			$zip = new ZipArchive();
			$file = $filename;
			$uploadPath = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
			$res = $zip->open($uploadPath.$filename);
			if ( $res === TRUE) {
				 $zip->extractTo($uploadPath.$filename->baseName);
				$zip->close();
//					Yii::$app->session->setFlash('success', 'Завантаження виконано!',true);
				Alert::begin(['options' => ['class' => 'alert-success'],]);


				echo "Завантаження виконано: '$filename'.'$zip->filename'\n";

				Alert::end();
				$this->MonthYear = date('Y-m-d',strtotime(substr($filename->baseName,0,4).'-'.substr($filename->baseName,4,2).'-01'));
				$_SESSION['DirFiles'] = $uploadPath.$filename->baseName;
				$_SESSION['DirUpd'] = $uploadPath;
				$_SESSION['PeriodBase'] = $this->MonthYear;
				return true;

			} else {
				Yii::$app->session->setFlash($this->File->name, "Не вдалося відкрити файл:".$uploadPath.$this->File->name." ".$uploadPath.$filename."--- ".$res);
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










	}

?>