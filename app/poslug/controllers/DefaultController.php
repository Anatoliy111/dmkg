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
		$model = new UploadForm();
//
		return $this->render('index' ,[
			'model' => $model,
			]
		);
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
//		$model = new UploadForm();
//							Alert::begin(['options' => ['class' => 'alert'],]);
//					echo "Не удалось открыть DBF файл:'\n";
//					Alert::end();

//		if (Yii::$app->request->isPost) {
//
//		}


//		return $this->redirect('upload', ['model' => $model]);
//		return $this->render('upload', ['model' => $model]);
//		return Yii::$app->getSession()->setFlash('success', 'Yes! Its`s empty!',true);

		$model = new UploadForm();
		if ($model->load(Yii::$app->request->post())) {
			if (Yii::$app->request->isPjax) {
				if(isset($_FILES['UploadForm']['name']['Files'][0]) && ($_FILES['UploadForm']['name']['Files'][0]) <> "")
				{
					$model->Files = UploadedFile::getInstances($model, 'Files');
					if ($model->uploadFiles()) {
						$pers = (100/count($model->Files));
						foreach($model->Files as $upfile)
						{
//						Yii::$app->session->setFlash($upfile->name, "Завантажені файли - ".$upfile->name."");
//						return $this->render('upload', ['model' => $model]);

//						$model->percent += $pers;
//						$this->renderPartial('upload', ['model' => $model],true);
//						sleep(1);
//						upda

//						$this->render('upload');
						}
						// file is uploaded successfully

					}
				}
				elseif(isset($_FILES['UploadForm']['name']['File']))
				{
					$model->File = UploadedFile::getInstance($model, 'File');
//					$model->DateMonthYear =date('01-'.$_POST['UploadForm']['MonthYear']);
//					$model->MonthYear =$_POST['UploadForm']['MonthYear'];
//				$model->MonthYear =$_POST['UploadForm']['MonthYear'];
//				$model->MonthYear=Yii::$app->formatter->asDate($model->MonthYear, "dd-mm-yyyy");
//					echo "<script type=".'text/javascript'.">showModalprogress();</script>";

					if ($model->uploadFile()) {

						$UnPath = $model->UnZIP($model->File);
						if ($UnPath <> '')
						{
//							$model->Importolddomulica($UnPath);
//							$model->Importoldkart($UnPath);
//							$model->Importoldorg($UnPath);
//							$model->UpdateAbonentKart();
//							$model->ImportNach($UnPath);
							$model->ImportObor($UnPath);
							$model->ImportOpl($UnPath);
//							$model->UpdateBase();
						}
//						$model->ImportDbf($model->File);
//						<script type="text/javascript">CloseModalprogress();</script>

//					Yii::$app->session->setFlash($model->File->name, "Завантажено файл - ".$model->File->name."");
						// file is uploaded successfully
//				return;


					}

				}
//				echo "<script type=".'text/javascript'.">CloseModalprogress();</script>";
				return $this->render('upload', ['model' => $model]);
			}
		}

		return $this->render('upload', ['model' => $model]);
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
