<?php

namespace app\poslug\controllers;

//use app\models\UploadForm;
use app\poslug\models\UploadForm;

use Yii;
use yii\bootstrap\Alert;
use yii\bootstrap\Progress;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\filters\VerbFilter;
use ZipArchive;

/**
 * Default controller for the `poslug` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
//	public $dir;
//	public $files;
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}



    public function actionIndex()
    {
//		$model = new UploadForm();
//
		return $this->render('index');
//		return $this->render('index');
    }


	public function actionDownload()
	{
		return $this->render('download');
	}

	public function actionError()
	{
		return $this->render('error');
	}

	public function download()
	{
		if (isset($dir))
		{
			$files=\yii\helpers\FileHelper::findFiles($dir,['only'=>['*.php','*.txt'],'recursive'=>FALSE]);
		}

	}

	public function actionSetting()
	{
		return $this->render('setting');
	}

	public function actionUpload()
	{
		$model = new UploadForm();
		if ($model->load(Yii::$app->request->post())) {
			if(isset($_FILES['UploadForm']['name']['File']))
			{
				$model->File = UploadedFile::getInstance($model, 'File');
//				if ($model->remDir()) {
					if (!$model->uploadFile()) {
//						$model->UnZIP($model->File);
//						if ($model->UnZIP($model->File)) {
//
//						}
						//					return $this->redirect(['upload', 'model' => $model]);
						Alert::begin(['options' => ['class' => 'alert-warning'],]);


						echo "Невдалося завантажити файл";

						Alert::end();
					}
//				}
				else
				{

				}

			}

		}

		$uploadDir = $model->uploadDir();
		$uploadPath = $model->uploadPath();
		$_SESSION['uploadPath'] = $uploadPath;
		$array = scandir($uploadPath);
		for ($i = 0; $i < count($array); $i++) {
			$files[] = ['id' => $array[$i]];
		};
		array_shift($files); // удаляем из массива '.'
		array_shift($files); // удаляем из массива '..'
		$provider = new ArrayDataProvider([
			'allModels' => $files,
			'key'=>'id',
		]);


		return $this->render('upload', ['model' => $model,
			'provider' => $provider,
			'uploadPath' => $uploadPath,
			'uploadDir' => $uploadDir,
		]);
	}

	public function actionImport()
	{
		$model = new UploadForm();
		$model->progress = true;
		return $this->render('upload', ['model' => $model,
		]);
	}

	public function actionDelete($path)
	{
//		$this->findModel($id)->delete();

		return $this->redirect(['upload']);
	}


	public function actionImportprogress()
	{
		return $this->render('importprogress');
	}

	public function actionImportdbf()
	{
		return $this->render('importdbf');
	}

	public function actionSaveperiod()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			Yii::$app->session['periodoblik']=$data['period'];
		}



	}

	public function actionImpfile()
	{
//		Yii::$app->request->Ajax
		$model = new UploadForm();
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			$uploadPath=$_SESSION['uploadPath'];
			$datafiles = array();
			foreach ($data['keys'] as $file) {
				if (is_dir($uploadPath.$file."/"))
				{
//					$datafiles["$uploadPath/$file"] = array();
					$files = array_diff(scandir("$uploadPath/$file"), array('.','..'));
					foreach ($files as $file1) {
						if (mb_strtolower(substr(strrchr($file1, '.'), 1))=="dbf")
						  $datafiles[$uploadPath.$file."/"][] = $file1;
					}
				}
				else
					if (mb_strtolower(substr(strrchr($file, '.'), 1))=="dbf")
					    $datafiles[$uploadPath][] = $file;
      				if (mb_strtolower(substr(strrchr($file, '.'), 1))=="zip") {
//			$zip = new PclZip("arch.zip");
						$zip = new ZipArchive();
						$filename = $file;
						$dirname = mb_strtolower(substr($file,0,strpos($file, '.')));
//						$uploadPath = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.self::$UPLOADS_DIR.DIRECTORY_SEPARATOR;
						$res = $zip->open($uploadPath . $filename);
						if ($res === TRUE) {
							$zip->extractTo($uploadPath . $dirname);
							$zip->close();
							$files = array_diff(scandir($uploadPath . $dirname), array('.', '..'));
							foreach ($files as $file1) {
								if (mb_strtolower(substr(strrchr($file1, '.'), 1)) == "dbf")
									$datafiles[$uploadPath . $dirname . "/"][] = $file1;
							}
						}
					}

			}
			$_SESSION['DirFiles'] = $datafiles;
//			$this->registerJs('Import()',\yii\web\View::POS_READY);
//			return $this->redirect(['upload']);

		}

    return true;

	}

	public function actionDelfile()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
			$uploadPath=$_SESSION['uploadPath'];
			foreach ($data['keys'] as $file) {
				is_dir("$uploadPath/$file") ? $this->delFolder("$uploadPath/$file") : unlink("$uploadPath/$file");
			}

		}

		return $this->redirect(['upload']);
	}

	function delFolder($dir)
	{
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? $this->delFolder("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}




}
