<?php

namespace app\controllers;

use app\models\SearchUtKart;
use app\models\UtAbonent;
use app\models\SearchUtAbonent;
use app\models\UtAbonkart;
use app\models\UtAuth;
use app\models\UtKart;
use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\UtPeriod;
use app\poslug\models\UtPosl;
use app\poslug\models\UtTarif;
use app\poslug\models\UtUtrim;
use Yii;
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
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if ($session['model']<>null)
        {
            return $this->redirect(['kabinet', 'id' => $session['model']->id]);
        }
        $modeladres = new SearchUtKart();

        $modelemail = new SearchUtAbonent();
        $findmodel = null;


        Yii::$app->session['periodkab']=null;

        $modeladres->scenario = 'adres';
        $dataProviderAdres = $modeladres->search(Yii::$app->request->queryParams);

        $modelemail->scenario = 'auth';
        $dataProviderEmail = $modelemail->searchauth(Yii::$app->request->queryParams);

        $tab='';
        $message='';
        $modalformheader='';
        $modalformtext='';
        $modalformimage='';

        if (isset($_SESSION['modalmess'])) {
            if (array_key_exists('errtokenpass',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('errtokenauth',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('erremail',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('emailauth',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('updpass',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('addabon',$_SESSION['modalmess'])) $tab='email';
            if (array_key_exists('emailfog',$_SESSION['modalmess'])) $tab='email';
        }

        if (array_key_exists('SearchUtKart', Yii::$app->request->queryParams))  {

            $tab='adres';

            if ($dataProviderAdres->getTotalCount() <> 0){
                $modeladres->scenario = 'password';
                $findmodel = $modeladres->searchPass(Yii::$app->request->queryParams,$dataProviderAdres);
                if ($findmodel == 'bad') $message='notadrespass';
            }
            else $message='notadres';

        }

        if (array_key_exists('SearchUtAbonent', Yii::$app->request->queryParams))  {

            $tab='email';

            if ($dataProviderEmail->getTotalCount() <> 0){
                $findmodel = $dataProviderEmail->getModels()[0];
            }
            else $message='notemail';
        }

        if ($findmodel <> null and $findmodel <> 'bad'){

            $session['model'] = $findmodel;
            return $this->redirect(['kabinet', 'id' => $findmodel->id]);
        }



            return $this->render('index', [
                'modeladres' => $modeladres,
                'modelemail' => $modelemail,
                'dataProviderAdres' => $dataProviderAdres,
                'dataProviderEmail' => $dataProviderEmail,
                'tab' => $tab,
                'message' => $message,
            ]);

    }



    public function actionKabinet()
    {
//		$session = Yii::$app->session;
//		if (isset($_POST['UtKart']['MonthYear']))
//		{ $session['period'] = $_POST['UtKart']['MonthYear'];}

        $id=null;
        $idkart=null;

        $get = Yii::$app->request->get();
        //$get = Yii::$app->request->post();

        if (array_key_exists('id', $get)) {
            $id = $get["id"];
        }
        else $id = 0;


        if (array_key_exists('idkart', $get)) {
            $idkart = $get["idkart"];
        }


        if (Yii::$app->session['periodkab']==null)
            Yii::$app->session['periodkab']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;
//		if (Yii::$app->session['period']==null)
        Yii::$app->session['period']=UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->one()->period;

//		Yii::$app->session['periodkab']=UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one()->period;
////		if (Yii::$app->session['period']==null)
//		Yii::$app->session['period']=UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one()->period;

        $model = $this->findModel($id);
        $session = Yii::$app->session;
        if ($session['model']==null || $model==null || $session['model']->id<>$model->id)
        {
            $session['model']=null;
            return $this->redirect(['ut-abonent/index']);
        }

		$model->scenario = 'password';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->pass =  md5($model->id.trim($model->pass2));
            $model->passopen = trim($model->pass2);
            $model->date_pass = date('Y-m-d');

            $model->save();
            $session->setFlash('pass', 'Пароль змінено');
            return $this->redirect(['kabinet','id' => $id,'idkart' => $idkart]);
        }

        $modelrah= new SearchUtKart();
        $modelrah->scenario = 'rahunok';
        if ($modelrah->load(Yii::$app->request->post()) && $modelrah->validate()) {
            $modelkart = new UtAbonkart();
            $modelkart->id_abon = $id;
            $modelkart->id_kart = $modelrah->id;
            $modelkart->schet = $modelrah->schet;
            $modelkart->save();
        }


//        $dataProviderAdres = $modelrah->searchrah(Yii::$app->request->queryParams);


        $modelemail = new SearchUtAbonent();

        $modelemail->scenario = 'chemail';
        $emailchange = '';

        if ($modelemail->load(Yii::$app->request->post()) && $modelemail->validate()) {
            $modelauth = new UtAuth();
            $modelauth->scenario = 'email';
            $modelauth->id_abonent = $model->id;
            $modelauth->fio = $model->fio;
            $modelauth->email = $modelemail->email;
            $modelauth->authtoken = md5($model->email.time());
            $modelauth->vid = 'emailchange';
            if ($modelauth->validate()) {
                $modelauth->save();

                $sent = Yii::$app->mailer
                    ->compose(
                        ['html' => 'user-changeemail-html'],
                        ['model' => $modelauth])
                    ->setTo($modelauth->email)
                    ->setFrom('supportdmkg@ukr.net')
                    ->setSubject('Зміна пошти на сайті ДМКГ в кабінеті споживача!')
                    ->send();

                if (!$sent) {
                    throw new \RuntimeException('Sending error.');
                }
                $_SESSION['modalmess']['emailchange']=$modelauth;
            }


        }
        elseif ($modelemail->hasErrors()) $emailchange = 'error';

        $model->pass1 = '';
        $model->pass2 = '';



//        $abonen = UtAbonkart::find()->where(['id' => $model->id])->orderBy('id_org');
//
//
//
//
//        $summa = array();
//
//        $dpinfo = new ActiveDataProvider([
//            'query' => $abonen,
//        ]);
        $abonents = UtAbonkart::find()->where(['id_abon' => $model->id])->all();

        if ($abonents<>null) {

                if ($idkart == null)
                    $idkart = $abonents[0]->id_kart;

                $abon = UtKart::find()->where(['id' => $idkart])->all()[0];

                $summa = 0;
                //-----------------------------------------------------------------------------
                $obor = UtObor::find()
    //			$obor->joinWith('kart')->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
                    ->joinWith('kart')->where(['ut_kart.id' => $idkart, 'ut_obor.period' => $session['periodkab']]);


    //				$ff = ArrayHelper::toArray($obor);
                $dataProvider1 = new ActiveDataProvider([
                    'query' => $obor,
                ]);
                $dpobor = $dataProvider1;
                //-----------------------------------------------------------------------------

                $oplab = UtOpl::find()
                    ->select('ut_opl.id_kart, ut_opl.id_posl, sum(ut_opl.sum) as summ')
                    ->where(['ut_opl.id_kart' => $idkart])
                    ->andwhere(['>', 'ut_opl.period', $session['period']])
                    ->groupBy('ut_opl.id_kart, ut_opl.id_posl')
                    ->asArray();

                $subQuery = (new \yii\db\Query())
                    ->from('ut_opl')
                    ->select('ut_opl.id_kart, ut_opl.id_posl, sum(ut_opl.sum) as summ')
                    ->where(['ut_opl.id_kart' => $idkart])
                    ->andwhere(['>', 'ut_opl.period', $session['period']])
                    ->groupBy('ut_opl.id_kart, ut_opl.id_posl');


                $dolg = UtObor::find();
    //					->select(["ut_obor.id_kart as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
                $dolg->select(["ut_obor.id_kart as id", "ut_obor.*", "round(COALESCE(b.summ,0),2) summ", "round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
    //  				    $dolg->select('ut_obor.*,b.summ,');
                $dolg->where(['ut_obor.id_kart' => $idkart, 'ut_obor.period' => $session['period']]);
                $dolg->leftJoin(['b' => $oplab], '`b`.`id_kart` = ut_obor.`id_kart` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();
    //				    $dolg->join('LEFT JOIN', ['b' => $subQuery],  '`b`.`id_kart` = ut_obor.`id_kart` and `b`.`id_posl`=`ut_obor`.`id_posl`');
    //				    $dolg->join('LEFT JOIN', 'ut_opl',  '`ut_opl`.`id_kart` = ut_obor.`id_kart` and `ut_opl`.`id_posl`=`ut_obor`.`id_posl`');


    //				$oboropl->leftJoin('ut_opl','(`ut_opl`.`id_kart`=`ut_obor`.`id_kart` and `ut_opl`.`id_posl`=`ut_obor`.`id_posl` and `ut_opl`.`period`= `ut_obor`.`period`)');
    //				$oboropl->asArray();

                foreach ($dolg->asArray()->all() as $obb) {
                    if ($obb['dolgopl'] > 0) {
                        $summa = $summa + $obb['dolgopl'];
                    }
                }

    //				$dolg= UtObor::find();
    ////			$obor->joinWith('kart')->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
    //				$dolg->joinWith('kart')->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> $session['period']]);
    //				$ff = ArrayHelper::toArray($obor);

                $dataProvider11 = new ActiveDataProvider([
                    'query' => $dolg,
                ]);
                $dpdolg = $dataProvider11;


                //-----------------------------------------------------------------------------
    //				$oborsum= UtObor::find();
    //				$oborsum->select('sum(ut_obor.sal) as summ');
    //				$oborsum->leftJoin('ut_abonent','(`ut_abonent`.`id`=`ut_obor`.`id_kart`)');
    //				$oborsum->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> $session['period']]);
    ////				$oborsum->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> "2018-10-01"]);
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
                $opl->joinWith('kart')->where(['ut_kart.id' => $idkart, 'ut_opl.period' => $session['periodkab']]);
                $dataProvider2 = new ActiveDataProvider([
                    'query' => $opl,
                ]);

                $dpopl = $dataProvider2;
                //-----------------------------------------------------------------------------
                $nar = UtNarah::find();
                $nar->joinWith('kart')->where(['ut_kart.id' => $idkart, 'ut_narah.period' => $session['periodkab']]);
                $dataProvider3 = new ActiveDataProvider([
                    'query' => $nar,
                ]);

                $dpnar = $dataProvider3;
                //-----------------------------------------------------------------------------
                $pos = UtPosl::find();
                $pos->joinWith('kart')->where(['ut_kart.id' => $idkart]);
                $dataProvider4 = new ActiveDataProvider([
                    'query' => $pos,
                ]);

                $dppos = $dataProvider4;

                //-----------------------------------------------------------------------------
                $tar = UtTarif::find();
                $tar->select('ut_tarif.*,ut_tarifplan.tarifplan,ut_tarifplan.id as val');
                $tar->joinWith('utTarifabs')->where(['ut_tarifab.id_kart' => $idkart, 'ut_tarifab.period' => $session['periodkab']]);
                $tar->leftJoin('ut_tarifplan', '(`ut_tarifplan`.`id_dom`=`ut_tarif`.`id_dom` and `ut_tarifplan`.`id_tipposl`=`ut_tarif`.`id_tipposl` and `ut_tarifplan`.`period`=`ut_tarif`.`period`)');


    //				$tar->select('ut_tarifab.*')->where(['ut_tarifab.id_kart' => $abon->id,'ut_tarifab.period'=> $session['periodkab']]);
    //				$tar->joinWith('tarif0');


    //				$tar= UtTarif::find();
    //				$tar->select('ut_tarif.*,ut_tarifplan.tarifplan,ut_tarifplan.id as val');
    //				$tar->joinWith('utTarifabs');
    //				$tar->leftJoin('ut_tarifplan','(`ut_tarifplan`.`id_dom`=`ut_tarif`.`id_dom` and `ut_tarifplan`.`id_tipposl`=`ut_tarif`.`id_tipposl` and `ut_tarifplan`.`period`=`ut_tarif`.`period`)');
    //				$tar->where(['ut_tarif.period' => Yii::$app->session['perioddom']]);
    //				$tar->andWhere(['ut_tarifab.id_kart' => $abon->id]);
    //				$tar->orderBy(['ut_tarif.id_tipposl' => SORT_ASC]);
    //
    //                $rrr = $tar->asArray()->all();
    //				$rrr1 = $tar1->asArray()->all();

                $dataProvider6 = new ActiveDataProvider([
                    'query' => $tar,
                ]);
                $dptar = $dataProvider6;

                $sub = UtObor::find();
    //			$obor->joinWith('kart')->where(['ut_kart.id' => $abon->id,'ut_obor.period'=> $session['period'][$org->id_org]]);
                $sub->joinWith('kart')->where(['ut_kart.id' => $idkart, 'ut_obor.period' => $session['periodkab']]);
                $sub->andWhere(['<>', 'ut_obor.subs', 0]);


    //				$sub = UtSubs::find();
    //				$sub->joinWith('kart')->where(['ut_kart.id' => $abon->id,'ut_subs.period'=> $session['periodkab']]);


                $dataProvider8 = new ActiveDataProvider([
                    'query' => $sub,
                ]);

                $dpsub = $dataProvider8;

                $uder = UtUtrim::find();
                $uder->joinWith('kart')->where(['ut_kart.id' => $idkart, 'ut_utrim.period' => $session['periodkab']]);
                $dataProvider9 = new ActiveDataProvider([
                    'query' => $uder,
                ]);

                $dpuder = $dataProvider9;


    //
    //		$searchModel = new OrderSearch();
    //		$dataProvider = $searchModel->search(Yii::$app->request->queryParams); // run search, so now we have a totalSum.
    //		$totalSum = $searchModel->totalSum;
    //		$dpinfo = new ActiveDataProvider([
    //			'query' => $abonen,
    //		]);

            return $this->render('kabinet', [
                'modelrah' => $modelrah,
                'abon' => $abon,
                'modelemail' => $modelemail,
                'emailchange' => $emailchange,
                'model' => $model,
                'abonents' => $abonents,
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
                'periodkab' => $session['periodkab'],
            ]);

        }

        return $this->render('kabinet', [
            'modelrah' => $modelrah,
            'model' => $model,
            'modelemail' => $modelemail,
            'emailchange' => $emailchange,
            'abonents' => $abonents,
            'lastperiod' => $session['period'],
            'periodkab' => $session['periodkab'],
        ]);
    }

    public function actionConfirmSignup($authtoken)
    {
        if (($modelauth = UtAuth::findOne(['authtoken' => $authtoken])) !== null) {
            if (($modelabon = UtAbonent::findOne(['email' => $modelauth->email])) == null) {
                $modelabon = new UtAbonent();
                $modelabon->scenario = 'confreg';
                $modelabon->fio = trim($modelauth->fio);
                $modelabon->email = trim($modelauth->email);

                $modelabon->pass = md5($modelabon->id . trim($modelauth->pass));
                $modelabon->passopen = trim($modelauth->pass);
                $modelabon->date_pass = date('Y-m-d');
                if ($modelabon->validate() && $modelabon->save()) {
                    UtAuth::deleteAll('email = :email', [':email' => $modelabon->email]);
                    $_SESSION['modalmess']['addabon']=$modelabon;
                }
            }
            else $_SESSION['modalmess']['erremail']=$modelauth;
        } else  $_SESSION['modalmess']['errtokenauth']='';

        return $this->redirect(['index']);
    }

    public function actionConfirmPass($authtoken)
    {
         $modelauth = new UtAuth();
        if (($modelauth = UtAuth::findOne(['authtoken' => $authtoken])) !== null) {
            if (($modelabon = UtAbonent::findOne(['email' => $modelauth->email])) !== null) {
                $modelabon->scenario = 'password';
                if ($modelabon->load(Yii::$app->request->post()) && $modelabon->validate()) {

                    $modelabon->pass =  md5($modelabon->id.trim($modelabon->pass2));
                    $modelabon->passopen = trim($modelabon->pass2);
                    $modelabon->date_pass = date('Y-m-d');
                    $modelabon->save();
                    UtAuth::deleteAll('email = :email', [':email' => $modelabon->email]);
                    $_SESSION['modalmess']['updpass']=$modelauth;
                } else return $this->render('updatepass', ['model' => $modelabon]);
            }
        } else $_SESSION['modalmess']['errtokenpass']='';

        return $this->redirect(['index']);
    }

    public function actionFogotpass()
    {

        $modelemail = new SearchUtAbonent();

        $modelemail->scenario = 'email';
        if ($modelemail->load(Yii::$app->request->post()) && $modelemail->validate()) {
            if (($modelabon = UtAbonent::findOne(['email' => $modelemail->email])) !== null) {
                $model = new UtAuth();
                $model->scenario = 'email';
                $model->id_abonent = $modelabon->id;
                $model->fio = $modelabon->fio;
                $model->email = $modelabon->email;
                $model->authtoken = md5($model->email . time());
                $model->vid = 'fogpass';
                if ($model->validate()) {
                    $model->save();
                    $email = $model->email;

                    $sent = Yii::$app->mailer
                        ->compose(
                            ['html' => 'user-fogpass-html'],
                            ['model' => $model])
                        ->setTo($email)
                        ->setFrom('supportdmkg@ukr.net')
                        ->setSubject('Відновлення пароля на сайті ДМКГ!')
                        ->send();

                    if (!$sent) {
                        throw new \RuntimeException('Sending error.');
                    }
                    $_SESSION['modalmess']['emailfog']=$model;

                    return $this->redirect(['index']);
                }
            }
//            else $message='notemail';

        }
//        else $message='notemail';



        return $this->render('fogpass', [
            'model' => $modelemail,
        ]);
    }

    public function actionChangeEmail($authtoken)
    {
        $modelauth = new UtAuth();
        if (($modelauth = UtAuth::findOne(['authtoken' => $authtoken])) !== null) {
            if (($modelabon = UtAbonent::findOne([$modelauth->id_abonent])) !== null) {
                    $modelabon->scenario = 'email';
                    $modelabon->email = trim($modelauth->email);
                    $modelabon->save();
                    UtAuth::deleteAll('email = :email', [':email' => $modelabon->email]);
                    $_SESSION['modalmess']['changeemailsuccess']=$modelabon;
            }
        } else $_SESSION['modalmess']['errtokenchemail']='';

        return $this->redirect(['index']);
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

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->destroy();
        return $this->redirect(['ut-abonent/index']);
    }


    /**
     * Creates a new UtAbonent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionReg()
    {

        $message='';
        $modelemail = new SearchUtAbonent();

        $modelemail->scenario = 'reg';
//        $dataProviderEmail = $modelemail->searchemail(Yii::$app->request->bodyParams);
        if ($modelemail->load(Yii::$app->request->post()) && $modelemail->validate()) {
                $model = new UtAuth();
                $model->scenario = 'reg';
                $model->fio = $modelemail->fio;
                $model->email = $modelemail->email;
                $model->authtoken = md5($modelemail->email.time());
                $model->vid = 'authsite';
                $model->pass = $modelemail->pass1;

                        if ($model->validate()) {
                            $model->save();

                            $sent = Yii::$app->mailer
                                ->compose(
                                    ['html' => 'user-signup-comfirm-html'],
                                    ['model' => $model])
                                ->setTo($model->email)
                                ->setFrom('supportdmkg@ukr.net')
                                ->setSubject('Реєстрація на сайті ДМКГ!')
                                ->send();

                            if (!$sent) {
                                throw new \RuntimeException('Sending error.');
                            }
                            $_SESSION['modalmess']['emailauth']=$model;
                            return $this->redirect(['index']);

                        }



        }
        return $this->render('create', [
            'model' => $modelemail,
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

//        throw new NotFoundHttpException('The requested page does not exist.');

        return $model=null;
    }

    protected function findModelwithKart($id)
    {
        if (($model = UtAbonent::findOne(['id_kart' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
