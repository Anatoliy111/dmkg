<?php

require_once (__DIR__ .'/botMenu.php');

//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/console.php';
new yii\web\Application($yiiConfig);


use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use app\models\KpcentrViberpokazn;
use app\models\UtKart;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtAbonkart;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\poslug\models\Viber;
use app\poslug\models\ViberAbon;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use yii\bootstrap\Html;

//echo "sdgsdgsd\n";



//$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';
$org = 'dmkg';

// ��� ����� ��������� ��� ��� (��� � ������ - ����� ������)
$botSender = new Sender([
    'name' => 'bondyukViberBot',
    'avatar' => '',
]);

// log bot interaction
$log = new Logger('bot');
$log->pushHandler(new StreamHandler(__DIR__ .'/tmp/bot.log'));

try {
    // create bot instance
    $bot = new Bot(['token' => $apiKey]);
    $bot
        // first interaction with bot - return "welcome message"
        ->onConversation(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('onConversation handler');
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText(' Вітаємо вас в вайбер боті КП "ДМКГ"!!!')
                ->setKeyboard(getKpMenu());
           // $mes = 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            message($bot, $botSender, $event, 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.', getKpMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getKpMenu());
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('onSubscribe handler');

            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
                ->setKeyboard(getKpMenu());

          //  $receiverId = $event->getSender()->getId();
          //  $mes = ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
        //    message($bot, $botSender, $event, $mes, getKpMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getKpMenu());
        })
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок:', getRahList($FindRah,'inf-rah'));
        })
        ->onText('|Pokazmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок по якому подати показник:', getRahList($FindRah,'pok-rah'));
        })
        ->onText('|Addrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'add-rah');
            message($bot, $botSender, $event, 'Вкажіть номер вашого особового рахунку:', getRahMenu());
        })
        ->onText('|Delrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок для видалення:', getRahList($FindRah,'del-rah'));
        })
        ->onText('|Rahmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Редагування рахунків:', getRahMenu());
        })
        ->onText('|Kontakt-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, infoKontakt(), getKpMenu());
        })
        ->onText('|KpMenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey, $org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Головне меню:', getKpMenu());
        })
        ->onText('|admin|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            verifyReceiver($event, $apiKey, $org);
            message($bot, $botSender, $event, 'Головне меню:', getKpMenu());
        })
        ->onText('|del-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
//            $match = [];
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $DelRah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $match[0][1]]);
            if ($DelRah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahMenu());
            else {
                $DelRah->delete();
                message($bot, $botSender, $event, 'Рахунок '.$match[0][1].' видалено з бота!', getRahMenu());
            }
        })
        ->onText('|inf-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $match[0][1]]);
            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'inf-rah'));
            else {
                message($bot, $botSender, $event, infoSchet($Rah->schet), getRahList($FindRah,'inf-rah'));
            }
        })
        ->onText('|pok-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $match[0][1]]);
            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'pok-rah'));
            else {
                message($bot, $botSender, $event, infoPokazn($Rah->schet), getRahList($FindRah,'pok-rah'));
                UpdateStatus($Receiv,'add-pok#'.$match[0][1]);
            }
        })
        ->onText('|add-pok#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if (count($match[0])==4 && $match[0][3]=='yes'){
                $addpok = addPokazn(intval($match[0][2]),$match[0][1],$event->getSender()->getName());
                if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник '.$match[0][2].' здано успішно!', getKpMenu());
                UpdateStatus($Receiv,'');
            }
        })
        ->onText('|privat24|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button privat24 ');
            message($bot, $botSender, $event, 'Дякуємо за вашу оплату!!! Нагадуємо, що дані в privat24 оновлюються один раз на місяць!', getKpMenu());
        })
        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log ,$apiKey, $org) {
            $log->info('onText ' . var_export($event, true));
            // .* - match any symbols
            $Receiv = verifyReceiver($event,$apiKey, $org);
           // message($bot, $botSender, $event, $event->getMessage()->getText(), getRahMenu());
            if ($Receiv == null || $Receiv->status == ''){
                message($bot, $botSender, $event, 'Не визначений запит:' . $event->getMessage()->getText(), null);
                message($bot, $botSender, $event, 'Головне меню:', getKpMenu());
            }
            else {
                preg_match_all('/([^#]+)/ui',$Receiv->status,$match);
                if ($match[0][0] == 'add-rah'){
                    $ModelAbon = KpcentrObor::findOne(['schet' => $event->getMessage()->getText(),'status' => 1]);
                    $ModelAbonReceiver = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $event->getMessage()->getText()]);
                    if ($ModelAbon != null && $ModelAbonReceiver == null)  {
                        UpdateStatus($Receiv,'verify-rah#'.$event->getMessage()->getText());
                        message($bot, $botSender, $event, 'Для підтвердження рахунку введіть прізвище власника рахунку:', getRahMenu());
                    }
                    elseif ($ModelAbon == null && $ModelAbonReceiver == null) {
                        message($bot, $botSender, $event, 'Вибачте, але цей рахунок не знайдено!!! Спробуйте ще', getRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                    elseif ($ModelAbon != null && $ModelAbonReceiver != null) {
                        message($bot, $botSender, $event, 'Цей рахунок вже під"єднано до бота!', getRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                }
                elseif ($match[0][0] == 'verify-rah'){
                    $ModelAbon = KpcentrObor::findOne(['schet' => $match[0][1],'status' => 1]);
                    if ($ModelAbon != null){
                            if (mb_strtolower($ModelAbon->fio) == mb_strtolower($event->getMessage()->getText())){
                                $addabon = addAbonReceiver($Receiv->id,$match[0][1],$org);
                                if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок '.$match[0][1].' під"єднано до бота', getRahMenu());
                                UpdateStatus($Receiv,'');
                            }
                            else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Спробуйте ще', getRahMenu());

                    }
                }
                elseif ($match[0][0] == 'add-pok'){
                    //  message($bot, $botSender, $event, 'add-pok', getKpMenu());
                        $ModelAbon = KpcentrObor::findOne(['schet' => $match[0][1], 'status' => 1]);
                        $FindRah = $Receiv->getViberAbons()->all();
                        if ($ModelAbon != null) {
                            $val = $event->getMessage()->getText();
                            if (is_numeric($val) && floor($val) == $val && $val > 0) {
                                $modelPokazn = KpcentrPokazn::findOne(['schet' => $match[0][1], 'status' => 1]);
                                if ($modelPokazn != null) {
                                    if ($modelPokazn->pokazn < intval($val)) {
                                        if ((intval($val) - $modelPokazn->pokazn) > 100) {
                                            message($bot, $botSender, $event, 'Вибачте, але ваш показник перевищує 100 кубів!!! Ви впевнені що бажаєте подати цей показник - ' . intval($val), getYesNoMenu('add-pok#'.$match[0][1].'#'.$val));
                                        } else {
                                            $addpok = addPokazn(intval($val), $match[0][1],$event->getSender()->getName());
                                            if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник ' . $val . ' здано успішно!', getKpMenu());
                                            UpdateStatus($Receiv, '');
                                        }
                                    } else message($bot, $botSender, $event, 'Вибачте, але значення показника меньше ніж останній показник!!! Спробуйте ще', getRahList($FindRah, 'pok-rah'));
                                } else {
                                    $addpok = addPokazn(intval($val), $match[0][1],$event->getSender()->getName());
                                    if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник ' . $val . ' здано успішно!', getKpMenu());
                                    UpdateStatus($Receiv, '');
                                }
                            } else message($bot, $botSender, $event, 'Вибачте, але значення не є цілим числом!!! Спробуйте ще', getRahList($FindRah, 'pok-rah'));

                        }

                }
                else{
                     message($bot, $botSender, $event, 'Не визначений статус: ' . $Receiv->status, getRahMenu());
                     UpdateStatus($Receiv,'');
                }

            }

        })
        ->on(function ($event) {
            return true; // match all
        }, function ($event) use ($log) {
            $log->info('Other event: ' . var_export($event, true));
        })
        ->run();
} catch (Exception $e) {
    $log->warning('Exception: ' . $e->getMessage());
    if ($bot) {
        $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
        $log->warning('Actual body: ' . $bot->getInputBody());
        echo $e->getMessage();

    }
}

function getRahMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#75F3AE')
                // ->setTextSize('small')
               // ->setTextSize('large')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody('Addrah-button')
                ->setText('Додати рахунок до бота'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                  ->setBgColor('#F39175')
                ->setTextHAlign('center')
              //  ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Delrah-button')
                ->setText('Видалити рахунок з бота'),

            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(4)
//                ->setRows(2)
                  ->setBgColor('#75C5F3')
                ->setTextSize('large')
               // ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('KpMenu-button')
           //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню')

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
                //->setText('Головне меню')
               // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

        ]);

}

function getYesNoMenu($action){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#75F3AE')
                // ->setTextSize('small')
                // ->setTextSize('large')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody($action.'#yes')
                ->setText('Так'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#F39175')
                ->setTextHAlign('center')
                //  ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('KpMenu-button')
                ->setText('Ні'),

            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(4)
//                ->setRows(2)
                ->setBgColor('#75C5F3')
                ->setTextSize('large')
                // ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('KpMenu-button')
                //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню')

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
            //->setText('Головне меню')
            // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

        ]);

}

function getRahList($FindRah,$action){

    $buttons = [];
    foreach ($FindRah as $Rah)
    {
        $buttons[] =
            (new \Viber\Api\Keyboard\Button())
                ->setBgColor('#F2AD50')
                ->setActionType('reply')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionBody($action.'#'.$Rah->schet)
                ->setText($Rah->schet);
    }

    $buttons[] =
    (new \Viber\Api\Keyboard\Button())
        ->setBgColor('#75C5F3')
        ->setTextSize('large')
        ->setTextHAlign('center')
        ->setTextVAlign('center')
        ->setActionType('reply')
        ->setActionBody('KpMenu-button')
        ->setText('🏠   Головне меню');

    return (new \Viber\Api\Keyboard())
        ->setButtons($buttons);
}

