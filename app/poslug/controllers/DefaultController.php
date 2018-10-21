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
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
//			Yii::$app->session['perioddom']=$data['period'];

		}



	}

	public function actionDelfile()
	{
//		Yii::$app->request->Ajax
		if(\Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
//			Yii::$app->session['perioddom']=$data['period'];

		}



	}





}
