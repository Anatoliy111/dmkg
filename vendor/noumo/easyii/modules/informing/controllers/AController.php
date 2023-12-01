<?php
namespace yii\easyii\modules\informing\controllers;

use app\models\UtAbonent;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\easyii\behaviors\SortableDateController;
use yii\easyii\models\Setting;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

use yii\easyii\components\Controller;
use yii\easyii\modules\informing\models\Informing;
use yii\easyii\modules\informing\api\InformingObject;
use yii\easyii\helpers\Image;
use yii\easyii\behaviors\StatusController;

use Viber\Bot;
use Viber\Api\Sender;
use app\models\Viber;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require (Yii::getAlias('@webroot'). '/viberbot/dmkgMenuSend.php');

class AController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => SortableDateController::className(),
                'model' => Informing::className(),
            ],
            [
                'class' => StatusController::className(),
                'model' => Informing::className()
            ]
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Informing::find()->sortDate(),
        ]);

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionCreate()
    {
        $model = new Informing;
        $model->time = time();

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES) && $this->module->settings['enableThumb']){
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if($model->image && $model->validate(['image'])){
                        $model->image = Image::upload($model->image, 'informing');
                    }
                    else{
                        $model->image = '';
                    }
                }
                if($model->save()){
                    $this->flash('success', Yii::t('easyii/informing', 'Informing created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = Informing::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES) && $this->module->settings['enableThumb']){
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if($model->image && $model->validate(['image'])){
                        $model->image = Image::upload($model->image, 'informing');
                    }
                    else{
                        $model->image = $model->oldAttributes['image'];
                    }
                }

                if($model->save()){
                    $this->flash('success', Yii::t('easyii/informing', 'Informing updated'));
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
//                return $this->refresh();
//                  return $this->redirect('index');
                return $this->redirect(['/admin/'.$this->module->id]);
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }

    public function actionPhotos($id)
    {
        if(!($model = Informing::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if(($model = Informing::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/informing', 'Informing deleted'));
    }

    public function actionClearImage($id)
    {
        $model = Informing::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        else{
            $model->image = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->image);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionUp($id)
    {
        return $this->move($id, 'up');
    }

    public function actionDown($id)
    {
        return $this->move($id, 'down');
    }

    public function actionOn($id)
    {
        return $this->changeStatus($id, Informing::STATUS_ON);
    }

    public function actionOff($id)
    {
        return $this->changeStatus($id, Informing::STATUS_OFF);
    }

    public function actionVisibleday()
    {
        if(\Yii::$app->request->isAjax and Yii::$app->request->isPost){
            $res = Yii::$app->request->post();
            if (array_key_exists('day', $res)) Setting::set('visible_informing',$res['day']);
        }
    }

    public function actionSendmess()
    {
        $informingmodel = Informing::find()->sortDate()->limit(1)->all();
        if ($informingmodel!=null) {
//    time

            $day = \yii\easyii\models\Setting::get('visible_informing');

//            if (date('Y-m-d', strtotime('+' . $day . ' days', $informingmodel[0]['time'])) >= date('Y-m-d', time())) {
            if ($informingmodel[0]['status'] <> 0 and date('Y-m-d', strtotime('+' . $day . ' days', $informingmodel[0]['time'])) >= date('Y-m-d', time())) {
                $log = new Logger('bot');
                $log->pushHandler(new StreamHandler(__DIR__ .'/viberbot/tmp/bot.log'));

                $informing = new InformingObject($informingmodel[0]);

                $apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742'; //dmkgBot
                $receivid = '78QXYFX3IiSsRdaPuPtF7Q=='; //dmkgBot
                $FindViber = Viber::find()->where(['viber.api_key' => $apiKey])
                    ->select('viber.id_receiver,viber.id_abonent')
//                    ->where(['=', 'viber.id_receiver','78QXYFX3IiSsRdaPuPtF7Q=='])
                    ->orderBy('viber.id')
                    ->all();

                $vibersend = 0;
                foreach ($FindViber as $abon)
                    $vibersend = $vibersend + getDmkgSend(strip_tags($informing->getText()), $abon);

                $this->flash('success', 'Відправлено '.$vibersend.' оголошень на Viber!!!');

                $FindEmail = UtAbonent::find()
                    ->where(['<>', 'email',''])
//                    ->andwhere(['=', 'email','bondyuk.a.g@gmail.com'])
                    ->orderBy('id')
                    ->all();

                $emailsend = 0;
                foreach ($FindEmail as $abon) {
                    $sent = Yii::$app->mailer
                        ->compose(
                            ['html' => 'user-inform-html'],
                            ['model' => $informing])
                        ->setTo($abon->email)
                        ->setFrom('supportdmkg@ukr.net')
                        ->setSubject('Оголошення ДМКГ!')
                        ->send();

                    if (!$sent) {
                        throw new \RuntimeException('Sending error.');
                    }
                    else $emailsend = $emailsend +1;


                }


                $this->flash('success', 'Відправлено '.$emailsend.' оголошень на Email, та '.$vibersend.' оголошень на Viber!!!');




            }
            else $this->flash('success', 'Оголошення застаріле!!!');
        } else $this->flash('success', 'Немає оголошень!!!');


        return $this->redirect('index');



    }

}