<?php



//require_once("../vendor/autoload.php");
require_once(__DIR__ . '/../vendor/autoload.php');
//require_once(__DIR__ . '/../yii');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$yiiConfig = require __DIR__ . '/../app/config/console.php';
new yii\web\Application($yiiConfig);


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



$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
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
            $receiverId = $event->getSender()->getId();
            $receiverName = $event->getSender()->getName();
            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
            if ($Receiv <> null) {
                $mes = $receiverName . ' Вітаємо в вайбер боті! Оберіть потрібну функцію кнопками нижче.';
            }
            else $mes = 'Помилка реєстрації';
            message($bot, $botSender, $event, $mes, getMainMenu());
        })
        // when user subscribe to PA
        ->onSubscribe(function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $receiverId = $event->getSender()->getId();
            $log->info('onSubscribe handler');
            $receiverId = $event->getSender()->getId();
            $receiverName = $event->getSender()->getName();
            $Receiv = verifyReceiver($receiverId, $event, $apiKey, $org);
            if ($Receiv <> null) {
                $mes = $receiverName . ' Дякуємо що підписалися на наш бот! Оберіть потрібну функцію кнопками нижче.';
            }
            else $mes = 'Помилка реєстрації';
            message($bot, $botSender, $event, $mes, getMainMenu());
        })
        ->onText('|Infomenu-button|s', function ($event) use ($bot, $botSender, $log, $apiKey,$org) {
            $log->info('click on button');
            $Receiv = verifyReceiver($event, $apiKey, $org);
            UpdateStatus($Receiv,'');
            $FindRah = $Receiv->getViberAbons()->all();
            if ($FindRah == null) message($bot, $botSender, $event, 'У вас немає під"єднаних рахунків:', getRahMenu());
            else message($bot, $botSender, $event, 'Виберіть рахунок:', getRahList($FindRah,'inf-rah#'));
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
                    $ModelAbon = UtAbonent::findOne(['schet' => $event->getMessage()->getText()]);
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
                    $ModelAbon = UtAbonent::findOne(['schet' => substr($Receiv->status, 11)]);
                    if ($ModelAbon != null){
                        $ModelKart = UtKart::findOne(['id' => $ModelAbon->id_kart]);
                        if ($ModelKart != null){
                            if (mb_strtolower($ModelKart->name_f) == mb_strtolower($event->getMessage()->getText())){
                                $addabon = addAbonReceiver($Receiv->id,substr($Receiv->status, 11),$ModelKart->id,$org);
                                if ($addabon != null) message($bot, $botSender, $event, 'Вітаємо!!! Рахунок '.substr($Receiv->status, 11).' під"єднано до бота', getRahMenu());
                                UpdateStatus($Receiv,'');
                            }
                            else message($bot, $botSender, $event, 'Вибачте, але це прізвище не правильне!!! Спробуйте ще', getRahMenu());
                        }
                    }
                }
                else{
                     message($bot, $botSender, $event, 'Не визначений статус: ' . $Receiv->status, getRahMenu());
                     UpdateStatus($Receiv,'');
                }

            }

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
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222383219%22,%22form%22:%7B%22query%22:%2236188893%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/p243.jpg"),
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
    $FindModel = Viber::findOne(['api_key' => $apiKey,'id_receiver' => $receiverId]);
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

            return false;

        }
    }
    else return false;

}

function addAbonReceiver($id_viber,$schet,$id_kart, $org){

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
    $mess = $mess.$modelKart->getUlica()->asArray()->one()['ul'].' буд.№'.$modelKart->dom.' '.(isset($modelKart->kv)?'кв.'.$modelKart->kv:'')."\r\n";

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