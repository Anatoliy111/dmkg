<?php

namespace app\controllers;

use app\models\UtKart;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtDominfo;
use app\poslug\models\UtDomzatrat;
use app\poslug\models\UtObor;
use app\poslug\models\UtTarif;
use app\poslug\models\UtTarifinfo;
use app\poslug\models\UtTarifplan;
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
    public function actionTarinfo($id)
    {

		$model = $this->findTarif($id);
		$newtarinfo = new UtTarifinfo;
		$newtarinfo->id_tarif = $model->id;
		if ($newtarinfo->load(Yii::$app->request->post()) && $newtarinfo->validate()) {
			$newtarinfo->save();
			$newtarinfo = new UtTarifinfo;
			$newtarinfo->id_tarif = $model->id;
		}



		$tarinfo = UtTarifinfo::find();
		$tarinfo->where(['id_tarif' => $id])->orderBy(['id_tarifvid' => SORT_ASC]);
//		if ($dominfo==null)
//		{
//			$newinfo = new UtDominfo();
//			$newinfo->id_dom=$model->id;
//			$newinfo->save();
//			$dominfo=$newinfo;
//		}
//
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
		}


        $dataProvider = new ActiveDataProvider([
            'query' => $tarinfo,
        ]);


        return $this->render('tarinfo', [
			'model' => $model,
			'dataProvider' => $dataProvider,
			'newtarinfo' => $newtarinfo,
        ]);
    }

	public function actionCreatetarinfo($id)
	{
		$model = new UtTarifinfo();
		$model->id_tarif = $id;


		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['tarinfo', 'id' => $model->id_tarif]);
		} else {
			return $this->render('createtarinfo', [
				'model' => $model,
			]);
		}
	}


	public function actionView($id)
	{
		$model = $this->findModel($id);

		$dominfo= UtDominfo::findOne(['id_dom' => $model->id]);
		if ($dominfo==null)
		{
			$newinfo = new UtDominfo();
			$newinfo->id_dom=$model->id;
			$newinfo->save();
			$dominfo=$newinfo;
		}

		if ($dominfo->load(Yii::$app->request->post()) && $dominfo->validate()) {
			$dominfo->save();
		}

		$Find = UtTarif::find()->where(['ut_tarif.period' => Yii::$app->session['periodoblik']])->all();
        if ($Find<>null)
		{
		$domtarif1= UtTarif::find();
		$domtarif1->select('ut_tarif.*,ut_tarifplan.tarifplan,ut_tarifplan.id as val');
		$domtarif1->leftJoin('ut_tarifplan','(`ut_tarifplan`.`id_dom`=`ut_tarif`.`id_dom` and `ut_tarifplan`.`id_tipposl`=`ut_tarif`.`id_tipposl` and `ut_tarifplan`.`period`=`ut_tarif`.`period`)');
		$domtarif1->where(['ut_tarif.id_dom' => $model->id]);
		$domtarif1->andWhere(['ut_tarif.period' => Yii::$app->session['periodoblik']]);
		$domtarif1->orderBy(['ut_tarif.id_tipposl' => SORT_ASC]);
		}
		else
		{
			$domtarif1= UtTarifplan::find();
			$domtarif1->select('ut_tarifplan.*,ut_tarifplan.id as val');
			$domtarif1->where(['ut_tarifplan.id_dom' => $model->id]);
			$domtarif1->andWhere(['ut_tarifplan.period' => Yii::$app->session['periodoblik']]);
			$domtarif1->orderBy(['ut_tarifplan.id_tipposl' => SORT_ASC]);
		}

		$nachdom = UtObor::find()->select('period, tipposl, sum(dolg) as dolg, sum(nach) as nach, sum(subs) as subs, sum(opl) as opl, sum(sal) as sal');
		$nachdom->leftJoin('ut_abonent','ut_abonent.id = ut_obor.id_abonent');
		$nachdom->leftJoin('ut_kart','ut_kart.id = ut_abonent.id_kart');
		$nachdom->where(['ut_kart.id_dom' => $model->id]);
		$nachdom->andWhere(['ut_obor.period' => Yii::$app->session['periodoblik']]);
		$nachdom->andWhere(['!=', '`ut_obor`.`dolg`+`ut_obor`.`nach`+`ut_obor`.`subs`+`ut_obor`.`opl`+`ut_obor`.`sal`', 0]);
		$nachdom->groupBy('period,tipposl');

		$domzatrat= UtDomzatrat::find();
		$domzatrat->where(['id_dom' => $model->id])->orderBy(['n_akt' => SORT_ASC]);

		$domabon= UtAbonent::find();
		$domabon->joinWith('kart');
		$domabon->where(['ut_kart.id_dom' => $model->id,])->orderBy(['schet' => SORT_ASC]);

		$dPtarif = new ActiveDataProvider([
			'query' => $domtarif1,
		]);

		$dPzatrat = new ActiveDataProvider([
			'query' => $domzatrat,
		]);

		$dPabon = new ActiveDataProvider([
			'query' => $domabon,
		]);

		$dPnach= new ActiveDataProvider([
			'query' => $nachdom,
		]);


		return $this->render('view', [
			'model' => $model,
			'dominfo' => $dominfo,
			'dPtarif' => $dPtarif,
			'dPzatrat' => $dPzatrat,
			'dPabon' => $dPabon,
			'dPnach' => $dPnach,
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
//        $model = $this->findModel($id);
//
//
//            return $this->render('update', [
//                'model' => $model,
//            ]);

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

	protected function findTarif($id)
	{
		if (($model = UtTarif::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
