<?php

namespace app\poslug\controllers;

use app\poslug\models\UtTarifinfo;
use Yii;
use app\poslug\models\UtTarifplan;
use app\poslug\models\SearchUtTarifplan;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\validators\Validator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }





	public function actionTarinfo($id)
	{

		$model = $this->findModel($id);

		$tarinfo = UtTarifinfo::find();
		$tarinfo->where(['id_tarifplan' => $id])->orderBy(['id_tarifvid' => SORT_ASC]);
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

	public function actionCalculateinfo($id)
	{
		$Tarifplan=$this->findModel($id);
		$suminfo = UtTarifinfo::find()->select('sum(tarifplan) as summ')->where(['id_tarifplan'=>$Tarifplan->id])->groupBy('id_tarifplan')->asArray()->all();
		$Tarifplan->tarifplan = $suminfo[0]['summ'];
		$Tarifplan->save();


		return $this->redirect(['tarinfo','id'=>$Tarifplan->id]);
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

	public function actionCreatetarinfo($id)
	{
		$model = new UtTarifinfo();
		$model->id_tarifplan = $id;

		$vls = $model->validators;
		$vnew = Validator::createValidator('in', $model, ['id_tarifvid'], ['range' => UtTarifinfo::find()->select('id_tarifvid')->where(['id_tarifplan' => $id])->asArray()->column(),'not'=>true,'message' => 'Такий вид тарифу вже додано !!!']);
		$vls->append($vnew);
		// Ajax
		$request = \Yii::$app->getRequest();
		if ($request->isAjax && $model->load($request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
		// General use
		if ($model->load($request->post()) && $model->save()) {
			return $this->redirect(['tarinfo','id'=>$id]);
		} else {
			return $this->renderAjax('createtarinfo', [
				'model' => $model,
			]);
		}
//		return true;



	}



	public function actionUpdateinfo($id)
	{
		$model = $this->findModelinfo($id);

		$vls = $model->validators;
		$vnew = Validator::createValidator('in', $model, ['id_tarifvid'], ['range' => UtTarifinfo::find()->select('id_tarifvid')->where(['id_tarifplan' => $model->id_tarifplan])->andWhere(['<>','id_tarifvid',$model->id_tarifvid])->asArray()->column(),'not'=>true,'message' => 'Такий вид тарифу вже додано !!!']);
		$vls->append($vnew);
		// Ajax
		$request = \Yii::$app->getRequest();
		if ($request->isAjax && $model->load($request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
		// General use
		if ($model->load($request->post()) && $model->save()) {
			return $this->redirect(['tarinfo','id'=>$model->id_tarifplan]);
//			return $this->redirect(Yii::$app->request->referrer);
		} else {
			return $this->renderAjax('createtarinfo', [
				'model' => $model,
			]);

		}

	}

	public function actionValidate($id)
	{
		$model = new UtTarifinfo();
		$model->id_tarifplan = $id;
		$request = \Yii::$app->getRequest();
		if ($request->isAjax && $model->load($request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
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
		if ($vidinfo<>null)
		{
			$vidinfo->delete();
		}


		$info = $vidinfo->id_tarifplan;

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
