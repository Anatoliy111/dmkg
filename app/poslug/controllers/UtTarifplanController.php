<?php

namespace app\poslug\controllers;

use Yii;
use app\poslug\models\UtTarifplan;
use app\poslug\models\SearchUtTarifplan;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtTarifplanController implements the CRUD actions for UtTarifplan model.
 */
class UtTarifplanController extends Controller
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
     * Lists all UtTarifplan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUtTarifplan();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $provider = new SqlDataProvider([
//            'sql' => 'SELECT `ut_tarifplan`.`period`,`ut_tarifplan`.`id_tipposl`, `ut_tarifplan`.`tarifplan`, `ut_dom`.`n_dom`,`ut_ulica`.`ul` FROM `ut_tarifplan`
//LEFT JOIN `ut_dom` ON `ut_tarifplan`.`id_dom` = `ut_dom`.`id`
//LEFT JOIN `ut_ulica` ON `ut_dom`.`id_ulica`=`ut_ulica`.`id`',
//
//        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UtTarifplan model.
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
     * Creates a new UtTarifplan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtTarifplan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtTarifplan model.
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
     * Deletes an existing UtTarifplan model.
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
     * Finds the UtTarifplan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtTarifplan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtTarifplan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
