<?php

namespace app\poslug\controllers;

use app\poslug\models\SearchUtAuth;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtKart;
use Yii;
use app\poslug\models\UtAuth;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtAuthController implements the CRUD actions for UtAuth model.
 */
class UtAuthController extends Controller
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
     * Lists all UtAuth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUtAuth();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UtAuth model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$auth = $this->findModel($id);
		$query = UtAbonent::find();//->where(['id_kart' => $kart->id])->orderBy('id_org')->all();
		$query->where(['id_kart' => $auth->id_kart])->orderBy('id_org');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
        return $this->render('view', [
            'model' => $auth,
			'dataProvider' =>$dataProvider,
        ]);
    }

	public function actionActiv($id)
	{
		$auth = $this->findModel($id);
		$Kart = UtKart::findOne($auth->id_kart);
		if ($Kart != null)
		{
			$Kart->status = 1;
			$Kart->pass = md5($auth->passw);
			$Kart->save();
			$auth->status = 1;
			$auth->save();
		}
		return $this->redirect(['index']);
	}

	public function actionCansel($id)
	{
		$auth = $this->findModel($id);
		$auth->status = 2;
		$auth->save();

		return $this->redirect(['index']);

	}

    /**
     * Creates a new UtAuth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtAuth();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtAuth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UtAuth model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UtAuth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtAuth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtAuth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