function message($bot, $botSender, $event, $mess, $menu){

    if ($menu != null){
        return $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setReceiver($event->getSender()->getId())
                ->setText($mess)
                ->setKeyboard($menu)
        );
    }
    else{
        return $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setReceiver($event->getSender()->getId())
                ->setText($mess)
        );
    }


}

function verifyReceiver($event, $apiKey, $org){

    $receiverId = $event->getSender()->getId();
    $receiverName = $event->getSender()->getName();
    $FindModel = Viber::findOne(['api_key' => $apiKey,'id_receiver' => $receiverId,'org' => $org]);
    if ($FindModel== null)
    {
        $model = new Viber();
        $model->api_key = $apiKey;
        $model->id_receiver = $receiverId;
        $model->name = $receiverName;
        $model->org = $org;
        if ($model->validate() && $model->save())
        {
            $FindModel = $model;
        }
        else
        {
            $messageLog = [
                'status' => 'Помилка додавання в підписника',
                'post' => $model->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $meserr='';
            foreach ($messageLog as $err){
                $meserr=$meserr.implode(",", $err);
            }
            getSend($meserr);

            $FindModel = null;

        }
    }

    return $FindModel;

}

function UpdateStatus($Model,$Status){

    if ($Model <> null)
    {
        if ((strlen($Status)==0 && strlen($Model->status)<>0) || (strlen($Status)<>0)) {

            $Model->status = $Status;
            if ($Model->validate() && $Model->save()) {
                return true;
            }
            else {
                $messageLog = [
                    'status' => 'Помилка додавання в підписника',
                    'post' => $Model->errors
                ];

                Yii::error($messageLog, 'viber_err');
                $meserr = '';
                foreach ($messageLog as $err) {
                    $meserr = $meserr . implode(",", $err);
                }
                getSend($meserr);

                return false;

            }
        }
        else return false;
    }
    else return false;

}

function addAbonReceiver($id_viber,$schet,$org){

    $FindModel = ViberAbon::findOne(['id_viber' => $id_viber,'id_utkart' => $id_kart]);
    if ($FindModel == null)
    {
        $model = new ViberAbon();
        $model->id_viber = $id_viber;
        $model->id_utkart = $id_kart;
        $model->schet = $schet;
        $model->org = $org;
        if ($model->validate() && $model->save())
        {
            return $model;
        }
        else
        {
            $messageLog = [
                'status' => 'Помилка додавання абонента',
                'post' => $model->errors
            ];

            Yii::error($messageLog, 'viber_err');

            return null;

        }
    }
    else return $FindModel;

}

/**
 * @param $schet
 */
function infoSchet($schet){

    $mess='';
    $modelKart = UtKart::findOne(['schet' => $schet]);
    $mess = 'Особовий рахунок - '.$schet."\r\n";
    $mess = $mess.$modelKart->fio . "\n";
    $mess = $mess.$modelKart->getUlica()->asArray()->one()['ul'].' буд.'.$modelKart->dom.' '.(isset($modelKart->kv)?'кв.'.$modelKart->kv:'')."\r\n";

    $abonen = UtAbonent::find()->where(['schet' => $schet])->orderBy('id_org')->one();
    $oplab=UtOpl::find()
        ->select('ut_opl.id_abonent, ut_opl.id_posl, sum(ut_opl.sum) as summ')
        ->where(['ut_opl.id_abonent'=> $abonen->id])
        ->andwhere(['>', 'ut_opl.period', $modelKart->lastperiod()])
        ->groupBy('ut_opl.id_abonent, ut_opl.id_posl')
        ->asArray();

    $dolg= UtObor::find();
//					->select(["ut_obor.id_abonent as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
    $dolg->select(["ut_obor.id_abonent as id", "ut_obor.*","round(COALESCE(b.summ,0),2) summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"]);
//  				    $dolg->select('ut_obor.*,b.summ,');
    $dolg->where(['ut_obor.id_abonent'=> $abonen->id,'ut_obor.period'=> $modelKart->lastperiod()]);
    $dolg->leftJoin(['b' => $oplab], '`b`.`id_abonent` = ut_obor.`id_abonent` and `b`.`id_posl`=`ut_obor`.`id_posl`')->all();
    $mess = $mess.'Ваша заборгованість по послугам:'."\n\r";
    $summa =0;
    foreach($dolg->asArray()->all() as $obb)
    {
        $mess = $mess.$obb['tipposl'].': '.$obb['sal']."\n";

        if ($obb['dolgopl']>0)
        {
            $summa = $summa + $obb['dolgopl'];
        }
    }

    $mess = $mess."\r".'Всього до сплати: '.$summa."\n";


    return $mess;

}

function infoPokazn($schet){

    $mess='';
    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    if ($modelPokazn!=null){
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn->date_pok))."\n";
        $mess = $mess.'Показник: '.$modelPokazn->pokazn."\n";
    }
    else $mess = 'Ваш останній останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Увага!!! Обробка показників триває протягом 1-3 днів:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\n";

    return $mess;

}

