<?php

namespace app\poslug\controllers;

use Yii;
use app\poslug\models\UtOlddom;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtOlddomController implements the CRUD actions for UtOlddom model.
 */
class UtOlddomController extends Controller
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
     * Lists all UtOlddom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UtOlddom::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UtOlddom model.
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
     * Creates a new UtOlddom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UtOlddom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UtOlddom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

	public function actionUpdateall()
	{

		$Model = new UtOlddom();
        $dataProvider = new ActiveDataProvider([
            'query' => UtOlddom::find(),
			'pagination' => [
				'pagesize' => 100
			],
        ]);
//	Yii::$app->session->set('FilterUtUlica',Yii::$app->request->queryParams);

//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
//	if 	(Yii::$app->session->get('Action')['action'] = 'index' and Yii::$app->session->get('Action')['cont'] = 'ut-ulica')
//	{
//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->session->get('FilterUtUlica'));
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
		if (UtOlddom::loadMultiple($models, Yii::$app->request->post()) && UtOlddom::validateMultiple($models)) {
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
				'Model'=>$Model
			]);
		}
	}

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
     * Deletes an existing UtOlddom model.
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
     * Finds the UtOlddom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UtOlddom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UtOlddom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
