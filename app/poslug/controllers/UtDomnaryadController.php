<?php

namespace app\poslug\controllers;

use app\poslug\models\UtDomnaryadmat;
use app\poslug\models\UtDomrab;
use Yii;
use app\poslug\models\UtDomnaryad;
use app\poslug\models\SearchUtDomnaryad;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtDomnaryadController implements the CRUD actions for UtDomnaryad model.
 */
class UtDomnaryadController extends Controller
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
     * Lists all UtDomnaryad models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new UtDomnaryad();
        $model->id_org = 1;
        $model->period = Yii::$app->session['periodoblik'];


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }
        else
        {
            $searchModel = new SearchUtDomnaryad();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }


    }

    /**
     * Displays a single UtDomnaryad model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UtDomnaryad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtDomnaryad();
		$model->id_org = 1;
		$model->period = Yii::$app->session['periodoblik'];
        $model->proveden = 0;


//		$rabota = UtDomrab::find()->where(['id_naryad' => $model->id])->all();
//		$DPrabota = new ActiveDataProvider([
//			'query' => $rabota,
//		]);
//
//		$mat = UtDomnaryadmat::find()->where(['id_naryad' => $model->id])->all();
//		$DPmat = new ActiveDataProvider([
//			'query' => $mat,
//		]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtDomnaryad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UtDomnaryad model.
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
     * Finds the UtDomnaryad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtDomnaryad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtDomnaryad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