function infoKontakt(){
    $mess='Комунальне підприємство «Координаційний центр по обслуговуванню населення» при Долинській міській раді'."\n"."\n";

    $mess=$mess.'Адреса: Кіровоградська обл., Долинський р-н, місто Долинська, вул.Нова, будинок 80-А'."\n"."\n";

    $mess=$mess.'Телефон бухгалтерія: (067)696-88-18'."\n"."\n";
    $mess=$mess.'Телефон дитпетчер: (066)942-00-12'."\n"."\n";
    $mess=$mess.'Телефон контролери:'."\n";
    $mess=$mess.'(066)128-11-55 (Viber)'."\n";
    $mess=$mess.'(099)120-31-54'."\n";
    $mess=$mess.'(095)791-32-62'."\n"."\n";
    $mess = $mess.'e-mail: dkp_centr@ukr.net'."\n";

    return $mess;

}

/**
 * @param $pokazn
 * @param $schet
 * @return KpcentrViberpokazn|null
 */
function addPokazn($pokazn, $schet, $viber_name){

        $model = new KpcentrViberpokazn();
        $model->data = date('Y-m-d');
        $model->schet = $schet;
        $model->pokazn = $pokazn;
        $model->viber_name = $viber_name;
        if ($model->validate())
        {
            /** @var TYPE_NAME $model */

            $model->save();

            return $model;
        }
        else
        {
            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $model->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $meserr='';

            foreach ($messageLog as $err){
                $meserr=$meserr.implode(",", $err);
            }
            getSend($meserr);


            return null;

        }


}