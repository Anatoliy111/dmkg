<?php

require_once (__DIR__ .'/botMenu.php');

//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/web.php';
new yii\web\Application($yiiConfig);



use app\models\HVoda;
use app\models\Pokazn;
use app\models\UtAbonpokazn;
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
    'name' => 'MyBot',
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
                ->setKeyboard(getMyMenu());
            // $mes = 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            message($bot, $botSender, $event, 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.', getMyMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getMyMenu());
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('onSubscribe handler');

            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
                ->setKeyboard(getMyMenu());

            //  $receiverId = $event->getSender()->getId();
            //  $mes = ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
            //    message($bot, $botSender, $event, $mes, getMyMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getMyMenu());
        })
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getEditRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок111:', getRahList($FindRah,'inf-rah'));
        })
        ->onText('|Pokazmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getEditRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок по якому подати показник:', getRahList($FindRah,'pok-rah'));
        })
        ->onText('|Addrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'add-rah');
            message($bot, $botSender, $event, 'Вкажіть номер вашого особового рахунку:', getEditRahMenu());
        })
        ->onText('|Delrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getEditRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок для видалення:', getRahList($FindRah,'del-rah'));
        })
        ->onText('|EditRah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Редагування рахунків:', getEditRahMenu());
        })
        ->onText('|Kontakt-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, infoKontakt(), getMyMenu());
        })
        ->onText('|DmkgMenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey, $org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Головне меню:', getMyMenu());
        })
        ->onText('|admin|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            verifyReceiver($event, $apiKey, $org);
            message($bot, $botSender, $event, 'Головне меню:', getMyMenu());
        })
        ->onText('|del-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
//            $match = [];
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $DelRah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $match[0][1]]);
            if ($DelRah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getEditRahMenu());
            else {
                $DelRah->delete();
                message($bot, $botSender, $event, 'Рахунок '.$match[0][1].' видалено з бота!', getEditRahMenu());
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
                if (!isset($match[0][2]))
                message($bot, $botSender, $event, 'Інформація по рахунку '.$Rah->schet.' Виберіть потрібну функцію з меню:', getRahMenu($Rah->schet));
                else{
                  if ($match[0][2]=='borg') message($bot, $botSender, $event, infoDmkgSchet($Rah->schet), getRahMenu($Rah->schet));
                  if ($match[0][2]=='opl') message($bot, $botSender, $event, infoOpl($Rah->schet), getRahMenu($Rah->schet));
                  if ($match[0][2]=='pokhv') message($bot, $botSender, $event, infoPokhv($Rah->schet), getRahMenu($Rah->schet));
                  if ($match[0][2]=='addpokhv') {
                      message($bot, $botSender, $event, infoPokazn($Rah->schet), getRahMenu($Rah->schet));
                      UpdateStatus($Receiv,'add-pok#'.$match[0][1]);
                  }
                }
//                message($bot, $botSender, $event, infoDmkgSchet($Rah->schet), getRahList($FindRah,'inf-rah'));
            }
        })
        ->onText('|add-pok#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if (count($match[0])==4 && $match[0][3]=='yes'){
                $addpok = addPokazn(intval($match[0][2]),$match[0][1],$event->getSender()->getName());
                if ($addpok[0] == 'ok') {
                    message($bot, $botSender, $event, $addpok[1], getRahMenu($match[0][1]));
                    UpdateStatus($Receiv, '');
                }
                if ($addpok[0] == 'err') message($bot, $botSender, $event, $addpok[1], getRahMenu($match[0][1]));
            }
        })
        ->onText('|privat24|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button privat24 ');
            message($bot, $botSender, $event, 'Дякуємо за вашу оплату!!! Нагадуємо, що дані в privat24 оновлюються один раз на місяць!', getMyMenu());
        })
        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log ,$apiKey, $org) {
            $log->info('onText ' . var_export($event, true));
            // .* - match any symbols
            $Receiv = verifyReceiver($event,$apiKey, $org);
            // message($bot, $botSender, $event, $event->getMessage()->getText(), getEditRahMenu());
            if ($Receiv == null || $Receiv->status == ''){
                message($bot, $botSender, $event, 'Не визначений запит:' . $event->getMessage()->getText(), null);
                message($bot, $botSender, $event, 'Головне меню:', getMyMenu());
            }
            else {
                preg_match_all('/([^#]+)/ui',$Receiv->status,$match);
                if ($match[0][0] == 'add-rah'){
                    $ModelKart = UtKart::findOne(['schet' => $event->getMessage()->getText()]);
                    $ModelAbonReceiver = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $event->getMessage()->getText()]);
                    if ($ModelKart != null && $ModelAbonReceiver == null)  {
                        UpdateStatus($Receiv,'verify-rah#'.$event->getMessage()->getText());
                        message($bot, $botSender, $event, 'Для підтвердження рахунку введіть прізвище власника рахунку:', getEditRahMenu());
                    }
                    elseif ($ModelKart == null && $ModelAbonReceiver == null) {
                        message($bot, $botSender, $event, 'Вибачте, але цей рахунок не знайдено!!! Спробуйте ще', getEditRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                    elseif ($ModelKart != null && $ModelAbonReceiver != null) {
                        message($bot, $botSender, $event, 'Цей рахунок вже під"єднано до бота!', getEditRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                }
                elseif ($match[0][0] == 'verify-rah'){

                    $ModelKart = UtKart::findOne(['schet' => $match[0][1]]);
                    if ($ModelKart != null){
                        if (mb_strtolower($ModelKart->name_f) == mb_strtolower($event->getMessage()->getText())){
                            $addabon = addAbonReceiver($Receiv->id,$match[0][1],$ModelKart->id,$org);
                            if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок '.$match[0][1].' під"єднано до бота', getEditRahMenu());
                            UpdateStatus($Receiv,'');
                        }
                        else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Спробуйте ще', getEditRahMenu());
                    }

                }
                elseif ($match[0][0] == 'add-pok'){
                    //  message($bot, $botSender, $event, 'add-pok', getMyMenu());
                    $FindRah = $Receiv->getViberAbons()->all();
                        $val = $event->getMessage()->getText();
                        if (is_numeric($val) && floor($val) == $val && $val > 0) {
                            $voda = HVoda::find()->where(['schet' => $match[0][1]])->orderBy(['kl' => SORT_DESC])->one();
                                    if ((intval($val) - $voda['sch_razn']) > 100) {
                                        message($bot, $botSender, $event, 'Вибачте, але ваш показник перевищує 100 кубів!!! Ви впевнені що бажаєте подати цей показник - ' . intval($val), getYesNoMenu('add-pok#'.$match[0][1].'#'.$val));
                                    } else {
                                        $addpok = addPokazn(intval($val), $match[0][1],$event->getSender()->getName());
                                        if ($addpok[0] == 'ok') {
                                            message($bot, $botSender, $event, $addpok[1], getRahMenu($match[0][1]));
                                            UpdateStatus($Receiv, '');
                                        }
                                        if ($addpok[0] == 'err') message($bot, $botSender, $event, $addpok[1], getRahMenu($match[0][1]));
                                    }
                        } else message($bot, $botSender, $event, 'Вибачте, але значення не є цілим числом!!! Спробуйте ще', getRahMenu($match[0][1]));
                }
                else{
                    message($bot, $botSender, $event, 'Не визначений статус: ' . $Receiv->status, getRahMenu($match[0][1]));
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

function getEditRahMenu(){

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
                ->setBgColor('#F2F3A7')
                ->setTextSize('large')
                // ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('DmkgMenu-button')
                //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню')

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
            //->setText('Головне меню')
            // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

        ]);

}

function getRahMenu($schet){

    $modelKart = UtKart::findOne(['schet' => $schet]);
    $lastperiod = UtObor::find()->max('period');
    $buttons = [];
    $hv = UtObor::find()
        ->leftJoin('ut_posl', '(`ut_posl`.`id`=`ut_obor`.`id_posl`)')
        ->leftJoin('ut_tipposl', '(`ut_tipposl`.`id`=`ut_posl`.`id_tipposl`)')
        ->where(['ut_obor.id_kart' => $modelKart->id, 'ut_obor.period' =>$lastperiod , 'ut_tipposl.old_tipusl' => 'hv'])
        ->asArray()->all();


    $buttons[] =
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#75F3AE')
                // ->setTextSize('small')
                // ->setTextSize('large')
                ->setTextHAlign('center')
                ->setActionType('reply')
                ->setActionBody('inf-rah#'.$schet.'#borg')
                ->setText('Заборгованість');

    $buttons[] =
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#F39175')
                ->setTextHAlign('center')
                //  ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('inf-rah#'.$schet.'#opl')
                ->setText('Оплата');

            if ($hv != null) {
                 $buttons[] =
                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    ->setBgColor('#F39175')
                    ->setTextHAlign('center')
                    //  ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('inf-rah#' . $schet . '#pokhv')
                    ->setText('Показники (хол.вода)');
                $buttons[] =
                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    ->setBgColor('#F39175')
                    ->setTextHAlign('center')
                    //  ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('inf-rah#' . $schet . '#addpokhv')
                    ->setText('Подати показник (хол.вода)');
            }

            $buttons[] =
            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(4)
//                ->setRows(2)
                ->setBgColor('#F2F3A7')
                ->setTextSize('large')
                // ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('DmkgMenu-button')
                //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню');

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
            //->setText('Головне меню')
            // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

    return (new \Viber\Api\Keyboard())
        ->setButtons($buttons);

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
                ->setActionBody('DmkgMenu-button')
                ->setText('Ні'),

            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(4)
//                ->setRows(2)
                ->setBgColor('#F2F3A7')
                ->setTextSize('large')
                // ->setTextSize('regular')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('DmkgMenu-button')
                //     ->setText("<br><font color=\"#494E67\">Головне меню</font>")
                ->setText('🏠   Головне меню')

//                ->setText("<font color=\"#494E67\">Головне меню</font>")
//                ->setText("<img src=\"https://dmkg.com.ua/uploads/home_small.png\" width=\"20\" height=\"20' alt='Головне меню'>")
            //->setText('Головне меню')
            // ->setImage("https://dmkg.com.ua/uploads/home_small2.png"),

        ]);

}


//92519753
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
            ->setBgColor('#F2F3A7')
            ->setTextSize('large')
            ->setTextHAlign('center')
            ->setTextVAlign('center')
            ->setActionType('reply')
            ->setActionBody('DmkgMenu-button')
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

function addAbonReceiver($id_viber,$schet,$id_kart,$org){

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

function infoPokhv($schet){
    $mess='';
    $modelPokazn = HVoda::find()->where(['schet' => $schet])->limit(6)->asarray()->All();

    if ($modelPokazn!=null){
        $mess = $mess.'Ваші зареєстровані показники за останні 6 місяців :'."\n";
//        $mess = $mess."Період обліку: ".date('d.m.Y',strtotime($modelPokazn->date_pok))."\n";
//        $mess = $mess.'Показник: '.$modelPokazn->pokazn."\n";

    }
    else $mess = 'Ваш останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\n";

    return $mess;

}

function infoPokazn($schet){

    $mess='';
    $modelPokazn = HVoda::find()->where(['schet' => $schet])->orderBy('kl')->one();
    if ($modelPokazn!=null){
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn->date_pok))."\n";
        $mess = $mess.'Показник: '.$modelPokazn->pokazn."\n";
    }
    else $mess = 'Ваш останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\n";

    return $mess;

}

