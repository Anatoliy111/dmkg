<?php

require_once (__DIR__ .'/botMenu.php');

//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/console.php';
new yii\web\Application($yiiConfig);


use app\models\DolgKart;
use app\models\KpcentrObor;
use app\models\KpcentrPokazn;
use app\models\KpcentrViberpokazn;
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
            $log->info('onConversation handler');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            $mes = ' Вітаємо вас в вайбер боті КП "ДМКГ"!!!'."\n";
            $FindModels = ViberAbon::find()->where(['id_viber' => $Receiv->id]);
            if (($FindModels == null) and ($Receiv->id_abonent == null)) {
                $mes=$mes.'Пройдіть процедуру реєстрації, обравши кнопку Авторизація/Реєстрація';
            }
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText($mes)
                ->setKeyboard(getDmkgMenuOS($Receiv));

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
            $Receiv = verifyReceiver($event, $apiKey, $org);
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
                ->setKeyboard(getDmkgMenuOS($Receiv));

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
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) $FindRah = $Receiv->getViberAbons()->all();
            else $FindRah = $Receiv->getUtAbonkart()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок:', getRahList($FindRah,'inf-rah'));
        })
        ->onText('|Pokazmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
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
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv, 'auth-email');
            message($bot, $botSender, $event, 'Напишіть вашу ел.пошту - email:'."\n".' (якщо ви вже реєструвались на сайті dmkg.com.ua, вкажіть пошту реєстрації в кабінеті споживача):', getDmkgMenuOS($Receiv));
//            }
        })
        ->onText('|Addrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            if ($Receiv->id_abonent==0) message($bot, $botSender, $event, 'Додати рахунок мають змогу тільки зареєстровані користувачі. Пройдіть процедуру Авторизаці/Реєстрації:', getDmkgMenuOS($Receiv));
            else {
            UpdateStatus($Receiv, 'add-rah');
            message($bot, $botSender, $event, 'Напишіть номер вашого особового рахунку:', getRahMenu());
            }
        })
        ->onText('|Delrah-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            if ($Receiv->id_abonent==0) $FindRah = $Receiv->getViberAbons()->all();
            else $FindRah = $Receiv->getUtAbonkart()->all();
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
            message($bot, $botSender, $event, infoKontakt(), getDmkgMenuOS($Receiv));
        })
        ->onText('|DmkgMenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey, $org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            message($bot, $botSender, $event, 'Головне меню:', getDmkgMenuOS($Receiv));
//            message($bot, $botSender, $event, 'Головне меню:'.$Receiv->id,null);
        })
        ->onText('|admin|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            message($bot, $botSender, $event, 'Головне меню:', getDmkgMenuOS($Receiv));
        })
        ->onText('|del-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
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
        ->onText('|inf-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
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
                message($bot, $botSender, $event, infoSchetOS($Rah->schet), getRahList($FindRah,'inf-rah'));
//                message($bot, $botSender, $event, $Rah->schet, getRahList($FindRah,'inf-rah'));
            }
        })
        ->onText('|pok-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
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
                message($bot, $botSender, $event, infoPokazn($Rah->schet), getRahList($FindRah,'pok-rah'));
                UpdateStatus($Receiv,'add-pok#'.$match[0][1]);
            }
        })
        ->onText('|add-pok#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
//            $FindRah = $Receiv->getViberAbons()->all();
            preg_match_all('/([^#]+)/ui',$event->getMessage()->getText(),$match);
            if (count($match[0])==4 && $match[0][3]=='yes'){
                $addpok = addPokazn(intval($match[0][2]),$match[0][1],$event->getSender()->getName());
                if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник '.$match[0][2].' здано успішно!', getDmkgMenuOS($Receiv));
                UpdateStatus($Receiv,'');
            }
        })
        ->onText('|privat24|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button privat24 ');
            $Receiv = verifyReceiver($event,$apiKey, $org);
            message($bot, $botSender, $event, 'Дякуємо за вашу оплату!!! Нагадуємо, що дані в privat24 оновлюються один раз на місяць!', getDmkgMenuOS($Receiv));
        })
        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log ,$apiKey, $org) {
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
                        message($bot, $botSender, $event, 'Вибачте, але цей рахунок не знайдено!!! Спробуйте ще', getRahMenu());
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
                                $addabon = addAbonReceiver($Receiv, $match[0][1]);
                                if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок ' . $match[0][1] . ' під"єднано до кабінета', getRahMenu());
                                UpdateStatus($Receiv, '');
                            } else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Спробуйте ще', getRahMenu());
                        }
                        else message($bot, $botSender, $event, 'Вибачте, але сталася помилка, виконайте додавання рахунка заново!!!', getRahMenu());

                    } catch (\Exception $e) {
                        $mess = $e->getMessage();
                        message($bot, $botSender, $event, $mess, getRahMenu());
                    }
                }
                elseif ($match[0][0] == 'auth-email'){
                    $modelabon = UtAbonent::findOne(['email' => $event->getMessage()->getText()]);
                    if ($modelabon != null)  {
                        UpdateStatus($Receiv,'auth-passw#'.$event->getMessage()->getText());
                        message($bot, $botSender, $event, 'Дякуємо! Ваш email вже зареєстровано в системі, для входу введіть пароль кабінета споживача:', getDmkgMenuOS($Receiv));
                    }
                    else {
                        message($bot, $botSender, $event, 'Вибачте, але цей рахунок не знайдено!!! Спробуйте ще', getRahMenu());
                        //UpdateStatus($Receiv,'');
                    }
                }
                elseif ($match[0][0] == 'auth-passw'){
                    $modelabon = UtAbonent::findOne(['email' => $match[0][1]]);
                    if ($modelabon != null)  {
                        if ($modelabon->passopen == $event->getMessage()->getText()) {
                            $Receiv->id_abonent = $modelabon->id;
                            $Receiv->save();
                            UpdateStatus($Receiv,'');
                            message($bot, $botSender, $event, 'Вітаємо '.$modelabon->fio.'--'.$Receiv->id_abonent.'! Ви здійснили вхід в систему, тепер для вас доступні всі функції!!!', getDmkgMenuOS($Receiv));
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
                    //  message($bot, $botSender, $event, 'add-pok', getDmkgMenuOS($Receiv));
                    $ModelAbon = KpcentrObor::findOne(['schet' => $match[0][1], 'status' => 1]);
                    $FindRah = $Receiv->getUtAbonkart()->all();
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
                                        if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник ' . $val . ' здано успішно!', getDmkgMenuOS($Receiv));
                                        UpdateStatus($Receiv, '');
                                    }
                                } else message($bot, $botSender, $event, 'Вибачте, але значення показника меньше ніж останній показник!!! Спробуйте ще', getRahList($FindRah, 'pok-rah'));
                            } else {
                                $addpok = addPokazn(intval($val), $match[0][1],$event->getSender()->getName());
                                if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник ' . $val . ' здано успішно!', getDmkgMenuOS($Receiv));
                                UpdateStatus($Receiv, '');
                            }
                        } else message($bot, $botSender, $event, 'Вибачте, але значення не є цілим числом!!! Спробуйте ще', getRahList($FindRah, 'pok-rah'));

                    }

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

