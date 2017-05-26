<?php

namespace app\controllers;

use app\poslug\models\UtAbonent;
use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\UtOrg;
use app\poslug\models\UtPosl;
use Yii;
use app\models\UtKart;
use app\models\SearchUtKart;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtKartController implements the CRUD actions for UtKart model.
 */
class UtKartController extends Controller
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
     * Lists all UtKart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUtKart();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$_SESSION['period'] = ArrayHelper::getValue(UtObor::find()->orderBy(['period'=>SORT_DESC])->one(), 'period');

		//		$searchModel->period();
//		$searchModel->lastperiod();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UtKart model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);


        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new UtKart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtKart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


	public function actionPoslug($id)
	{

		if (isset($_POST['UtKart']['MonthYear']))
		{ $_SESSION['period']= $_POST['UtKart']['MonthYear'];}

		$model = $this->findModel($id);

		$abonents = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org')->all();

		foreach ($abonents as $abon) {
			$query = UtPosl::find();
			$query->joinWith('abonent')->where(['ut_abonent.id' => $abon->id, 'ut_posl.period'=> $_SESSION['period']]);
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			$dp[$abon->id] = $dataProvider;
		}

		return $this->render('poslugview', [
			'model' => $model,
			'dp' => $dp,
			'abonents' => $abonents,
		]);
	}

	public function actionNar($id)
	{

		if (isset($_POST['UtKart']['MonthYear']))
		{ $_SESSION['period'] = $_POST['UtKart']['MonthYear'];}

		$model = $this->findModel($id);

		$dp = array();
		$abonents = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org')->all();

		foreach ($abonents as $abon) {
			$query = UtNarah::find();
			$query->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_narah.period'=> $_SESSION['period']]);
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

				$dp[$abon->id] = $dataProvider;
		}

		return $this->render('narview', [
			'model' => $model,
			'dp' => $dp,
			'abonents' => $abonents,
		]);
	}

	public function actionOpl($id)
	{

		if (isset($_POST['UtKart']['MonthYear']))
		{ $_SESSION['period'] = $_POST['UtKart']['MonthYear'];}

		$model = $this->findModel($id);

		$dp = array();
		$abonents = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org')->all();

		foreach ($abonents as $abon) {
			$query = UtOpl::find();
			$query->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_opl.period'=> $_SESSION['period']]);
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

				$dp[$abon->id] = $dataProvider;
		}

		return $this->render('oplview', [
			'model' => $model,
			'dp' => $dp,
			'abonents' => $abonents,
		]);
	}

	public function actionObor($id)
	{

		if (isset($_POST['UtKart']['MonthYear']))
		{ $_SESSION['period'] = $_POST['UtKart']['MonthYear'];}

		$model = $this->findModel($id);
		$abonents = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org')->all();

		foreach ($abonents as $abon) {
			$query = UtObor::find();
			$query->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $_SESSION['period']]);
			$ff = ArrayHelper::toArray($query);
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

				$dp[$abon->id] = $dataProvider;
		}

		return $this->render('oborview', [
			'model' => $model,
			'dp' => $dp,
			'abonents' => $abonents,
		]);


	}


	public function actionInfo($id)
	{

		if (isset($_POST['UtKart']['MonthYear']))
		{ $_SESSION['period'] = $_POST['UtKart']['MonthYear'];}


		$model = $this->findModel($id);

		$query = UtAbonent::find();
		$query->andWhere(['id_kart' => $model->id]);
		$query->orderBy('id_org');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		return $this->render('infoview', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);
	}


    /**
     * Updates an existing UtKart model.
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
     * Finds the UtKart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtKart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtKart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	protected function findAbonent($id)
	{
		if (($model = UtAbonent::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
