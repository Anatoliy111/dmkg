<?php

namespace app\controllers;

use app\poslug\models\UtAbonent;
use app\models\UtAuth;
use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\UtOrg;
use app\poslug\models\UtPosl;
use app\poslug\models\UtSubs;
use app\poslug\models\UtTarifab;
use app\poslug\models\UtUtrim;
use Yii;
use app\models\UtKart;
use app\models\SearchUtKart;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
//			'access' => [
//				'class' => AccessControl::className(),
//				'only' => ['index', 'logout','kabinet'],
//				'rules' => [
//					[
//						'allow' => true,
//						'actions' => ['index'],
//						'roles' => ['?'],
//					],
//					[
//						'allow' => true,
//						'actions' => ['logout'],
//						'roles' => ['@'],
//					],
//				],
//			],
        ];
    }

    /**
     * Lists all UtKart models.
     * @return mixed
     */
    public function actionIndex()
    {
		$session = Yii::$app->session;
		if ($session['model']<>null)
		{
			return $this->redirect(['kabinet', 'id' => $session['model']->id]);
		}
        $searchModel = new SearchUtKart();
		$findmodel = null;
		$searchModel->scenario = 'adres';
//		$searchModel->scenario = isset($_REQUEST['SearchUtKart']['enterpass']) ? $searchModel->scenario = 'password' : $searchModel->scenario = 'adres';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		if ($dataProvider->className()){
//
//		}
		if ($dataProvider->getTotalCount() <> 0){
			$searchModel->scenario = 'password';
			$findmodel = $searchModel->searchPass(Yii::$app->request->queryParams,$dataProvider);
		}

//		}
		if ($findmodel <> null and $findmodel <> 'bad'){

//			return $this->render('kabinet', ['id'=>$findmodel->id]);
//			$this->actionKabinet($findmodel->id);

			$session['model'] = $findmodel;
			return $this->redirect(['kabinet', 'id' => $findmodel->id]);
		}


			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'findmodel' => $findmodel,
			]);


    }

	public function actionReestr()
	{

		$searchModel = new SearchUtKart();
		$searchModel->scenario = 'adres';
//		$searchModel->scenario = isset($_REQUEST['SearchUtKart']['enterpass']) ? $searchModel->scenario = 'password' : $searchModel->scenario = 'adres';
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		if ($dataProvider->className()){
//
//		}
		if ($dataProvider->getTotalCount() <> 0){
			$searchModel->scenario = 'password';
			$findmodel = $searchModel->searchPass(Yii::$app->request->queryParams,$dataProvider);
		}

//		}



		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,

		]);


	}


	public function actionLogout()
	{
		$session = Yii::$app->session;
		$session->destroy();
		return $this->redirect(['ut-kart/index']);
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
			$query->joinWith('abonent')->where(['ut_abonent.id' => $abon->id]);
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

	public function actionKabinet($id)
	{
//		$session = Yii::$app->session;
//		if (isset($_POST['UtKart']['MonthYear']))
//		{ $session['period'] = $_POST['UtKart']['MonthYear'];}


		$model = $this->findModel($id);
		$session = Yii::$app->session;
		if ($session['model']==null || $session['model']<>$model )
		{
			return $this->redirect(['ut-kart/index']);
		}

//		$model->scenario = 'password';

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {

			$model->pass =  md5($model->id.trim($model->pass2));
			$model->passopen = trim($model->pass2);
			$model->date_pass = date('Y-m-d');

			$model->save();
			$session->setFlash('pass', 'Пароль змінено');
			return $this->redirect(['kabinet', 'id' => $model->id]);
		}

		$model->pass1 = '';
		$model->pass2 = '';

//		$session['period'] = UtObor::find()->max('period');
//		$session['period'] = $model->period();
//		$session['period'] = $model->lastperiod();
//		$model->MonthYear = $_SESSION['period'];
//		$model->MonthYear =  $session['period'];

		$abonen = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org');

		$orgs = UtAbonent::find()->with('org')->where(['id_kart' => $model->id])->groupBy('id_org')->all();

        foreach($orgs as $org)
		{
			$session['period'] = [$org->id_org => UtObor::find()->where(['id_org' => $org->id_org])->max('period')];
			$abonen = UtAbonent::find()->where(['id_kart' => $model->id,'id_org' => $org->id_org]);
			$dpinfo[$org->id_org] = new ActiveDataProvider([
				'query' => $abonen,
			]);
			$abonents[$org->id_org] = UtAbonent::find()->where(['id_kart' => $model->id,'id_org' => $org->id_org])->all();
			foreach ($abonents[$org->id_org] as $abon) {

				//-----------------------------------------------------------------------------
				$obor= UtObor::find();
				$obor->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
				$ff = ArrayHelper::toArray($obor);
				$dataProvider1 = new ActiveDataProvider([
					'query' => $obor,
				]);
				$dpobor[$org->id_org][$abon->id] = $dataProvider1;
				//-----------------------------------------------------------------------------
				$opl = UtOpl::find();
				$opl->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_opl.period'=> $session['period'][$org->id_org]]);
				$dataProvider2 = new ActiveDataProvider([
					'query' => $opl,
				]);

				$dpopl[$org->id_org][$abon->id] = $dataProvider2;
				//-----------------------------------------------------------------------------
				$nar= UtNarah::find();
				$nar->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_narah.period'=> $session['period'][$org->id_org]]);
				$dataProvider3 = new ActiveDataProvider([
					'query' => $nar,
				]);

				$dpnar[$org->id_org][$abon->id] = $dataProvider3;
				//-----------------------------------------------------------------------------
				$pos = UtPosl::find();
				$pos->joinWith('abonent')->where(['ut_abonent.id' => $abon->id]);
				$dataProvider4 = new ActiveDataProvider([
					'query' => $pos,
				]);

				$dppos[$org->id_org][$abon->id] = $dataProvider4;

				//-----------------------------------------------------------------------------
				$tar = UtTarifab::find();
				$tar->joinWith('abonent')->where(['ut_abonent.id' => $abon->id]);
//				$tar->joinWith('tarif');
//				$tar->innerJoin('tipposl')->where(['tarif.id_tipposl' => 'tipposl.id']);


				$dataProvider6 = new ActiveDataProvider([
					'query' => $tar,
				]);
				$tt = ArrayHelper::toArray($tar);
				$dptar[$org->id_org][$abon->id] = $dataProvider6;

				$sub = UtSubs::find();
				$sub->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_subs.period'=> $session['period'][$org->id_org]]);
				$dataProvider8 = new ActiveDataProvider([
					'query' => $sub,
				]);

				$dpsub[$org->id_org][$abon->id] = $dataProvider8;

				$uder = UtUtrim::find();
				$uder->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_utrim.period'=> $session['period'][$org->id_org]]);
				$dataProvider9 = new ActiveDataProvider([
					'query' => $uder,
				]);

				$dpuder[$org->id_org][$abon->id] = $dataProvider9;



			}
		}
//		$dpinfo = new ActiveDataProvider([
//			'query' => $abonen,
//		]);

		return $this->render('kabinet', [
			'model' => $model,
			'abonents' => $abonents,
//			'dpinfo' => $dpinfo,
			'dpobor' => $dpobor,
			'dpopl' => $dpopl,
			'dpnar' => $dpnar,
			'dppos' => $dppos,
			'dptar' => $dptar,
			'dpsub' => $dpsub,
			'dpuder' => $dpuder,
			'orgs' => $orgs,
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
			$session = Yii::$app->session;
			if ($session['model']<>null && $session['model']<>$model )
			{
				return $session['model'];
			}
			else
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

	public function actionAuth()
	{
		$model = new UtAuth();

		if ($model->load(Yii::$app->request->post()))  {
			$Abon = UtAbonent::findOne(['schet' => $model->schet]);

			$email = UtKart::find()->select('email')->where(['email' => $model->email])->all();
//			$email1 = UtKart::find()->select('email')->all();
			$ab = UtAbonent::find()->select('schet')->asArray()->column();
			if ($Abon <> null && $email == null)
			{

				$Kart = $Abon->getKart()->one();
				if ($Kart->status<>1)
				{
					$model->id_kart = $Abon->id_kart;
					$model->passw = $model->pass1;
					$model->date =	date('Y-m-d');
					$model->save();
					Yii::$app->session->AddFlash('alert-info', "Заявка на реєстрацію подана. Буде оброблена в період 1-3 дні ");
				}
				else
				{
						Yii::$app->session->AddFlash('alert-danger', "Абонент з рахунком $Abon->schet вже зареестрований");
				}


			}
			else
			{
				if ($Abon == null)
				   Yii::$app->session->AddFlash('alert-danger', "Рахунок незнайдено!!!");
				if ($email <> null)
					Yii::$app->session->AddFlash('alert-danger', "$model->email вже зареєстрований в системі!!!");

//				throw new NotFoundHttpException('tttThe requested page does not exist.');
//				echo 'По вашій адресі абонентів не знайдено !!!';
			}
			return $this->redirect(['index']);
		}
		 else {
			return $this->render('auth', [
				'model' => $model,
			]);
		}
	}

	public function actionPass($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('pass', [
				'model' => $model,
			]);
		}
	}

}