function infoKontakt(){
    $mess='Комунальне підприємство «Долинське міське комунальне господарство» при Долинській міській раді'."\n"."\n";

    $mess=$mess.'Адреса: Кіровоградська обл., Долинський р-н, місто Долинська, вул.Нова, будинок 80-А'."\n"."\n";

    //  $mess=$mess.'Телефон бухгалтерія: (067)696-88-18'."\n"."\n";
    $mess=$mess.'Телефон дитпетчер:'."\n";
    $mess=$mess.'(067) 520-87-30'."\n";
    $mess=$mess.'(066) 942-00-12'."\n";
    $mess=$mess.'Телефон контролери:'."\n";
    $mess=$mess.'(095)062-68-89 (Viber)'."\n"."\n";
    //   $mess=$mess.'(099)120-31-54'."\n";
    // $mess=$mess.'(095)791-32-62'."\n"."\n";
    $mess = $mess.'e-mail: dmkg28500@ukr.net'."\n";

    return $mess;

}

/**
 * @param $pokazn
 * @param $schet
 * @return UtAbonpokazn|null
 * @return Pokazn|null
 */
function addPokazn($pokazn, $schet, $viber_name){

    $lasdatehvd = Yii::$app->fdb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll();
    $nowdate = intval(date('Y').date('m'));

    if ($lasdatehvd[0]['yearmon']<$nowdate) {
        $modelabonpokazn = new UtAbonpokazn();
        $modelabonpokazn->schet = $schet;
        $modelabonpokazn->name = $viber_name;
        $modelabonpokazn->id_abonent = 2071;
        $modelabonpokazn->date_pok = date("Y-m-d");
        $modelabonpokazn->pokazn = $pokazn;
        $modelabonpokazn->vid = 'viber';
        if ($modelabonpokazn->validate())
        {
            /** @var TYPE_NAME $modelabonpokazn */

            $modelabonpokazn->save();
            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';


            return $mess;
        }
        else
        {
            $meserr='';
            $errors = $modelabonpokazn->getErrors();
            foreach ($errors as $error) {
                $meserr=$meserr.implode(",", $error);
            }

            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelabonpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }
    } elseif ($lasdatehvd[0]['yearmon']==$nowdate)  {
        $modelpokazn = new Pokazn();
        $modelpokazn->schet = iconv('UTF-8', 'windows-1251', $_SESSION['abon']->schet);
        $modelpokazn->yearmon =$nowdate;
        $modelpokazn->date_pok = null;
        $modelpokazn->vid_pok = 37;
        $modelpokazn->pokazn = $pokazn;
        if ($modelpokazn->validate())
        {
            /** @var TYPE_NAME $modelpokazn */

            $modelpokazn->save();

            Yii::$app->fdb->createCommand("execute procedure calc_pok(:schet)")->bindValue(':schet', $modelpokazn->schet)->execute();
            $voda = HVoda::find()->where(['schet' => $modelpokazn->schet])->orderBy(['kl' => SORT_DESC])->one();

            $mess =[];
            $mess[0]='ok';
            $mess[1]='Вітаємо '.$viber_name.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' зараховано! Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';


            return $mess;
        }
        else
        {
            $meserr='';
            $errors = $modelpokazn->getErrors();
            foreach ($errors as $error) {
                $meserr=$meserr.implode(",", $error);
            }

            $messageLog = [
                'status' => 'Помилка додавання показника',
                'post' => $modelpokazn->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $mess =[];
            $mess[0]='err';
            $mess[1]=$meserr;
            return $mess;

        }

    }


}