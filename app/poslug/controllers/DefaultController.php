<?php

namespace app\poslug\controllers;

//use app\models\UploadForm;
use app\poslug\models\UploadForm;

use app\poslug\models\UtOldkart;
use app\poslug\models\UtOldorg;
use Yii;
use yii\bootstrap\Alert;
use yii\bootstrap\Progress;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Session;

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
				if ($model->uploadFile()) {
					if ($model->UnZIP($model->File)) {
						$model->progress = true;
					}
//					return $this->redirect(['upload', 'model' => $model]);
				}

			}

		}

		return $this->render('upload', ['model' => $model,
		]);
	}


	public function actionImportprogress()
	{
		return $this->render('importprogress');
	}

	public function actionImportdbf()
	{
		return $this->render('importdbf');
	}


	public function actionOldkart()
	{
		$model = new UtOldkart();
		$dataProvider = new ActiveDataProvider([
			'query' => UtOldkart::find(),
		]);

		return $this->render('grid', [
			'dataProvider' => $dataProvider,
			'model' => $model,
		]);
	}


	public function actionOldorg()
	{
		$model = new UtOldorg();
		$dataProvider = new ActiveDataProvider([
			'query' => UtOldorg::find(),
		]);

		return $this->render('grid', [
			'dataProvider' => $dataProvider,
			'model' => $model,
		]);
	}



}
