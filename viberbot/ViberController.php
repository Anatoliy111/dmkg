<?php

namespace viberbot\controllers;

//require_once(__DIR__ . '/../viberbot/myBot.php');


use app\models\UtAbonent;

use app\models\UtAuth;

use app\models\Viber;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Exception;

/**
 * UtAbonentController implements the CRUD actions for Viber model.
 */
class ViberController extends Controller
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


    public function actions()
    {
        $session = Yii::$app->session;
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionConfirmSignupviber($authtoken)
    {
        if (($modelauth = UtAuth::findOne(['authtoken' => $authtoken])) !== null) {
            $Receiv = Viber::findOne(['id_receiver' => $modelauth->id_receiver]);
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
                    if ($Receiv != null) getSend('Вітаємо '.$modelabon->fio.'! Ви здійснили процедуру реєстрацію в кабінеті споживача ДМКГ. Тепер Вам доступні всі послуги. Також з цим логіном та паролем ви можете здійснювати вхід в кабінет споживача на сайті dmkg.com.ua.',$Receiv);
                    $_SESSION['modalmess']['addabon']=$modelabon;
                }
            }
            else {
                if ($Receiv != null) getSend('Вибачте але ваша пошта вже зареєстрована. Виконайте вхід використовуючи вашу пошту '.$modelauth->email.' і пароль!!!',$Receiv);
                $_SESSION['modalmess']['erremail']=$modelauth;
            }
        } else $_SESSION['modalmess']['errtokenauth']='';

        return $this->redirect(['index']);
    }
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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


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
