<?php

namespace app\poslug\controllers;

use app\poslug\models\UtDominfo;
use app\poslug\models\UtDomzatrat;
use app\poslug\models\UtTarif;
use Yii;
use app\poslug\models\UtDom;
use app\poslug\models\SearchUtDom;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtDomController implements the CRUD actions for UtDom model.
 */
class UtDomController extends Controller
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
     * Lists all UtDom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUtDom();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $doms = $dataProvider->getModels();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'doms' => $doms,
        ]);
    }

    /**
     * Displays a single UtDom model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $dominfo= UtDominfo::findOne(['id_dom' => $model->id]);

        $domtarif= UtTarif::find();
        $domtarif->where(['id_dom' => $model->id])->orderBy(['id_tipposl' => SORT_ASC]);

        $domzatrat= UtDomzatrat::find();
        $domzatrat->where(['id_dom' => $model->id])->orderBy(['n_akt' => SORT_ASC]);

        $dPtarif = new ActiveDataProvider([
            'query' => $domtarif,
        ]);

        $dPzatrat = new ActiveDataProvider([
            'query' => $domzatrat,
        ]);


        return $this->render('view', [
            'model' => $model,
            'dominfo' => $dominfo,
            'dPtarif' => $dPtarif,
            'dPzatrat' => $dPzatrat,
        ]);
    }

    /**
     * Creates a new UtDom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtDom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtDom model.
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

    public function actionUpdatespis()
    {
        $searchModel = new SearchUtDom();
        $dataProvider = $searchModel->updspis();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing UtDom model.
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
     * Finds the UtDom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtDom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtDom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