function getDmkgMenuOS($Receiv){

    $FindModels = ViberAbon::find()->where(['id_viber' => $Receiv->id]);

    if (($FindModels == null) and ($Receiv->id_abonent == null)) {
        return (new \Viber\Api\Keyboard())
            ->setButtons([

                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    //  ->setBgColor('#2fa4e7')
                    ->setTextHAlign('center')
                    ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('Kontakt-button')
                    ->setBgColor("#aafdc8")
                    // ->setBgColor("#F3DD27")
                    // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                    ->setText('📬 Контактна інформація'),

                (new \Viber\Api\Keyboard\Button())
                    ->setColumns(3)
                    //  ->setBgColor('#2fa4e7')
                    ->setTextHAlign('center')
                    ->setTextSize('large')
                    ->setActionType('reply')
                    ->setActionBody('Auth-button')
                     ->setBgColor("#fdbdaa")
                    // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                    ->setText('Авторизація/Реєстрація'),

//                (new \Viber\Api\Keyboard\Button())
////                ->setColumns(6)
//                    ->setActionType('open-url')
//                    ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
//                    ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
////                ->setTextSize('regular')
////                ->setTextHAlign('left')
////                ->setText('Оплата'),
            ]);
    }
    else {
        if ($Receiv->id_abonent == null) {


            return (new \Viber\Api\Keyboard())
                ->setButtons([

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //->setBgColor('#8074d6')
                        // ->setTextSize('small')
                        ->setTextSize('regular')
                        ->setTextHAlign('center')
//                ->setTextVAlign('center')
                        ->setActionType('reply')
                        ->setActionBody('Infomenu-button')
                        ->setBgColor("#fdaafc")
                        ->setText('📊  Інформація по рахунках'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Pokazmenu-button')
                        ->setBgColor("#75C5F3")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📟  Подати показники (вода)'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Rahmenu-button')
                        ->setBgColor("#F2F3A7")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('⚙ Додати/видалити рахунок'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Kontakt-button')
                        ->setBgColor("#aafdc8")
                        // ->setBgColor("#F3DD27")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📬 Контактна інформація'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        ->setActionType('open-url')
                        ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                        ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
//                ->setTextSize('regular')
//                ->setTextHAlign('left')
//                ->setText('Оплата'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Auth-button')
                        ->setBgColor("#fdbdaa")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('Авторизація/Реєстрація'),
                ]);
        }
        else
        {
            return (new \Viber\Api\Keyboard())
                ->setButtons([

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('regular')
                ->setTextHAlign('center')
//                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#fdaafc")
                ->setText('📊  Інформація по рахунках'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Pokazmenu-button')
                        ->setBgColor("#75C5F3")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📟  Подати показники (вода)'),

                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('regular')
                        ->setActionType('reply')
                        ->setActionBody('Rahmenu-button')
                        ->setBgColor("#F2F3A7")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('⚙ Додати/видалити рахунок'),


                    (new \Viber\Api\Keyboard\Button())
                        ->setColumns(3)
                        //  ->setBgColor('#2fa4e7')
                        ->setTextHAlign('center')
                        ->setTextSize('large')
                        ->setActionType('reply')
                        ->setActionBody('Kontakt-button')
                        ->setBgColor("#aafdc8")
                        // ->setBgColor("#F3DD27")
                        // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                        ->setText('📬 Контактна інформація'),

                    (new \Viber\Api\Keyboard\Button())
//                ->setColumns(6)
                        ->setActionType('open-url')
                        ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                        ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
//                ->setTextSize('regular')
//                ->setTextHAlign('left')
//                ->setText('Оплата'),
                ]);


        }

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
//    if ($FindModel== null)
//    {
//        $model = new Viber();
//        $model->api_key = $apiKey;
//        $model->id_receiver = $receiverId;
//        $model->name = $receiverName;
//        $model->org = $org;
//        if ($model->validate() && $model->save())
//        {
//            $FindModel = $model;
//        }
//        else
//        {
//            $messageLog = [
//                'status' => 'Помилка додавання в підписника',
//                'post' => $model->errors
//            ];
//
//            Yii::error($messageLog, 'viber_err');
//            $meserr='';
//            foreach ($messageLog as $err){
//                $meserr=$meserr.implode(",", $err);
//            }
//            getSend($meserr);
//
//            $FindModel = null;
//
//        }
//    }

    return $FindModel;

}

function addAbonReceiver($Receiv,$schet){

    $FindModel = UtAbonkart::findOne(['id_abon' => $Receiv->id_abonent,'schet' => $schet]);

    if ($FindModel == null)
    {
        $model = new UtAbonkart();
        $model->id_abon = $Receiv->id_abonent;
        $model->schet = $schet;
        $model->org = 'dmkg';
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


function infoPokazn($schet){

    $mess='';
    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    if ($modelPokazn!=null){
        $mess = $mess.'Останній зарахований показник по воді :'."\n";
        $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn->date_pok))."\n";
        $mess = $mess.'Показник: '.$modelPokazn->pokazn."\n";
    }
    else $mess = 'Ваш останній показник по воді не зафіксовано:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Увага!!! Обробка показників триває протягом 1-3 днів:'."\n";
    $mess = $mess.'----------------------------'."\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\n";

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

/**
 * @param $pokazn
 * @param $schet
 * @return KpcentrViberpokazn|null
 */
function addPokazn($pokazn, $schet, $viber_name)
{

    $model = new KpcentrViberpokazn();
    $model->data = date('Y-m-d');
    $model->schet = $schet;
    $model->pokazn = $pokazn;
    $model->viber_name = $viber_name;
    if ($model->validate()) {
        /** @var TYPE_NAME $model */

        $model->save();

        return $model;
    } else {
        $messageLog = [
            'status' => 'Помилка додавання показника',
            'post' => $model->errors
        ];

        Yii::error($messageLog, 'viber_err');
        $meserr = '';

        foreach ($messageLog as $err) {
            $meserr = $meserr . implode(",", $err);
        }
        getSend($meserr);


        return null;

    }
}

function infoSchetOS($schet) {

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
        $period=Yii::$app->dolgdb->createCommand('select first 1 period from period order by period desc')->QueryAll();
        $dolg=Yii::$app->dolgdb->createCommand('select vw_obkr.*,round((dolg-fullopl),2) as dolgopl from vw_obkr where period=\''.$period[0]["period"].'\' and schet=\''.$schet1251.'\' order by npp')->QueryAll();
//
        $mess = 'Особовий рахунок - '.$schet."\r\n";

        $fio = trim(iconv('windows-1251', 'UTF-8',$dolg[0]["fio"]));
        $mess = $mess.$fio . "\n";

        $mess = $mess.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["ulnaim"])).' буд.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomdom"])).' '.(isset($dolg[0]["nomkv"])?'кв.'.trim(iconv('windows-1251', 'UTF-8', $dolg[0]["nomkv"])):'')."\r\n";
        $mess = $mess.'----------------------------'."\n";

        $mess = $mess.Yii::$app->formatter->asDate($period[0]["period"], 'LLLL Y')."\n";
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


