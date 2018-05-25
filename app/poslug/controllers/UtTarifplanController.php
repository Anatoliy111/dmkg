<?php

namespace app\poslug\controllers;

use app\poslug\models\UtTarifinfo;
use Yii;
use app\poslug\models\UtTarifplan;
use app\poslug\models\SearchUtTarifplan;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
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
		$session = Yii::$app->session;
		$per = [];
		$ar  = UtTarifplan::find()->orderBy(['period' => SORT_DESC])->all();
		if ($session['periodoblik']==null)
		$session['periodoblik'] = $ar[0]['period'];
		$dat = ArrayHelper::map($ar, 'period', 'period');

		foreach ($dat as $dt)
		{
			$val=ArrayHelper::getValue($per, Yii::$app->formatter->asDate($dt, 'Y'));
			    if ($val==null)
				{
				ArrayHelper::setValue($per, Yii::$app->formatter->asDate($dt, 'Y'), [$dt => Yii::$app->formatter->asDate($dt, 'LLLL')]);
				}
				else
				{
				ArrayHelper::setValue($per, [Yii::$app->formatter->asDate($dt, 'Y'),$dt], Yii::$app->formatter->asDate($dt, 'LLLL'));

				}
		}
		$session['dateplan']=$per;


        $searchModel = new SearchUtTarifplan();
//		$searchModel->period =$ar[0]['period'];
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

	public function actionCreatetarinfo($id)
	{
		$model = new UtTarifinfo();
		$model->id_tarifplan = $id;


		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['tarinfo']);
		} else {
			return $this->render('createtarinfo', [
				'model' => $model,
			]);
		}
	}

	public function actionTarinfo($id)
	{

		$model = $this->findModel($id);
		$newtarinfo = new UtTarifinfo;
		$newtarinfo->id_tarifplan = $model->id;
		if ($newtarinfo->load(Yii::$app->request->post()) && $newtarinfo->validate()) {
			$tt = UtTarifinfo::find()->select('id_tarifvid')->where(['id_tarifplan' => 8])->asArray()->all();
			$newtarinfo->save();
			$newtarinfo = new UtTarifinfo;
			$newtarinfo->id_tarifplan = $model->id;
		}



		$tarinfo = UtTarifinfo::find();
		$tarinfo->where(['id_tarifplan' => $id])->orderBy(['id_tarifvid' => SORT_ASC]);
//		if ($dominfo==null)
//		{
//			$newinfo = new UtDominfo();
//			$newinfo->id_dom=$model->id;
//			$newinfo->save();
//			$dominfo=$newinfo;
//		}
//
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->id_vidpokaz = $model->tipposl->id_vidpokaz;
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

	public function actionCalculateall()
	{
		$Tarifplan=UtTarifplan::find()->all();

		foreach($Tarifplan as $tarif)
		{
			$sql = 'SELECT id_tarifplan,sum(tarifplan) as summ FROM ut_tarifinfo WHERE id_tarifplan=:st group by id_tarifplan';
			$suminfo = UtTarifinfo::findBySql($sql, [':st' => $tarif->id])->asArray()->all();
//			$suminfo = UtTarifinfo::find()->select('sum(tarifplan) as sum')->where(['id_tarifplan'=>$tarif->id])->groupBy('id_tarifplan')->all();
			$tarif->tarifplan = $suminfo[0]['summ'];
			$tarif->save();
		}

		return $this->redirect(['index']);
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
        $model = $this->findModelinfo($id);

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
//		UtTarifinfo::deleteAll(['id_tarifplan'=>$id]);
//		$model->delete();
//        return $this->redirect(['index']);
    }

	public function actionDeleteinfo($id)
	{
		$vidinfo = $this->findModelinfo($id);
		$info = $vidinfo->id_tarifplan;
		$vidinfo->delete();
//		UtTarifinfo::deleteAll(['id_tarifplan'=>$id]);
//		$model->delete();
//		return $this->redirect(['tarinfo','id' => $info]);
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

	protected function findModelinfo($id)
	{
		if (($model = UtTarifinfo::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
