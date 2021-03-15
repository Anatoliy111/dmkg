<?php



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
$apiKey = '4d098f46d267dd30-1785f1390be821c1-7f30efd773daf6d2';
$org = 'kpcentr';

// ��� ����� ��������� ��� ��� (��� � ������ - ����� ������)
$botSender = new Sender([
    'name' => 'KPCentrBot',
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
                ->setText(' Вітаємо вас в вайбер боті КП "Центр"!!!')
                ->setKeyboard(getMainMenu());
           // $mes = 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            message($bot, $botSender, $event, 'Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.', getMainMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getMainMenu());
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('onSubscribe handler');
            return (new \Viber\Api\Message\Text())
                ->setSender($botSender)
                ->setText('Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.')
                ->setKeyboard(getMainMenu());

          //  $receiverId = $event->getSender()->getId();
          //  $mes = ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
        //    message($bot, $botSender, $event, $mes, getMainMenu());
//            $receiverId = $event->getSender()->getId();
//            $receiverName = $event->getSender()->getName();
//            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
//            if ($Receiv <> null) {
//                $mes = $receiverName . ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
//            }
//            else $mes = 'Помилка реєстрації';
//            message($bot, $botSender, $event, $mes, getMainMenu());
        })
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок:', getRahList($FindRah,'inf-rah#'));
        })
        ->onText('|Pokazmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок по якому подати показник:', getRahList($FindRah,'pok-rah#'));
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
            else message($bot, $botSender, $event, 'Виберіть рахунок для видалення:', getRahList($FindRah,'del-rah#'));
        })
        ->onText('|Rahmenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            message($bot, $botSender, $event, 'Редагування рахунків:', getRahMenu());
        })
        ->onText('|MainMenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey, $org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            if ($Receiv->status != '') {UpdateStatus($Receiv,'');}
            message($bot, $botSender, $event, 'Головне меню:', getMainMenu());
        })
        ->onText('|admin|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            verifyReceiver($event, $apiKey, $org);
            message($bot, $botSender, $event, 'Головне меню:', getMainMenu());
        })
        ->onText('|del-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $DelRah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => substr($event->getMessage()->getText(), 8)]);
            if ($DelRah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahMenu());
            else {
                $DelRah->delete();
                message($bot, $botSender, $event, 'Рахунок '.substr($event->getMessage()->getText(), 8).' видалено з бота!', getRahMenu());
            }
        })
        ->onText('|inf-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => substr($event->getMessage()->getText(), 8)]);
            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'inf-rah#'));
            else {
                message($bot, $botSender, $event, infoSchet($Rah->schet), getRahList($FindRah,'inf-rah#'));
            }
        })
        ->onText('|pok-rah#|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'add-pok');
            $FindRah = $Receiv->getViberAbons()->all();
            $Rah = ViberAbon::findOne(['id_viber' => $Receiv->id,'schet' => substr($event->getMessage()->getText(), 8)]);
            if ($Rah == null) message($bot, $botSender, $event, 'У вас немає цього рахунку:', getRahList($FindRah,'pok-rah#'));
            else {
                message($bot, $botSender, $event, infoPokazn($Rah->schet), getRahList($FindRah,'pok-rah#'));
            }
        })
        ->onText('|privat24|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button privat24 ');
            message($bot, $botSender, $event, 'Дякуємо за вашу оплату!!! Нагадуємо, що дані в privat24 оновлюються один раз на місяць!', getMainMenu());
        })
        ->onText('|.*|s', function ($event) use ($bot, $botSender, $log ,$apiKey, $org) {
            $log->info('onText ' . var_export($event, true));
            // .* - match any symbols
            $Receiv = verifyReceiver($event,$apiKey, $org);
           // message($bot, $botSender, $event, $event->getMessage()->getText(), getRahMenu());
            if ($Receiv == null || $Receiv->status == ''){
                message($bot, $botSender, $event, 'Не визначений запит:' . $event->getMessage()->getText(), null);
                message($bot, $botSender, $event, 'Головне меню:', getMainMenu());
            }
            else {
                if ($Receiv->status == 'add-rah'){
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
                elseif (substr($Receiv->status, 0, 10) == 'verify-rah'){
                    $ModelAbon = KpcentrObor::findOne(['schet' => substr($Receiv->status, 11),'status' => 1]);
                    if ($ModelAbon != null){
                            if (mb_strtolower($ModelAbon->fio) == mb_strtolower($event->getMessage()->getText())){
                                $addabon = addAbonReceiver($Receiv->id,substr($Receiv->status, 11),$org);
                                if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок '.substr($Receiv->status, 11).' під"єднано до бота', getRahMenu());
                                UpdateStatus($Receiv,'');
                            }
                            else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Спробуйте ще', getRahMenu());

                    }
                }
                elseif (substr($Receiv->status, 0, 7) == 'add-pok'){
                    $ModelAbon = KpcentrObor::findOne(['schet' => substr($Receiv->status, 8),'status' => 1]);
                    $FindRah = $Receiv->getViberAbons()->all();
                    if ($ModelAbon != null){
                        if (is_integer(intval($event->getMessage()->getText()))){
                            $modelPokazn = KpcentrPokazn::findOne(['schet' => substr($Receiv->status, 8),'status' => 1]);
                            if ($modelPokazn!=null){
                                if ($modelPokazn->pokazn > intval($event->getMessage()->getText())){
                                  $addpok = addPokazn(intval($event->getMessage()->getText()),substr($Receiv->status, 8));
                                    if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник '.$event->getMessage()->getText().' здано успішно!', getMainMenu());
                                    UpdateStatus($Receiv,'');
                                }
                                else message($bot, $botSender, $event, 'Вибачте, але значення меньше ніж останній показник!!! Спробуйте ще', getRahList($FindRah,'pok-rah#'));
                            }
                            else {
                                $addpok = addPokazn(intval($event->getMessage()->getText()),substr($Receiv->status, 8));
                                if ($addpok != null) message($bot, $botSender, $event, 'Вітаємо!!! Показник '.$event->getMessage()->getText().' здано успішно!', getMainMenu());
                                UpdateStatus($Receiv,'');
                            }
                        }
                        else message($bot, $botSender, $event, 'Вибачте, але значення не ціле число!!! Спробуйте ще', getRahList($FindRah,'pok-rah#'));

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

function getMainMenu(){

   return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //->setBgColor('#8074d6')
               // ->setTextSize('small')
                ->setTextSize('large')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
               ->setBgColor("#75C5F3")
                ->setText('📈  Інформація по ос.рахунках'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
              //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#75C5F3")
               // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('♻  Операції з ос.рахунками'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Pokazmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222381919%22,%22form%22:%7B%22query%22:%2233006271%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat400x171.png"),
        ]);

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
                ->setActionBody('MainMenu-button')
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
                ->setActionBody($action.$Rah->schet)
                ->setText($Rah->schet);
    }

    $buttons[] =
    (new \Viber\Api\Keyboard\Button())
        ->setBgColor('#75C5F3')
        ->setTextSize('large')
        ->setTextHAlign('center')
        ->setTextVAlign('center')
        ->setActionType('reply')
        ->setActionBody('MainMenu-button')
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
        $Model->status = $Status;
        if ($Model->validate() && $Model->save())
        {
            return true;
        }
        else
        {
            $messageLog = [
                'status' => 'Помилка додавання в підписника',
                'post' => $Model->errors
            ];

            Yii::error($messageLog, 'viber_err');
            $meserr='';
            foreach ($messageLog as $err){
                $meserr=$meserr.implode(",", $err);
            }
            getSend($meserr);

            return false;

        }
    }
    else return false;

}

function addAbonReceiver($id_viber,$schet,$org){

        $FindModel = ViberAbon::findOne(['id_viber' => $id_viber,'schet' => $schet]);
        if ($FindModel == null)
        {
            $model = new ViberAbon();
            $model->id_viber = $id_viber;
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
                $meserr='';
                foreach ($messageLog as $err){
                    $meserr=$meserr.implode(",", $err);
                }
                getSend($meserr);

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
    $modelObor = KpcentrObor::findOne(['schet' => $schet,'status' => 1]);
    $mess = 'Особовий рахунок - '.$schet."\r\n";
    $mess = $mess.$modelObor->fio .' '.$modelObor->im.' '.$modelObor->ot. "\n";
    $mess = $mess.$modelObor->ulnaim.' буд.'.$modelObor->nomdom.' '.(isset($modelObor->nomkv)?'кв.'.$modelObor->nomkv:'')."\r\n";

    $dolg= KpcentrObor::find();
//					->select(["ut_obor.id_abonent as id", "ut_obor.period", "ut_obor.id_posl","ut_obor.sal","b.summ","round((ut_obor.sal-COALESCE(b.summ,0)),2) as dolgopl"])
    $dolg->select(["kpcentr_obor.*"]);
//  				    $dolg->select('ut_obor.*,b.summ,');
    $dolg->where(['kpcentr_obor.schet'=> $schet,'status' => 1])->all();
    $mess = $mess.'Ваша заборгованість по послугам:'."\n\r";
    $summa =0;
    foreach($dolg->asArray()->all() as $obb)
    {
        $mess = $mess.$obb['naim_wid'].': '.$obb['sal']."грн \n";

        if ($obb['sal']>0)
        {
            $summa = $summa + $obb['sal'];
        }
    }


   // $mess = $mess."\r".'Всього до сплати: '.$summa."\n\r";

    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    if ($modelPokazn!=null){
    $mess = $mess."\r".'Останній показник по воді :'."\r\n";
    $mess = $mess."Дата показника: ".date('d.m.Y',strtotime($modelPokazn->date_pok)).' - Показник: '.$modelPokazn->pokazn."\r\n";
    }




    return $mess.'<font color=#F2AD50>Согласовать</font>';

}

function infoPokazn($schet){

    $mess='';
    $modelPokazn = KpcentrPokazn::findOne(['schet' => $schet,'status' => 1]);
    if ($modelPokazn!=null){
        $mess = $mess.'Останній показник по воді :'."\r\n";
        $mess = $mess.$modelPokazn->date_pok.' - Показник: '.$modelPokazn->pokazn."\r\n";
    }
    else $mess = 'Ваш останній останній показник по воді не зафіксовано:'."\r\n";
    $mess = $mess.'Увага!!! Обробка показників триває на протягом 1-3 днів:'."\r\n";
    $mess = $mess.'Введіть новий показник по воді (має бути ціле число і не меньше останього показника):'."\r\n";

    return $mess;

}

/**
 * @param $pokazn
 * @param $schet
 * @return KpcentrViberpokazn|null
 */
function addPokazn($pokazn, $schet){

        $model = new KpcentrViberpokazn();
        $model->data = date('Y-m-d');
        $model->schet = $schet;
        $model->pokazn = $pokazn;
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