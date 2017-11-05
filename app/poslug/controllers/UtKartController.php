<?php

namespace app\poslug\controllers;

use app\poslug\models\UtAbonent;
use app\poslug\models\UtOrg;
use kartik\mpdf\Pdf;
use Yii;
use app\poslug\models\UtKart;
use app\poslug\models\SearchUtKart;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
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
		$kart = $this->findModel($id);

		$query = UtAbonent::find();//->where(['id_kart' => $kart->id])->orderBy('id_org')->all();
		$query->where(['id_kart' => $kart->id])->orderBy('id_org');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if ($kart->load(Yii::$app->request->post())) {
			if ($kart->validate())
			{
				if (empty($kart->pass2))
					$kart->pass = "";
				else
				    $kart->pass =  md5($kart->pass2);
				$kart->save();
				if (!empty($kart->pass))
				{
					$this->actionReport($kart->id,$kart->pass2);
//				$pdf = Yii::$app->pdf;
//				$pdf->content = $this->renderPartial('viewPdf', [
//				'model' => $kart,
//			'dataProvider' =>$dataProvider,
//			'pass' => $kart->pass2,
//		]);
//				$pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
//				$pdf->cssInline = '.img-circle {border-radius: 50%;}';
//				$pdf->options = ['title' => $kart->fio,
//				'subject' => 'PDF'
//			];
//				$org = UtOrg::find()->One();
//				$pdf->methods = [
//				'SetHeader' => [$org->naim],
//				'SetFooter' => ['|{PAGENO}|'],
//			];
//				return $pdf->render();
				}
			}
//			return $this->redirect(['view', 'id' => $kart->id]);
		}

		return $this->render('view', [
				'model' => $kart,
				'dataProvider' =>$dataProvider,
			]);



    }

	public function actionKartPDF($id) {
		$this->layout = 'pdf';
		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
		$headers = Yii::$app->response->headers;
		$headers->add('Content-Type', 'application/pdf');

		$model = $this->findModel($id);

		//$model = $this->findModel();
		$pdf = new Pdf([
			'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
//			'content' => $this->render('viewpdf', ['model'=>$model]),
			'content' => $this->renderPartial('view', ['model'=>$model]),
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			'cssInline' => '.img-circle {border-radius: 50%;}',
			'options' => [
				'title' => $model->fio,
				'subject' => 'PDF'
			],
			'methods' => [
//				'SetHeader' => ['<img src="/images/inspire2_logo_20.png" class="img-circle"> Школа брейк данса INSPIRE||inspire2.ru'],
				'SetFooter' => ['|{PAGENO}|'],
			]
		]);
		return $pdf->render();
	}

	public function actionReport($id,$pass) {
		// get your HTML raw content without any layouts or scripts
		$kart = $this->findModel($id);
		$query = UtAbonent::find();//->where(['id_kart' => $kart->id])->orderBy('id_org')->all();
		$query->where(['id_kart' => $kart->id])->orderBy('id_org');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		$content = $this->renderPartial('viewPdf', [
			'model' => $kart,
			'dataProvider' =>$dataProvider,
			'pass'=>$pass,
		]);
		$org = UtOrg::find()->One();
		// setup kartik\mpdf\Pdf component
		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => Pdf::MODE_UTF8,
			// A4 paper format
			'format' => Pdf::FORMAT_A4,
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT,
			// stream to browser inline
			'destination' => Pdf::DEST_BROWSER,
			// your html content input
			'content' => $content,
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			'cssInline' => '.kv-heading-1{font-size:18px}',
			// set mPDF properties on the fly
			'options' => ['title' => $kart->fio,
			'subject' => 'PDF'
			],
			// call mPDF methods on the fly

			'methods' => [
				'SetHeader'=>[$org->naim],
				'SetFooter'=>['{PAGENO}'],
			]
		]);

		// return the pdf output as per the destination setting
		return $pdf->render();
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
     * Deletes an existing UtKart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//		try {
			$this->findModel($id)->delete();
//			return $this->redirect(['index']);
//		} catch (ErrorException $e) {
//			throw new \yii\web\HttpException(451,
//				'Tom McFarlin\'s humor is often lost on me
//              (and lots of people).');
////			Yii::warning("Видалення не можливе");
//		}
        return $this->redirect(['index']);
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
}
