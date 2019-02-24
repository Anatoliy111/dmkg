<?php

namespace app\controllers;

use app\models\LiqPay;
use app\models\UtPay;
use app\poslug\models\UtAbonent;
use app\models\UtAuth;
use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\UtOrg;
use app\poslug\models\UtPeriod;
use app\poslug\models\UtPosl;
use app\poslug\models\UtSubs;
use app\poslug\models\UtTarif;
use app\poslug\models\UtTarifab;
use app\poslug\models\UtTarifplan;
use app\poslug\models\UtUtrim;
use DateTime;
use Yii;
use app\models\UtKart;
use app\models\SearchUtKart;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTimeInterface;
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
	public function actionPay()
	{
		$public_key = 'i26177975911';
		$private_key = 'MRRWK7Ao9WlfTPO2TR5tRf8ciXv8OM73dqGHCjZQ';
		$session = Yii::$app->session;
		$model = new UtPay();

		if (\Yii::$app->request->isAjax) {
			if (array_key_exists('payid_abonent', Yii::$app->request->post())) {


				$model->id_abonent = Yii::$app->request->post()['payid_abonent'];
				$model->id_kart = $session['model']->id;


				$oplab = UtOpl::find()
					->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
					->where(['ut_opl.id_abonent' => $model->id_abonent])
					->andwhere(['>', 'ut_opl.period', $session['period']])
					->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
					->asArray();


				$dolg = UtObor::find();
				$dolg->select(["ut_obor.*", "round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl", "case when (ut_obor.sal-COALESCE(b.summ,0)) > 0 then round((ut_obor.sal-COALESCE(b.summ,0)),2) else 0  end as sendopl"]);
				$dolg->where(['ut_obor.id_abonent' => $model->id_abonent, 'ut_obor.period' => $session['period']]);
				$dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();


				$dataProvider = new ActiveDataProvider([
					'query' => $dolg,
				]);

				return $this->renderAjax('pay', [
					'model' => $model,
					'dp' => $dataProvider
				]);
			} else
				if ($model->load(Yii::$app->request->post())) {
					$my_date = new \DateTime("now", new \DateTimeZone('Asia/Manila'));

					$model->datepay = $my_date->format('Y-m-d H:i:s');
					if ($model->save()) {
						$liqpay = new LiqPay($public_key, $private_key);
						$html = $liqpay->cnb_form(array(
							'action' => 'pay',
							'amount' => $model->summ,
							'currency' => 'UAH',
							'description' => 'dfgsdf',
							'order_id' => $model->id,
							'version' => '3',
							'language' => 'uk',
							'result_url' => yii::$app->request->referrer,
							'sandbox' => 1
						));
//						return $this->redirect($html);
						return $html;
					}


				}

		}
	return $this->redirect('/ut-kart');

	}



    public function actionIndex()
    {
		$session = Yii::$app->session;
		if ($session['model']<>null)
		{
			return $this->redirect(['kabinet', 'id' => $session['model']->id]);
		}
        $searchModel = new SearchUtKart();
		$findmodel = null;
		Yii::$app->session['periodkab']=null;
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
	public function actionKabinet($id)
	{
//		$session = Yii::$app->session;
//		if (isset($_POST['UtKart']['MonthYear']))
//		{ $session['period'] = $_POST['UtKart']['MonthYear'];}

		if (Yii::$app->session['periodkab']==null)
    		Yii::$app->session['periodkab']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;
//		if (Yii::$app->session['period']==null)
			Yii::$app->session['period']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;

//		Yii::$app->session['periodkab']=UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one()->period;
////		if (Yii::$app->session['period']==null)
//		Yii::$app->session['period']=UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one()->period;


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



		$abonen = UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org');




        $summa = array();

			$dpinfo = new ActiveDataProvider([
				'query' => $abonen,
			]);
			$abonents = UtAbonent::find()->where(['id_kart' => $model->id])->all();
			foreach ($abonents as $abon) {
				$summa[$abon->id]=0;
				//-----------------------------------------------------------------------------
				$obor= UtObor::find()
//			$obor->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
				->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period']]);





//				$ff = ArrayHelper::toArray($obor);
				$dataProvider1 = new ActiveDataProvider([
					'query' => $obor,
				]);
				$dpobor[$abon->id] = $dataProvider1;
				//-----------------------------------------------------------------------------

				$oboropl= UtObor::find();
//  			    $obor->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);


				$oplab=UtOpl::find()
						->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
						->where(['ut_opl.id_abonent'=> $abon->id])
					    ->andwhere(['>', 'ut_opl.period', $session['period']])
						->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
					    ->asArray();

				$subQuery = (new \yii\db\Query())
					->from('ut_opl')
					->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
					->where(['ut_opl.id_abonent'=> $abon->id])
					->andwhere(['>', 'ut_opl.period', $session['period']])
					->groupBy('ut_opl.id_abonent, ut_opl.id_posl');



				$dolg= UtObor::find();
//					->select(["ut_obor.id_abonent as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
					$dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
//  				    $dolg->select('ut_obor.*,b.summ,');
     				$dolg->where(['ut_obor.id_abonent'=> $abon->id,'ut_obor.period'=> $session['period']]);
    				$dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();
//				    $dolg->join('LEFT JOIN', ['b' => $subQuery],  '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`');
//				    $dolg->join('LEFT JOIN', 'ut_opl',  '`ut_opl`.`id_abonent` = ut_obor.`id_abonent` and `ut_opl`.`id_posl`=`ut_obor`.`id_posl`');




//				$oboropl->leftJoin('ut_opl','(`ut_opl`.`id_abonent`=`ut_obor`.`id_abonent` and `ut_opl`.`id_posl`=`ut_obor`.`id_posl` and `ut_opl`.`period`= `ut_obor`.`period`)');
//				$oboropl->asArray();

				foreach($dolg->asArray()->all() as $obb)
				{
					if ($obb['dolgopl']>0)
					{
						$summa[$abon->id] = $summa[$abon->id] + $obb['dolgopl'];
					}
				}

//				$dolg= UtObor::find();
////			$obor->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
//				$dolg->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period']]);
//				$ff = ArrayHelper::toArray($obor);

				$dataProvider11 = new ActiveDataProvider([
					'query' => $dolg,
				]);
				$dpdolg[$abon->id] = $dataProvider11;






				//-----------------------------------------------------------------------------
//				$oborsum= UtObor::find();
//				$oborsum->select('sum(ut_obor.sal) as summ');
//				$oborsum->leftJoin('ut_abonent','(`ut_abonent`.`id`=`ut_obor`.`id_abonent`)');
//				$oborsum->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period']]);
////				$oborsum->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> "2018-10-01"]);
////				$oborsum->groupBy('ut_obor.period,ut_abonent.id');
//				$rrr = is_null($oborsum->asArray()->all()[0]['summ']) ? 0.00 : $oborsum->asArray()->all()[0]['summ'];
//				foreach($oborsum->asArray()->all() as $obb)
//				{
//					if ($obb['summ']>0)
//					{
//						$summa = $summa + $obb['summ'];
//					}
//				}



				//-----------------------------------------------------------------------------
				$opl = UtOpl::find();
				$opl->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_opl.period'=> $session['periodkab']]);
				$dataProvider2 = new ActiveDataProvider([
					'query' => $opl,
				]);

				$dpopl[$abon->id] = $dataProvider2;
				//-----------------------------------------------------------------------------
				$nar= UtNarah::find();
				$nar->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_narah.period'=> $session['periodkab']]);
				$dataProvider3 = new ActiveDataProvider([
					'query' => $nar,
				]);

				$dpnar[$abon->id] = $dataProvider3;
				//-----------------------------------------------------------------------------
				$pos = UtPosl::find();
				$pos->joinWith('abonent')->where(['ut_abonent.id' => $abon->id]);
				$dataProvider4 = new ActiveDataProvider([
					'query' => $pos,
				]);

				$dppos[$abon->id] = $dataProvider4;

				//-----------------------------------------------------------------------------
				$tar = UtTarif::find();
				$tar->select('ut_tarif.*,ut_tarifplan.tarifplan,ut_tarifplan.id as val');
				$tar->joinWith('utTarifabs')->where(['ut_tarifab.id_abonent' => $abon->id,'ut_tarifab.period'=> $session['periodkab']]);
				$tar->leftJoin('ut_tarifplan','(`ut_tarifplan`.`id_dom`=`ut_tarif`.`id_dom` and `ut_tarifplan`.`id_tipposl`=`ut_tarif`.`id_tipposl` and `ut_tarifplan`.`period`=`ut_tarif`.`period`)');



//				$tar->select('ut_tarifab.*')->where(['ut_tarifab.id_abonent' => $abon->id,'ut_tarifab.period'=> $session['periodkab']]);
//				$tar->joinWith('tarif0');


//				$tar= UtTarif::find();
//				$tar->select('ut_tarif.*,ut_tarifplan.tarifplan,ut_tarifplan.id as val');
//				$tar->joinWith('utTarifabs');
//				$tar->leftJoin('ut_tarifplan','(`ut_tarifplan`.`id_dom`=`ut_tarif`.`id_dom` and `ut_tarifplan`.`id_tipposl`=`ut_tarif`.`id_tipposl` and `ut_tarifplan`.`period`=`ut_tarif`.`period`)');
//				$tar->where(['ut_tarif.period' => Yii::$app->session['perioddom']]);
//				$tar->andWhere(['ut_tarifab.id_abonent' => $abon->id]);
//				$tar->orderBy(['ut_tarif.id_tipposl' => SORT_ASC]);
//
//                $rrr = $tar->asArray()->all();
//				$rrr1 = $tar1->asArray()->all();

				$dataProvider6 = new ActiveDataProvider([
					'query' => $tar,
				]);
				$tt = ArrayHelper::toArray($tar);
				$dptar[$abon->id] = $dataProvider6;

				$sub= UtObor::find();
//			$obor->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
				$sub->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['periodkab']]);
				$sub->andWhere(['<>','ut_obor.subs', 0]);


//				$sub = UtSubs::find();
//				$sub->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_subs.period'=> $session['periodkab']]);


				$dataProvider8 = new ActiveDataProvider([
					'query' => $sub,
				]);

				$dpsub[$abon->id] = $dataProvider8;

				$uder = UtUtrim::find();
				$uder->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_utrim.period'=> $session['periodkab']]);
				$dataProvider9 = new ActiveDataProvider([
					'query' => $uder,
				]);

				$dpuder[$abon->id] = $dataProvider9;



			}

//
//		$searchModel = new OrderSearch();
//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams); // run search, so now we have a totalSum.
//		$totalSum = $searchModel->totalSum;
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
			'dpdolg' => $dpdolg,
			'summa' => $summa,
			'lastperiod' => $session['period'],
		]);
	}



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
