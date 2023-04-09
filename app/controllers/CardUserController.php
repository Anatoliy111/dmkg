<?php

namespace app\controllers;

use app\models\KomUlica;
use Yii;
use app\models\CardUser;
use app\models\UploadForm;
use app\models\CardUserSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;



/**
 * CardUserController implements the CRUD actions for CardUser model.
 */
class CardUserController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all CardUser models.
     * @return mixed
     */


    public function actionIndex()
    {
        $searchModel = new CardUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$uupload = $this->actionUploadF();
		$DBF = $uupload->ImportDbf($uupload->imageFile,false);
//        $Ulica=KomUlica::find()->all();
//        $ListUlica=ArrayHelper::map($Ulica,'ID','UL');

//		if ($dataProvider->getTotalCount() == 0) {
//			Yii::$app->getSession()->setFlash('alert', [
//			'body'=>'Thank you for contacting us. We will respond to you as soon as possible.',
//			'options'=>['class'=>'alert-warning']
//		]);
//				Alert::begin([
//		'options' => [
//			'class' => 'alert-danger',
//		],
//	]);
//
//	echo 'По вашій адресі абонентів не знайдено';
//
//	Alert::end();
//		}


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'uupload' => $uupload,
			'DBF' => $DBF,
//            'ListUlica' => $ListUlica,
        ]);
    }

    /**
     * Displays a single CardUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUslug($id)
    {
//        $new = new CardUser();
//        $dataProvider = $new->searchKomUslug();
        $model = $this->findModel($id);
        $query = $model->getKomUslugs();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('uslugview', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionObor($id,$id_usl)
    {
//        $new = new CardUser();
//        $dataProvider = $new->searchKomUslug();
        $model = $this->findModel($id);
        $query = $model->getKomObor($id_usl);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('uslugview', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the CardUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CardUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = CardUser::findOne($id)) !== null) {

				// uncomment the following line if you do not want to return any records when validation fails

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBack($defaultUrl)
    {
//       return $this->goBack($defaultUrl);
       return Yii::$app->user->getReturnUrl($defaultUrl);
    }

	public function actionUploadF()
	{
		$modelUpload = new UploadForm();

		if (Yii::$app->request->isPost) {
			$modelUpload->imageFile = UploadedFile::getInstance($modelUpload, 'imageFile');
			if ($modelUpload->upload()) {
				// file is uploaded successfully
//				return;

			}
		}

		return $modelUpload;
	}

}
