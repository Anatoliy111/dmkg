<?php

namespace app\controllers;

use app\models\DolgDom;
use app\models\DolgNtarif;
use app\models\DolgObor;
use app\models\DolgPeriod;
use app\models\DOLGVWTAR;
use app\models\Obor;
use app\models\UtKart;
use app\poslug\models\DolgOborNow;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtDominfo;
use app\poslug\models\UtObor;
use app\poslug\models\UtTarif;
use app\poslug\models\UtTarifinfo;
use app\poslug\models\UtTarifplan;
use Yii;
use app\poslug\models\UtDom;
use app\models\SearchDolgDom;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
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
        $session = Yii::$app->session;
        $session['perioddom']=null;

		$searchModel = new SearchDolgDom();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $doms = $dataProvider->getModels();

     //   $rrr2 = $dataProvider->asArray()->all();

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

		$model = $this->findTarifplan($id);

		$tarinfo = UtTarifinfo::find();
		$tarinfo->where(['id_tarifplan' => $id]);
		$tarinfo->andWhere(['!=', '`ut_tarifinfo`.`tarifplan`+`ut_tarifinfo`.`tariffact`', 0]);
		$tarinfo->orderBy(['id_tarifvid' => SORT_ASC]);
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->id_vidpokaz = $model->tipposl->id_vidpokaz;
			$model->save();
		}


		$dataProvider = new ActiveDataProvider([
			'query' => $tarinfo,
			'sort' => false,
			'pagination' => [
				'pageSize' => 40,
			],
		]);


		return $this->renderAjax('tarinfo', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);
    }


	public function actionView($kl_ul,$nomdom)
	{
		$model = $this->findModel($kl_ul,$nomdom);
        $session = Yii::$app->session;
        $period=DolgPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one()->period;
		if (Yii::$app->session['perioddom']==null)
            $session['perioddom']=$period;


//        $nach = Obor::find();
//        $nach->select('obor.period, obor.wid, obor.kl_ntar,wid.naim poslug,wid.vid,wid.npp,sum(obor.dolg) dolg,sum(obor.nach+obor.pere+obor.wozw) fullnach,sum(obor.OPL+obor.UDER+obor.KOMP+obor.WZMZ) oplnotsubs,sum(obor.subs) subs,sum(obor.sal) sal');
//        $nach->leftJoin('kart','(obor.schet=kart.schet and kart.upd=1)');
//        $nach->leftJoin('wid','(obor.wid=wid.wid)');
//        $nach->where(['kart.kl_ul' => $kl_ul, 'kart.nomdom' => $nomdom, 'obor.period' => $session['perioddom'], 'obor.upd'=>1]);
//        $nach->andWhere(['is not','obor.kl_ntar', null]);
//        $nach->orderBy('wid.npp');
//        $nach->groupBy('obor.period, obor.wid, obor.kl_ntar,wid.naim,wid.vid,wid.npp');

        $nach2 = Yii::$app->dolgdb->createCommand('select obor.period, obor.wid, obor.kl_ntar,wid.naim poslug,wid.vid,wid.npp,sum(obor.dolg) dolg,sum(obor.nach+obor.pere+obor.wozw) fullnach,sum(obor.OPL+obor.UDER+obor.KOMP+obor.WZMZ) oplnotsubs,sum(obor.subs) subs,sum(obor.sal) sal from obor left join wid on (obor.wid=wid.wid) left join kart on (obor.schet=kart.schet and kart.upd=1) where kart.kl_ul =\''.$kl_ul.'\' and kart.nomdom =\''. $nomdom.'\' and obor.period =\''.$session['perioddom'].'\' and  obor.upd=1 and obor.kl_ntar is not null group by obor.period, obor.wid, obor.kl_ntar,wid.naim,wid.vid,wid.npp order by wid.npp')->QueryAll();

        $dPnach = new ArrayDataProvider([
            'allModels' => $nach2,
        ]);


//        $res = $nach->asArray()->all();
//        $arrkl = [];
//
        foreach ($nach2 as $kl){
            $arrkl[] = $kl['kl_ntar'];
        }

//        $dPnach = new ActiveDataProvider([
//			'query' => $nach,
//		]);
        $tardom = DOLGVWTAR::find();
        $tardom->select('period,name,tarif tartarif,norma tarnorma,naim,vid');
        $tardom->where(['in', 'kl', $arrkl]);
        $tardom->andwhere(['period' => $session['perioddom']]);
        $tardom->andwhere(['not', ['tarif' => null]]);
        $tardom->andwhere(['<>', 'tarif', 0]);
        $tardom->orderBy('npp')->asArray()->all();
//        $res2 = $tardom1->asArray()->all();
//
//        $tardom = DolgNtarif::find();
////        $tardom->select('*');
//        $tardom->select('ntarif.period,ntarif.name,ntarif.tarif tartarif,ntarif.norma tarnorma,wid.naim,wid.vid');
////        $tardom->select('ntarif.period,ntarif.name,ntarif.tarif tartarif,ntarif.norma tarnorma,wid.naim,wid.vid');
//        $tardom->leftJoin('wid','(ntarif.wid=wid.wid)');
//        leftJoin('wid','(`nach`.`wid`=`wid`.`wid`)');
//   //    $tardom->where(['ntarif.period' => $session['perioddom'], 'ntarif.upd'=>1]);
//        $tardom->where(['in', 'ntarif.kl', $arrkl]);
//        $tardom->andwhere(['ntarif.period' => $session['perioddom'], 'ntarif.upd'=>1]);
//      //  $tardom->andWhere(['not', ['ntarif.wid' => null]]);
//        $tardom->orderBy('wid.npp')->asArray()->all();

		$dPtarif= new ActiveDataProvider([
			'query' => $tardom,
		]);

//        $dPtarif = new ArrayDataProvider([
//            'allModels' => Yii::$app->dolgdb->createCommand('select * from ntarif left join wid as widd on (ntarif.wid=widd.wid) where ntarif.period=\''.$period.'\' and ntarif.kl=\''.$arrkl.'\' and ntarif.upd=1 order by widd.npp')->QueryAll(),
//        ]);

//        $vodadom = DolgNtarif::find();
//        $vodadom->select('*');
//        $vodadom->leftJoin('wid','(ntarif.wid=wid.wid)');
//        $vodadom->where(['ntarif.period' => $session['perioddom'], 'ntarif.upd'=>1,'ntarif.kl'=>$arrkl]);
//        $vodadom->orderBy('wid.npp')->asArray()->all();
//
//
////        $res2 = $tardom->asArray()->all();
//
//        $dPvoda= new ActiveDataProvider([
//            'query' => $vodadom,
//        ]);

//        $tt = ArrayHelper::toArray($dPtarif);

		return $this->render('view', [
			'model' => $model,
//			'dominfo' => $dominfo,
			'dPtarif' => $dPtarif,
			'dPnach' => $dPnach,
		]);
	}

    /**
     * Creates a new UtDom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */






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
    protected function findModel($kl_ul,$nomdom)
    {
        if (($model = DolgDom::find()->where(['kl_ul'=>$kl_ul, 'nomdom'=>$nomdom])->one()) !== null) {
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

	protected function findTarifPlan($id)
	{
		if (($model = UtTarifplan::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
