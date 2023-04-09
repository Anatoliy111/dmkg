<?php

namespace app\poslug\controllers;

use Yii;
use app\poslug\models\UtUlica;
use app\poslug\models\SearchUtUlica;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * UtUlicaController implements the CRUD actions for UtUlica model.
 */
class UtUlicaController extends Controller
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
     * Lists all UtUlica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUtUlica();

//		if 	(Yii::$app->session->get('Action')['action'] = 'update' and Yii::$app->session->get('Action')['cont'] = 'ut-ulica')
//		{
//			$dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//		}
//		else
//		{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//		}


//		if (Yii::$app->request->queryParams<>null)
//		{
//			$action = ['action'=>Yii::$app->controller->action->id,'cont'=>Yii::$app->controller->id];
////		$action = ['cont'=>Yii::$app->controller->id];
//			Yii::$app->session->set('FilterUtUlica',Yii::$app->request->queryParams);
//			Yii::$app->session->set('Action',$action);
//		}
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//        Yii::$app->get
//        $session = Yii::$app->session;
//          $getsort = Yii::$app->request->getQueryParam('sort');
//          $getfilter = Yii::$app->request->getQueryParam('SearchUtUlica');
//          if ($getsort <> null or  $getfilter <> null)
//          {
//              $session->set('sort1',$getsort);
//          }
        Yii::$app->session->set('FilterUtUlica',Yii::$app->request->queryParams);
//        if ($session->has('UtUlica'))
//        {
////              if
////            $session['UtUlica'] = [
////                'SearchUtUlica' => $_GET['SearchUtUlica'],
////                'sort' => $_GET['sort'],
////            ];
//
//        }
//        $language = isset($_SESSION['UtUlica']) ? $_SESSION['UtUlica'] : null;
//        $session['captcha'] = [
//            'number' => 5,
//            'lifetime' => 3600,
//        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single UtUlica model.
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
     * Creates a new UtUlica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtUlica();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtUlica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

    public function actionUpdateall()
    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//        $searchModel = new SearchUtUlica();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//        $dataProvider = new ActiveDataProvider([
//            'query' => UtOlddom::find(),
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//        ]);
//        $searchModel = new UtUlica();
        $searchModel = new SearchUtUlica();
//        $dataProvider = new ActiveDataProvider([
//            'query' => UtUlica::find(),
//        ]);
//	Yii::$app->session->set('FilterUtUlica',Yii::$app->request->queryParams);

//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//	if 	(Yii::$app->session->get('Action')['action'] = 'index' and Yii::$app->session->get('Action')['cont'] = 'ut-ulica')
//	{
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//	}
//	else
//	{
//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams,null);
//	}

    $mod = $dataProvider->getModels();
//        &moddd = array();
//    if (Yii::$app->request->queryParams<>null and Yii::$app->request->queryParams[''] )
//	{
//		$action = ['action'=>Yii::$app->controller->action->id,'cont'=>Yii::$app->controller->id];
////		$action = ['cont'=>Yii::$app->controller->id];
//		Yii::$app->session->set('FilterUtUlica',Yii::$app->request->queryParams);
//		Yii::$app->session->set('Action',$action);
//	}
    foreach ($mod as $index => $model)
    {
            $qq = $model->getAttributes();
            $models[$qq['id']] = $model;
            unset($qq);
//        &moddd[$model[id]] = $model->getAttributes();
    }
    if (UtUlica::loadMultiple($models, Yii::$app->request->post()) && UtUlica::validateMultiple($models)) {
        $count = 0;
        foreach ($models as $index => $model) {
            // populate and save records for each model

            if ($model->save()) {
                $count++;
            }
        }
        Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");

        return $this->redirect(['index']); // redirect to your next desired page
    } else {
        return $this->render('updateall', [
            'dataProvider'=>$dataProvider,
            'searchModel'=>$searchModel
        ]);
    }
    }

    /**
     * Deletes an existing UtUlica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

//        return $this->redirect(['index']);
//        return $this->redirect([Yii::$app->request->referrer]);
        return $this->renderContent(['index']);
    }

    /**
     * Finds the UtUlica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtUlica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtUlica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
