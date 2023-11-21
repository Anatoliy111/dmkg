<?php

require_once (__DIR__ .'/dmkgMenuSend.php');

//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/web.php';
new yii\web\Application($yiiConfig);


use app\models\DolgKart;
use app\models\HVoda;
use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use app\models\KpcentrViberpokazn;
use app\models\Pokazn;
use app\models\UtAbonpokazn;
use app\models\UtAuth;
use app\models\UtKart;
use app\models\UtAbonent;
use app\models\UtAbonkart;
use app\poslug\models\UtObor;
use app\poslug\models\UtOpl;
use app\models\Viber;
use app\models\ViberAbon;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use yii\bootstrap\Html;

//echo "sdgsdgsd\n";



//$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
//$apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742'; //dmkgBot
$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';  //myBot
$org = 'dmkg';
$period=Yii::$app->dolgdb->createCommand('select first 1 period from period order by period desc')->QueryAll()[0]["period"];
$lasdatehvd = Yii::$app->hvddb->createCommand('select first 1 yearmon from data order by yearmon desc')->queryAll()[0]['yearmon'];

$botSender = new Sender([
    'name' => 'dmkgBot',
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
            $log->info('onConversation handler'. var_export($event, true));
            $context = $event->getContext();
            $mes = ' Вітаємо вас в вайбер боті'."\n";
            $mes = $mes.'КП "ДМКГ"!!!'."\n";
            $mes = $mes.'Натисніть кнопку Почати"!!!'."\n";
           return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText($mes)
                ->setKeyboard(getDmkgMenuStart($context));
//            $mes = ' Вітаємо вас в вайбер боті КП "ДМКГ"!!!'."\n";
//
//            try{
//                $Receiv = verifyReceiver($event, $apiKey, $org);
//                $mes = $mes.'Оберіть потрібну функцію кнопками нижче.';
//                return (new \Viber\Api\Message\Text())
//                    ->setSender($botSender)
//                    ->setText($mes)
//                    ->setKeyboard(getDmkgMenuOS($Receiv));
//            }
//            catch(\Exception $e){
//                $mes = $mes.' Натисніть кнопку Почати"!!!'."\n";
//                return (new \Viber\Api\Message\Text())
//                    ->setSender($botSender)
//                    ->setText($mes)
//                    ->setKeyboard(getDmkgMenuStart());
//            }

            // $mes = 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            message($bot, $botSender, $event, 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.', getDmkgMenuOS($Receiv));
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getDmkgMenuOS($Receiv));
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('onSubscribe handler');
//            $Receiv = verifyReceiver($event, $apiKey, $org);
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
            ->setKeyboard(getDmkgMenuOS(null));

            //  $receiverId = $event->getSender()->getId();
            //  $mes = ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
            //    message($bot, $botSender, $event, $mes, getDmkgMenuOS($Receiv));
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getDmkgMenuOS($Receiv));
        })
        ->onText('|Start-button#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('Start-button'. var_export($event, true));
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Receiv = verifyReceiver($event, $apiKey, $org);
//            message($bot, $botSender, $event, $event->getMessage()->getText(), getDmkgMenuOS($Receiv));

            if ($Receiv->id_abonent<>0 and count($match[0]) == 2)  {
                $abon = UtAbonent::findOne($Receiv->id_abonent);
                $abon2 = UtAbonent::findOne($match[0][1]);
                if ($abon->id == $abon2->id) {
                    message($bot, $botSender, $event, 'Ви вже підписані на кабінет споживача ' . $abon->email . '!!!', getDmkgMenuOS($Receiv));
                } else message($bot, $botSender, $event, 'Ви вже підписані на кабінет споживача ' .$abon->id. $abon->email . '!!! Бажаєте змінити профіль на '.$abon2->id.$abon2->email .'?', getYesNoMenu('editprof#'.$match[0][1]));
            }
            else {
                if (count($match[0]) == 2) {
                    $Receiv->id_abonent = $match[0][1];
                    $Receiv->save();
                }
                UpdateStatus($Receiv, '');
                if ($Receiv->id_abonent <> 0) {
                    $abon = UtAbonent::findOne($Receiv->id_abonent);
                    message($bot, $botSender, $event, 'Дякуємо що підписалися на наш бот! ' . $abon->fio . ' ви вже зареєстровані в кабінеті споживача, оберіть потрібну функцію кнопками нижче.', getDmkgMenuOS($Receiv));
                } else message($bot, $botSender, $event, 'Дякуємо що підписалися на наш бот! Ви поки що не зареєстровані в кабінеті споживача. Натисніть кнопку Авторизація/Реєстрація для початку процедури реєстрації!', getDmkgMenuOS($Receiv));
            }
        })
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
              $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) $FindRah = $Receiv->getViberAbons()->all();
            else $FindRah = $Receiv->getUtAbonkart()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок:', getRahList($FindRah,'inf-rah'));
        })
        ->onText('|Pokazmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) message($bot, $botSender, $event, 'Подати показник по воді мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
            else {
                $FindRah = $Receiv->getUtAbonkart()->all();
                if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
                else message($bot, $botSender, $event, 'Виберіть рахунок по якому подати показник:', getRahList($FindRah, 'pok-rah'));
            }
        })
        ->onText('|Auth-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv, 'auth-email');
            message($bot, $botSender, $event, 'Напишіть вашу ел.пошту - email:'."\n".' (якщо ви вже реєструвались на сайті dmkg.com.ua, вкажіть пошту з якою ви реєструвались в кабінеті споживача):', getDmkgMenuOS($Receiv));
//            }
        })
        ->onText('|Addrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            if ($Receiv->id_abonent==0) message($bot, $botSender, $event, 'Додати рахунок мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
            else {
                UpdateStatus($Receiv, 'add-rah');
                message($bot, $botSender, $event, 'Напишіть номер вашого особового рахунку:', getRahMenu());
            }
        })
        ->onText('|Delrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) $FindRah = $Receiv->getViberAbons()->all();
            else $FindRah = $Receiv->getUtAbonkart()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок для видалення:', getRahList($FindRah,'del-rah'));
        })
        ->onText('|Rahmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Редагування рахунків:', getRahMenu());
        })
        ->onText('|Kontakt-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, infoKontakt(), getDmkgMenuOS($Receiv));
        })
        ->onText('|Prof-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $abon = UtAbonent::findOne(['id' => $Receiv->id_abonent]);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, infoProf($Receiv,$abon), getProfMenu($abon));
        })
        ->onText('|Exit-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $modelabon = UtAbonent::findOne(['id' => $Receiv->id_abonent]);
            if ($modelabon != null)  {
                message($bot, $botSender, $event, 'Ви дійсно бажаєте вийти з кабінета споживача - ' . $modelabon->email. ' ?', getYesNoMenu('exit#'.$Receiv->id));
            }
            else message($bot, $botSender, $event, 'Ви дійсно бажаєте вийти з кабінета споживача?', getYesNoMenu('exit#'.$Receiv->id));

//            UpdateStatus($Receiv,'');

        })
        ->onText('|DmkgMenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey, $org) {
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Головне меню:', getDmkgMenuOS($Receiv));
//            message($bot, $botSender, $event, 'Головне меню:'.$Receiv->id,null);
        })
        ->onText('|admin|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('admin'. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
            message($bot, $botSender, $event, 'Головне меню:', getDmkgMenuOS($Receiv));
        })
        ->onText('|editprof#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('edit kab '. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv, '');
//            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if (count($match[0]) == 2) {
                $Receiv->id_abonent = $match[0][1];
                $Receiv->save();
                $abon = UtAbonent::findOne($Receiv->id_abonent);
                message($bot, $botSender, $event, 'Вітаємо! Ви змінили профіль користувача на ' . $match[0][1] . $abon->email . ' ' . $abon->fio . '!!!', getDmkgMenuOS($Receiv));
            }else message($bot, $botSender, $event, 'Виникла помилка при зміні профілю. Спробуйте ще!', getDmkgMenuOS($Receiv));
        })
        ->onText('|del-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('del-rah'. var_export($event, true));
//            $match = [];
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) $DelRah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => $match[0][1]]);
            else $DelRah = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => trim($match[0][1])]);
            if ($DelRah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahMenu());
            else {
                $DelRah->delete();
                message($bot, $botSender, $event, 'Рахунок '.$match[0][1].' видалено з кабінета!', getRahMenu());
            }
        })
        ->onText('|inf-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org,$period) {
            $log->info('inf-rah'. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');


            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if ($Receiv->id_abonent==0) {
                $FindRah = $Receiv->getViberAbons()->all();
                $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => trim($match[0][1])]);
            }
            else {
                $FindRah = $Receiv->getUtAbonkart()->all();
                $Rah = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => trim($match[0][1])]);
            }
            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'inf-rah'));
            else {
                message($bot, $botSender, $event, infoSchetOS($Rah->schet,$period), getRahList($FindRah,'inf-rah'));
//                message($bot, $botSender, $event, $Rah->schet, getRahList($FindRah,'inf-rah'));
            }
        })
        ->onText('|pok-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org,$lasdatehvd) {
            $log->info('pok-rah'. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);

            if ($Receiv->id_abonent==0) {
                $FindRah = $Receiv->getViberAbons()->all();
                $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => trim($match[0][1])]);
            }
            else {
                $FindRah = $Receiv->getUtAbonkart()->all();
                $Rah = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => trim($match[0][1])]);
            }

            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'pok-rah'));
            else {
                $schet1251 = trim(iconv('UTF-8', 'windows-1251', $Rah->schet));
                $hv=Yii::$app->hvddb->createCommand('select * from h_voda where yearmon=\''.$lasdatehvd.'\' and schet=\''.$schet1251.'\'')->QueryAll();
                if ($hv != null) {
                    message($bot, $botSender, $event, infoPokazn($Rah->schet,$lasdatehvd), getRahList($FindRah, 'pok-rah'));
                    UpdateStatus($Receiv, 'add-pok#' . $match[0][1]);
                }
                else {
                    message($bot, $botSender, $event, 'По рахунку '.$Rah->schet. ' немає послуги холодна вода', getRahList($FindRah, 'pok-rah'));
                    UpdateStatus($Receiv, '');
                }
            }
        })
        ->onText('|add-pok#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org,$lasdatehvd) {
            $log->info('add-pok'. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if (count($match[0])==4 && $match[0][3]=='yes'){
                $addpok = addPokazn($Receiv,intval($match[0][2]),$match[0][1],$lasdatehvd);
//                message($bot, $botSender, $event, 'ok333', getYesNoMenu('add-pok#'.$match[0][1].'#'.$match[0][2]));
                if ($addpok[0] == 'ok') {
                    message($bot, $botSender, $event, $addpok[1], getDmkgMenuOS($Receiv));
                    UpdateStatus($Receiv, '');
                }
                if ($addpok[0] == 'err') {
                    message($bot, $botSender, $event, $addpok[1], getRahList($FindRah, 'pok-rah'));
                }
                if ($addpok == null) {
                    message($bot, $botSender, $event, 'Подати показник по воді мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
                    UpdateStatus($Receiv, '');
                }
            }
        })
        ->onText('|privat24|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button privat24 '. var_export($event, true));
            $Receiv = verifyReceiver($event,$apiKey, $org);
            message($bot, $botSender, $event, 'Дякуємо за вашу оплату!!! Нагадуємо, що дані в privat24 оновлюються один раз на місяць!', getDmkgMenuOS($Receiv));
        })
        ->onText('|exit#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('exit kab '. var_export($event, true));
            $Receiv = verifyReceiver($event, $apiKey, $org);
//            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if ($Receiv->id_abonent=$match[0][0]){
                $Receiv->id_abonent=0;
                $Receiv->save();
                message($bot, $botSender, $event, 'Ви вишли з кабінета!', getDmkgMenuOS($Receiv));
                UpdateStatus($Receiv,'');
            }
        })
        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log ,$apiKey, $org,$lasdatehvd) {
            $log->info('onText ' . var_export($event, true));
            // .* - match any symbols
            $Receiv = verifyReceiver($event,$apiKey, $org);
            // message($bot, $botSender, $event, $event->getMessage()->getText(), getRahMenu());
            if ($Receiv == null || $Receiv->status == ''){
                message($bot, $botSender, $event, 'Не визначений запит:'.$event->getMessage()->getText(), null);
                message($bot, $botSender, $event, 'Головне меню:', getDmkgMenuOS($Receiv));
            }
            else {
                preg_match_all('/([^#]+)/ui',$Receiv->status,$match);
                if ($match[0][0] == 'add-rah'){
                    $ModelKart = DolgKart::findOne(['schet' => trim(iconv('UTF-8', 'windows-1251', $event->getMessage()->getText()))]);
                    $ModelAbonReceiver = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => $event->getMessage()->getText()]);


                    if ($ModelKart != null && $ModelAbonReceiver == null)  {
                        UpdateStatus($Receiv,'verify-rah#'.$event->getMessage()->getText());
                        message($bot, $botSender, $event, 'Для підтвердження рахунку введіть прізвище власника рахунку:', getRahMenu());
                    }
                    elseif ($ModelKart == null) {
                        message($bot, $botSender, $event, 'Вибачте, але цей рахунок не знайдено!!! Спробуйте ще.', getRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                    elseif ($ModelKart != null && $ModelAbonReceiver != null) {
                        message($bot, $botSender, $event, 'Цей рахунок вже під"єднано до кабінета!', getRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                }
                elseif ($match[0][0] == 'verify-rah') {
                    try {
                        $ModelKart = DolgKart::findOne(['schet' => trim(iconv('UTF-8', 'windows-1251', $match[0][1]))]);
                        if ($ModelKart != null) {
                            if (mb_strtolower(trim(iconv('windows-1251', 'UTF-8', $ModelKart->fio))) == mb_strtolower(trim($event->getMessage()->getText()))) {
                                $addabon = addAbonkart($Receiv, $match[0][1]);
                                if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок ' . $match[0][1] . ' під"єднано до кабінета.', getRahMenu());
                                else message($bot, $botSender, $event, 'Вибачте, але сталася помилка, можливо ваш аккаунт було видалено, здійсніть вихід з кабінета в пункті меню ПРОФІЛЬ КОРИСТУВАЧА та зареєструйтесь заново !!!', getDmkgMenuOS($Receiv));
                                UpdateStatus($Receiv, '');
                            } else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Введіть тільки прізвище! Спробуйте ще.', getRahMenu());
                        }
                        else message($bot, $botSender, $event, 'Вибачте, але сталася помилка, виконайте додавання рахунка заново!!!', getRahMenu());

                    } catch (\Exception $e) {
                        $mess = $e->getMessage();
                        message($bot, $botSender, $event, $mess, getRahMenu());
                    }
                }
                elseif ($match[0][0] == 'auth-email'){
                    $modelemail = new UtAbonent();
                    $modelemail->scenario = 'email';
                    $modelemail->email=$event->getMessage()->getText();
                    if ($modelemail->validate()) {
                        $modelabon = UtAbonent::findOne(['email' => $event->getMessage()->getText()]);
                        if ($modelabon != null)  {
                            UpdateStatus($Receiv,'auth-passw#'.$event->getMessage()->getText());
                            message($bot, $botSender, $event, 'Дякуємо! Ваш email вже зареєстровано в системі, для входу введіть пароль кабінета споживача:', getDmkgMenuOS($Receiv));
                        }
                        else {
                            message($bot, $botSender, $event, 'Для продовження реєстації введіть ваш ПІБ', getDmkgMenuOS($Receiv));
                            UpdateStatus($Receiv,'add-abon#'.'email='.$event->getMessage()->getText());
                        }
                    }
                    else {
                        message($bot, $botSender, $event, $modelemail->getErrors()['email'][0], getDmkgMenuOS($Receiv));
                    }

                }
                elseif ($match[0][0] == 'add-abon'){

                    $modelemail = new UtAbonent();
                    $modelemail->scenario = 'reg';

                    foreach ($match[0] as $col) {
                        preg_match_all('/([^=]+)/ui',$col,$match2);
                        switch ($match2[0][0]) {
                            case 'email':
                                $modelemail->email=isset($match2[0][1])?$match2[0][1]:'';
                                break;
                            case 'fio':
                                $modelemail->fio=isset($match2[0][1])?$match2[0][1]:'';
                                break;
                            case 'pass1':
                                $modelemail->pass1=isset($match2[0][1])?$match2[0][1]:'';
                                break;
                            case 'pass2':
                                $modelemail->pass2=isset($match2[0][1])?$match2[0][1]:'';
                                break;
                        }

                    }

                    if (!$modelemail->validate()) {
                        $err=$modelemail->getErrors();
                        if (array_key_exists('fio',$err)) $modelemail->fio = $event->getMessage()->getText();
                        elseif (array_key_exists('pass1',$err)) $modelemail->pass1 = $event->getMessage()->getText();
                        elseif (array_key_exists('pass2',$err)) $modelemail->pass2 = $event->getMessage()->getText();

                    }
                    if ($modelemail->validate()) {
                        $res = Addabon($modelemail,$Receiv);
                        if ($res=='OK') {
                            UpdateStatus($Receiv,'');
                            message($bot, $botSender, $event, 'Дякуємо '.$modelemail->fio.'! Ви здійснили процедуру реєстрації в кабінеті споживача ДМКГ. На вашу пошту '.$modelemail->email.' вислано лист для підтвердження реєстрації. Для завершення реєстрації виконайте підтвердження обов"язково!!!', getDmkgMenuOS($Receiv));
                        }
                        else {
                            UpdateStatus($Receiv,'');
                            message($bot, $botSender, $event, 'Вибачте сталася помилка, пройдіть процедуру Авторизаці/Реєстрації заново !!!', getDmkgMenuOS($Receiv));
//                            message($bot, $botSender, $event, $res, getDmkgMenuOS($Receiv));
                        }
                    }
                    else {
                        $err = $modelemail->getErrors();
                        UpdateStatus($Receiv,'add-abon#'.'email='.$modelemail->email.'#'.'fio='.$modelemail->fio.'#'.'pass1='.$modelemail->pass1.'#'.'pass2='.$modelemail->pass2);
                        //    message($bot, $botSender, $event, 'OKKK', getDmkgMenuOS($Receiv));
                        if (array_key_exists('fio',$err)) message($bot, $botSender, $event, $err['fio'][0].' '.$modelemail->fio, getDmkgMenuOS($Receiv));
                        elseif (array_key_exists('pass1',$err)) message($bot, $botSender, $event, $err['pass1'][0].' '.$modelemail->pass1, getDmkgMenuOS($Receiv));
                        elseif (array_key_exists('pass2',$err)) message($bot, $botSender, $event, $err['pass2'][0].' '.$modelemail->pass1, getDmkgMenuOS($Receiv));
                    }
                }
                elseif ($match[0][0] == 'auth-passw'){
                    $modelabon = UtAbonent::findOne(['email' => $match[0][1]]);
                    if ($modelabon != null)  {
                        if ($modelabon->passopen == $event->getMessage()->getText()) {
                            $Receiv->id_abonent = $modelabon->id;
                            $Receiv->save();
                            UpdateStatus($Receiv,'');
                            message($bot, $botSender, $event, 'Вітаємо '.$modelabon->fio.'! Ви здійснили вхід в систему, тепер для вас доступні всі функції!!!', getDmkgMenuOS($Receiv));
                        }
                        else {
//                            UpdateStatus($Receiv, 'auth-passw#' . $event->getMessage()->getText());
                            message($bot, $botSender, $event, 'Введений вами пароль не вірний! Спробуйте ще!'."\n\n".'Якщо ви забули пароль, скористайтесь посиланням (https://dmkg.com.ua/ut-abonent/fogotpass - Забули пароль) на сторінці входу в кабінет споживача!', getDmkgMenuOS($Receiv));
                        }
                    }
                    else {
                        UpdateStatus($Receiv,'');
                        message($bot, $botSender, $event, 'Вибачте сталася помилка, пройдіть процедуру Авторизаці/Реєстрації заново !!!', getDmkgMenuOS($Receiv));
                    }
                }
                elseif ($match[0][0] == 'add-pok'){
                    $FindRah = $Receiv->getUtAbonkart()->all();
                    $schet1251 = trim(iconv('UTF-8', 'windows-1251', $match[0][1]));
                    $val = $event->getMessage()->getText();
                    if (is_numeric($val) && floor($val) == $val && $val > 0) {
                        $modelPokazn=Yii::$app->hvddb->createCommand('select first 1 * from pokazn where schet=\''.$schet1251.'\' order by id desc')->QueryAll()[0];
                        if ($modelPokazn != null) {
                            if ((intval($val) - $modelPokazn['pokazn']) > 100) {
                                message($bot, $botSender, $event, 'Вибачте, але ваш показник перевищує 100 кубів!!! Ви впевнені що бажаєте подати цей показник - ' . intval($val), getYesNoMenu('add-pok#'.$match[0][1].'#'.$val));
                            } else {

                                $addpok = addPokazn($Receiv,intval($val), $match[0][1],$lasdatehvd);
                                if ($addpok[0] == 'ok') {
                                    message($bot, $botSender, $event, $addpok[1], getDmkgMenuOS($Receiv));
                                    UpdateStatus($Receiv, '');
                                }
                                if ($addpok[0] == 'err') {
                                    message($bot, $botSender, $event, $addpok[1], getRahList($FindRah, 'pok-rah'));
                                }
                                if ($addpok == null) {
                                    message($bot, $botSender, $event, 'Подати показник по воді мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
                                    UpdateStatus($Receiv, '');
                                }
                            }
                        } else {
                            $addpok = addPokazn($Receiv,intval($val), $match[0][1],$lasdatehvd);
                            if ($addpok[0] == 'ok') {
                                message($bot, $botSender, $event, $addpok[1], getDmkgMenuOS($Receiv));
                                UpdateStatus($Receiv, '');
                            }
                            if ($addpok[0] == 'err') {
                                message($bot, $botSender, $event, $addpok[1], getRahList($FindRah, 'pok-rah'));
                            }
                            if ($addpok == null) {
                                message($bot, $botSender, $event, 'Подати показник по воді мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
                                UpdateStatus($Receiv, '');
                            }
                        }
                    } else message($bot, $botSender, $event, 'Вибачте, але значення не є цілим числом!!! Спробуйте ще', getRahList($FindRah, 'pok-rah'));

//                    }

                }
                else{
                    message($bot, $botSender, $event, 'Не визначений статус: ' . $Receiv->status, getDmkgMenuOS($Receiv));
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

function Addabon($modelemail,$Receiv)
{

    $message = '';
//        $dataProviderEmail = $modelemail->searchemail(Yii::$app->request->bodyParams);
    $model = new UtAuth();
    $model->scenario = 'reg';
    $model->fio = $modelemail->fio;
    $model->email = $modelemail->email;
    $model->authtoken = md5($modelemail->email . time());
    $model->vid = 'authviber';
    $model->pass = $modelemail->pass1;
    $model->id_receiver = $Receiv->id_receiver;

    if ($model->validate()) {
        $model->save();

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'user-signupviber-comfirm-html'],
                ['model' => $model])
            ->setTo($model->email)
            ->setFrom('supportdmkg@ukr.net')
            ->setSubject('Реєстрація на вайберботі ДМКГ!')
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
        return 'OK';
    }
    else return $model->getErrors();




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
                ->setText('Додати рахунок до кабінета'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setBgColor('#fdbdaa')
                ->setTextHAlign('center')
                //  ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Delrah-button')
                ->setText('Видалити рахунок з кабінета'),

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
                ->setBgColor('#fdbdaa')
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

function getProfMenu($abon){

    if ($abon!=null) $email=$abon->email;
    else $email='';
    return (new \Viber\Api\Keyboard())
        ->setButtons([

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setBgColor('#F2F3A7')
                ->setTextSize('large')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('DmkgMenu-button')
                ->setText('🏠   Головне меню'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Exit-button')
                ->setBgColor("#fdbdaa")
                ->setText('Вийти з профіля '.$email),


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
//    try {
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
            $model->status = '';
            $model->id_abonent = 0;
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

//    } catch (\Exception $e) {
//        $mess = $e->getMessage();
//        return $mess;
//    }

    return $FindModel;
//    return $receiverId;

}

function addAbonkart($Receiv,$schet){

    $FindModel = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => $schet]);

    if ($FindModel == null)
    {
        $model = new UtAbonkart();
        $model->id_abon = $Receiv->id_abonent;
        $model->schet = $schet;
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
                    'post' => $Model->getErrors(),
                ];

                Yii::error($messageLog, 'viber_err');
                $meserr = '';
                foreach ($messageLog as $err) {
                    $meserr = $meserr . implode(",", $err);
                }
                getDmkgSend($meserr,$Model);

                return false;

            }
        }
        else return false;
    }
    else return false;

}


function infoPokazn($schet,$lasdatehvd){

    $mess='';
//    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    $schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));
    $hv=Yii::$app->hvddb->createCommand('select first 1 * from h_voda where yearmon=\''.$lasdatehvd.'\' and schet=\''.$schet1251.'\'')->QueryAll();
    $modelPokazn=Yii::$app->hvddb->createCommand('select first 1 * from pokazn where schet=\''.$schet1251.'\' order by id desc')->QueryAll();
    $mess = 'Особовий рахунок - '.$schet."\r\n";
//    $modelPokazn = Pokazn::find()->where(['schet' => $schet1251])->orderBy(['id' => SORT_DESC])->one();

    if ($hv!=null) {
    $mess = $mess.'----------------------------'."\n";
    $dt=Yii::$app->formatter->asDate('01.'.substr($hv[0]["yearmon"], 4, 2).'.'.substr($hv[0]["yearmon"], 0, 4), 'LLLL Y');
    $mess = $mess.'Нараховано за: '.$dt.' '.$hv[0]['sch_razn'].' куб.води'."\n";
    }

    if ($modelPokazn!=null){
        $mess = $mess.'----------------------------'."\n";
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn[0]['date_pok']))."\n";
        $mess = $mess.'Показник: '.$modelPokazn[0]['pokazn']."\n";
    }
    else $mess = 'Ваш останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
//    $mess = $mess.'Увага!!! Обробка показників триває протягом 1-3 днів:'."\n";
//    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (це має бути ціле число і не меньше останього показника):'."\n";

    return $mess;

}

function infoKontakt(){
    $mess='Комунальне підприємство «Долинське міське комунальне господарство» при Долинській міській раді'."\n"."\n";

    $mess=$mess.'Адреса: Кіровоградська обл., Долинський р-н, місто Долинська, вул.Нова, будинок 80-А'."\n"."\n";

    //  $mess=$mess.'Телефон бухгалтерія: (067)696-88-18'."\n"."\n";
    $mess=$mess.'Телефон диcпетчер:'."\n";
    $mess=$mess.'(067) 520-87-30'."\n";
    $mess=$mess.'(066) 942-00-12'."\n";
    $mess=$mess.'Телефон контролери:'."\n";
    $mess=$mess.'(095)062-68-89 (Viber)'."\n"."\n";
    //   $mess=$mess.'(099)120-31-54'."\n";
    // $mess=$mess.'(095)791-32-62'."\n"."\n";
    $mess = $mess.'e-mail: dmkg28500@ukr.net'."\n";

    return $mess;

}

function infoProf($Receiv,$abon){




    $mess='Профіль користувача:'."\n"."\n";
    if ($abon==null) {
        $mess = $mess . 'Вибачте, але сталася помилка, можливо ваш аккаунт було видалено, здійсніть вихід з кабінета в пункті меню "Вийти з профілю" та зареєструйтесь заново !!!' . "\n" . "\n";
    }
    else {
        $FindRah = $Receiv->getUtAbonkart()->all();
        $mess = $mess . 'EMAIL: ' . $abon->email . '' . "\n";
        $mess = $mess . 'ПІП: ' . $abon->fio . '' . "\n" . "\n";
        if ($FindRah != null) {
            $mess = $mess . 'Під"єднанні рахунки:' . "\n";
            foreach ($FindRah as $rah) {
                $mess = $mess . '----------------------------' . "\n";
                $mess = $mess . $rah->schet . "\n";
            }
        } else $mess = $mess . 'У вас немає під"єднаних рахунків!' . "\n" . "\n";
    }



    //  $mess=$mess.'Телефон бухгалтерія: (067)696-88-18'."\n"."\n";
    $mess=$mess.'Якщо ви бажаєте змінити параметри користувача (email,ПІП) чи зміна паролю, скористайтесь кабінетом споживача на сайті https://dmkg.com.ua/ut-abonent/kabinet - вхід за електронною поштою'."\n";
    return $mess;

}

/**
 * @param $pokazn
 * @param $schet
 * @return KpcentrViberpokazn|null
 */
function addPokazn($Receiv,$pokazn, $schet, $lasdatehvd)
{


    $abonent = UtAbonent::findOne($Receiv->id_abonent);
    $nowdate = intval(date('Y').date('m'));



    if ($abonent!=null) {
        if ($lasdatehvd < $nowdate) {
            $modelpokazn = new UtAbonpokazn();
            $modelpokazn->schet = trim($schet);
            $modelpokazn->name = $abonent->fio;
            $modelpokazn->id_abonent = $abonent->id;
            $modelpokazn->data = date("Y-m-d");
            $modelpokazn->pokazn = $pokazn;
            $modelpokazn->vid = 'viber';
            if ($modelpokazn->validate()) {
                $modelpokazn->save();
//            $meserr='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.$schet.' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';
//            getDmkgSend($meserr,$Receiv);


                $mess = [];
                $mess[0] = 'ok';
                $mess[1] = 'Вітаємо ' . $abonent->fio . ', ваш показник лічильника холодної води ' . $pokazn . ' по рахунку ' . $schet . ' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено';


                return $mess;
            } else {
                $messageLog = [
                    'status' => 'Помилка додавання показника',
                    'post' => $modelpokazn->errors
                ];

                Yii::error($messageLog, 'viber_err');
                $meserr = '';
                $errors = $modelpokazn->getErrors();
                foreach ($errors as $err) {
                    $meserr = $meserr . implode(",", $err);
                }
                $mess = [];
                $mess[0] = 'err';
                $mess[1] = $meserr;
                return $mess;

            }
        } else {

            $modelpokazn = new Pokazn();
            $modelpokazn->schet = trim(iconv('UTF-8', 'windows-1251', $schet));
            $modelpokazn->yearmon = $nowdate;
            $modelpokazn->pokazn = $pokazn;
            //   $modelpokazn->date_pok = date("Y-m-d");
            $modelpokazn->vid_pok = 21;
            $modelpokazn->fio = trim(iconv('UTF-8', 'windows-1251', $abonent->fio));



            if ($modelpokazn->validate()) {

                $modelpokazn->save();
//                $mess = [];
//                $mess[0] = 'ok';
//                $mess[1] = 'aftersave';
//                return $mess;



                Yii::$app->hvddb->createCommand("execute procedure calc_pok(:schet)")->bindValue(':schet', $modelpokazn->schet)->execute();
                $voda = HVoda::find()->where(['schet' => $modelpokazn->schet])->orderBy(['kl' => SORT_DESC])->one();
//            $meserr='Вітаємо '.$abonent->fio.', ваш показник лічильника холодної води по рахунку '.$schet.' становить '.'<h2 style="color:#b92c28">'.$pokazn.'</h2>';
//            $meserr=$meserr.'<h3 style="line-height: 1.5;">'.' Вам нараховано в цьому місяці '.$voda['sch_razn'].' кубометрів води!'.'</h3>';
//            getDmkgSend($meserr,$Receiv);
                $mess = [];
                $mess[0] = 'ok';
                $mess[1] = 'Вітаємо ' . $abonent->fio . ', ваш показник лічильника холодної води ' . $pokazn . ' по рахунку ' . $schet . ' зараховано! Вам нараховано в цьому місяці ' . $voda['sch_razn'] . ' кубометрів води!';
                return $mess;
            } else {

//                $messageLog = [
//                    'status' => 'Помилка додавання показника',
//                    'post' => $modelpokazn->errors
//                ];
//
//                Yii::error($messageLog, 'viber_err');
                $meserr = '';
                $errors = $modelpokazn->getErrors();
                foreach ($errors as $err) {
                    $meserr = $meserr . implode(",", $err);
                }
                $mess = [];
                $mess[0] = 'err';
                $mess[1] = $meserr;
                return $mess;

            }

        }

    } else return null;
}

function infoSchetOS($schet,$period) {

    $mess='';
    $mess2='';

    try {


        $schet1251 = trim(iconv('UTF-8', 'windows-1251', $schet));

//            if ($schet=='0030009м') {
//                if (function_exists('iconv')) {
//                    $mess2 = "iconv is installed and available.";
//                } else {
//                    $mess2 =  "iconv is not available.";
//                }
//                $tt = 'OS '.iconv('UTF-8', 'windows-1251', $schet);
//                return $tt;
//
//            }
//  $modelKart = DolgKart::findOne(['schet' => trim(iconv('UTF-8', 'windows-1251', $schet))]);
//  $modelKart = DolgKart::find()->where(['schet' => $schet1251])->all()[0];
//  $period=DolgPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one()->period;

        $dolg=Yii::$app->dolgdb->createCommand('select vw_obkr.*,round((dolg-fullopl),2) as dolgopl from vw_obkr where period=\''.$period.'\' and schet=\''.$schet1251.'\' order by npp')->QueryAll();
//
        $mess = 'Особовий рахунок - '.$schet."\r\n";

        $fio = trim(iconv('windows-1251', 'UTF-8',$dolg[0]["fio"]));
        $mess = $mess.$fio . "\n";

        $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["ulnaim"])).' буд.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomdom"])).' '.(isset($dolg[0]["nomkv"])?'кв.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomkv"])):'')."\r\n";
        $mess = $mess.'----------------------------'."\n";

        $mess = $mess.Yii::$app->formatter->asDate($period, 'LLLL Y')."\n";
        $mess = $mess.'----------------------------'."\n";
        $mess = $mess.'Ваша заборгованість по послугам:'."\n\r";
        $summa =0;
        foreach($dolg as $obb)
        {
            $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $obb['poslug'])).' '.$obb['dolgopl']."\n";

            if ($obb['dolgopl']>0)
            {
                $summa = $summa + $obb['dolgopl'];
            }
        }
        $mess = $mess.'----------------------------'."\n";

        $mess = $mess."\r".'Всього до сплати: '.$summa."\n";
    }
    catch(\Exception $e){
        $mess = $e->getMessage();
    }

    return $mess;

}

function getSend($message)
{



    $apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE

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
        $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setReceiver('gN0uFHnqvanHwb17QuwMaQ==')
                ->setText($message)
        );

    } catch (Exception $e) {
        $log->warning('Exception: ' . $e->getMessage());
        if ($bot) {
            $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
            $log->warning('Actual body: ' . $bot->getInputBody());
        }
    }

    return '';
}





