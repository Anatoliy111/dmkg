<?php

namespace app\controllers;

use app\models\UtAbonent;
use app\models\SearchUtAbonent;
use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\UtPeriod;
use app\poslug\models\UtPosl;
use app\poslug\models\UtTarif;
use app\poslug\models\UtUtrim;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtAbonentController implements the CRUD actions for UtAbonent model.
 */
class UtAbonentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UtAbonent models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if ($session['model']<>null)
        {
            return $this->redirect(['kabinet', 'id' => $session['model']->id]);
        }

        $searchModel = new SearchUtAbonent();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UtAbonent model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UtAbonent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UtAbonent();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UtAbonent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UtAbonent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UtAbonent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UtAbonent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtAbonent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionKabinet($id)
    {

        if (Yii::$app->session['periodkab']==null)
            Yii::$app->session['periodkab']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;
        Yii::$app->session['period']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;

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



        $abonen = \app\poslug\models\UtAbonent::find()->where(['id_kart' => $model->id])->orderBy('id_org');




        $summa = array();

        $dpinfo = new ActiveDataProvider([
            'query' => $abonen,
        ]);
        $abonents = UtAbonent::find()->where(['id_kart' => $model->id])->all();
        foreach ($abonents as $abon) {
            $summa[$abon->id]=0;
            //-----------------------------------------------------------------------------
            $obor= UtObor::find()
                ->joinWith('abonent')->where(['ut_abonent.id' => $abon->id,'ut_obor.period'=> $session['periodkab']]);





            $dataProvider1 = new ActiveDataProvider([
                'query' => $obor,
            ]);
            $dpobor[$abon->id] = $dataProvider1;
            //-----------------------------------------------------------------------------

            $oboropl= UtObor::find();


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
            $dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
            $dolg->where(['ut_obor.id_abonent'=> $abon->id,'ut_obor.period'=> $session['period']]);
            $dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();

            foreach($dolg->asArray()->all() as $obb)
            {
                if ($obb['dolgopl']>0)
                {
                    $summa[$abon->id] = $summa[$abon->id] + $obb['dolgopl'];
                }
            }

            $dataProvider11 = new ActiveDataProvider([
                'query' => $dolg,
            ]);
            $dpdolg[$abon->id] = $dataProvider11;


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

}
