<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\commands;
use app\poslug\models\UtAbonent;
use app\poslug\models\UtOpl;
use app\poslug\models\UtPeriod;
use app\poslug\models\UtPosl;
use app\poslug\models\UtTipposl;
use Exception;
use Yii;
use yii\console\Controller;
use Viber\Client;
use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */





class CronController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public static $UPLOADS_DIR = 'uploads/cron';

    public $lastperiod;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'bot' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex($message = 'hello00000000000000 world')
    {
        echo $message . "\n";
    }

    public function actionMess($message = 'hello00000000000000 world')
    {
        echo $message . "\n";
    }

    public function actionWebhook()
    {
     //   $basePath =  dirname(__DIR__);
     //   $webroot = dirname($basePath);
     //   require_once(__DIR__.'/vendor/autoload.php');


        $apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
        $webhookUrl = 'https://dmkg.com.ua/cron/bot'; // <- PLACE-YOU-HTTPS-URL
        try {
            $client = new Client([ 'token' => $apiKey ]);
            $result = $client->setWebhook($webhookUrl);
            echo "Success!\n";
        } catch (Exception $e) {
            echo "Error: ". $e->getMessage() ."\n";
        }

    return true;

    }

    public function actionBot()
    {


//require_once("../vendor/autoload.php");
   //     require_once(__DIR__ . '/vendor/autoload.php');



        $apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE

        $botSender = new Sender([
            'name' => 'bondyukViberBot',
            'avatar' => '',
        ]);

// log bot interaction
        $log = new Logger('bot');
        $log->pushHandler(new StreamHandler('/tmp/bot.log'));

        try {
            // create bot instance
            $bot = new Bot(['token' => $apiKey]);
            $bot
                // first interaction with bot - return "welcome message"
                ->onConversation(function ($event) use ($bot, $botSender, $log) {
                    $log->info('onConversation handler');
                    $buttons = [];
                    for ($i = 0; $i <= 8; $i++) {
                        $buttons[] =
                            (new \Viber\Api\Keyboard\Button())
                                ->setColumns(1)
                                ->setActionType('reply')
                                ->setActionBody('k' . $i)
                                ->setText('k' . $i);
                    }
                    return (new \Viber\Api\Message\Text())
                        ->setSender($botSender)
                        ->setText("Hi, you can see some demo: send 'k1' or 'k2' etc.")
                        ->setKeyboard(
                            (new \Viber\Api\Keyboard())
                                ->setButtons($buttons)
                        );
                })
                // when user subscribe to PA
                ->onSubscribe(function ($event) use ($bot, $botSender, $log) {
                    $receiverId = $event->getSender()->getId();
                    $log->info('onSubscribe handler');
                    $this->getClient()->sendMessage(
                        (new \Viber\Api\Message\Text())
                            ->setSender($botSender)
                            ->setText('Thanks for subscription!')
                    );
                })
                ->onText('|btn-click|s', function ($event) use ($bot, $botSender, $log) {
                    $log->info('click on button');
                    $receiverId = $event->getSender()->getId();
                    $bot->getClient()->sendMessage(
                        (new \Viber\Api\Message\Text())
                            ->setSender($botSender)
                            ->setReceiver($receiverId)
                            ->setText('you press the button and you ID '.$receiverId)
                    );
                })
                ->onText('|k\d+|is', function ($event) use ($bot, $botSender, $log) {
                    $caseNumber = (int)preg_replace('|[^0-9]|s', '', $event->getMessage()->getText());
                    $log->info('onText demo handler #' . $caseNumber);
                    $client = $bot->getClient();
                    $receiverId = $event->getSender()->getId();
                    switch ($caseNumber) {
                        case 0:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Text())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setText('Basic keyboard layout')
                                    ->setKeyboard(
                                        (new \Viber\Api\Keyboard())
                                            ->setButtons([
                                                (new \Viber\Api\Keyboard\Button())
                                                    ->setActionType('reply')
                                                    ->setActionBody('btn-click')
                                                    ->setText('Tap this button')
                                            ])
                                    )
                            );
                            break;
                        //
                        case 1:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Text())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setText('More buttons and styles')
                                    ->setKeyboard(
                                        (new \Viber\Api\Keyboard())
                                            ->setButtons([
                                                (new \Viber\Api\Keyboard\Button())
                                                    ->setBgColor('#8074d6')
                                                    ->setTextSize('small')
                                                    ->setTextHAlign('right')
                                                    ->setActionType('reply')
                                                    ->setActionBody('btn-click')
                                                    ->setText('Button 1'),

                                                (new \Viber\Api\Keyboard\Button())
                                                    ->setBgColor('#2fa4e7')
                                                    ->setTextHAlign('center')
                                                    ->setActionType('reply')
                                                    ->setActionBody('btn-click')
                                                    ->setText('Button 2'),

                                                (new \Viber\Api\Keyboard\Button())
                                                    ->setBgColor('#555555')
                                                    ->setTextSize('large')
                                                    ->setTextHAlign('left')
                                                    ->setActionType('reply')
                                                    ->setActionBody('btn-click')
                                                    ->setText('Button 3'),
                                            ])
                                    )
                            );
                            break;
                        //
                        case 2:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Contact())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setName('Novikov Bogdan')
                                    ->setPhoneNumber('+380000000000')
                            );
                            break;
                        //
                        case 3:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Location())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setLat(48.486504)
                                    ->setLng(35.038910)
                            );
                            break;
                        //
                        case 4:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Sticker())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setStickerId(114408)
                            );
                            break;
                        //
                        case 5:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Url())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setMedia('https://hcbogdan.com')
                            );
                            break;
                        //
                        case 6:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Picture())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setText('some media data')
                                    ->setMedia('https://developers.viber.com/img/devlogo.png')
                            );
                            break;
                        //
                        case 7:
                            $client->sendMessage(
                                (new \Viber\Api\Message\Video())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setSize(2 * 1024 * 1024)
                                    ->setMedia('http://techslides.com/demos/sample-videos/small.mp4')
                            );
                            break;
                        //
                        case 8:
                            $client->sendMessage(
                                (new \Viber\Api\Message\CarouselContent())
                                    ->setSender($botSender)
                                    ->setReceiver($receiverId)
                                    ->setButtonsGroupColumns(6)
                                    ->setButtonsGroupRows(6)
                                    ->setBgColor('#FFFFFF')
                                    ->setButtons([
                                        (new \Viber\Api\Keyboard\Button())
                                            ->setColumns(6)
                                            ->setRows(3)
                                            ->setActionType('open-url')
                                            ->setActionBody('https://www.google.com')
                                            ->setImage('https://i.vimeocdn.com/portrait/58832_300x300'),

                                        (new \Viber\Api\Keyboard\Button())
                                            ->setColumns(6)
                                            ->setRows(3)
                                            ->setActionType('reply')
                                            ->setActionBody('https://www.google.com')
                                            ->setText('<span style="color: #ffffff; ">Buy</span>')
                                            ->setTextSize("large")
                                            ->setTextVAlign("middle")
                                            ->setTextHAlign("middle")
                                            ->setImage('https://s14.postimg.org/4mmt4rw1t/Button.png')
                                    ])
                            );
                            break;
                    }
                })
                ->run();
        } catch (Exception $e) {
            $log->warning('Exception: ' . $e->getMessage());
            if ($bot) {
                $log->warning('Actual sign: ' . $bot->getSignHeaderValue());
                $log->warning('Actual body: ' . $bot->getInputBody());
            }
        }

    }

    public function actionSendbot()
    {

    }





    public function actionImpopl()
    {
//        echo $message . "\n";
        $nomrec = 0;
        $period = UtPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one();

        $this->lastperiod =date('Y-m-d', strtotime($period->period.' +1 month'));

        $uploadPath = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::$UPLOADS_DIR . DIRECTORY_SEPARATOR;
        echo $uploadPath . "\n";
        if (!file_exists($uploadPath)) {
//            mkdir(Yii::getPathOfAlias('webroot').'/assets/empresas/'.$carpeta, 0644, true);
            mkdir($uploadPath, 0777, true);
        }

        $filename = $uploadPath . 'OPL.DBF';
        echo 'file '.$filename . "\n";
        if (file_exists($filename)) {
            echo 'file exist '."\n";
            UtOpl::deleteAll('period = :period', [':period' => $this->lastperiod]);

            $dbf = @dbase_open($filename, 0) or die("Error!!!  Opening $filename");
            @dbase_pack($dbf);
            $rowsCount = dbase_numrecords($dbf);
//            $functionname = 'import' . strstr($fname, '.', true);

            echo 'rowsCount '.$rowsCount."\n";
            $pr = floor($rowsCount/100);
            $prr = $pr;
            $n=0;
            for ($i = 1; $i <= $rowsCount; $i++) {
                //                $nomrec = $nomrec +1;
                $this->importOPL($dbf, $i);
                if ($i==$prr){
                    $prr=$prr+$pr;
                    $n=$n+1;
                    echo 'Success '.$n .'%'. "\n";
                }

//                        Yii::$app->session->AddFlash('alert-danger', 'Return to false ' . $functionname);
                //				      die("Error!!!  Return to false $functionname");

                //                if ($nomrec==$rowsCount)
                //                {
                //                    break;
                //                }
            }





        }
        else{
            $messageLog = [
                'status' => 'Error for import',
                'Base' => 'opl.dbf',
                'Error' => 'file opl.dbf not found',
            ];

            Yii::error($messageLog, 'import_err');
            echo 'file opl.dbf not found' . "\n";

        }

    }

    function importOPL($dbf, $i)

    {
        $fields = dbase_get_record_with_names($dbf, $i);

        if ($fields['deleted'] <> 1) {
            $schet = trim(iconv('CP866', 'utf-8', $fields['SCHET']));
//					$sum = $fields['SUM'];
//							if ($dom == '8026')
//							{
//								$rowsCount = dbase_numrecords($dbf);
//							}
            if ($schet <> 0 or $schet <> null) {


//						$tipposl = UtTipposl::findOne(['old_tipusl' => $wid]);

                $abon = UtAbonent::findOne(['schet' => $schet]);
                if ($abon <> null ) {

                    foreach ($fields as $k => $v) {
                        if ($v <> 0) {
                            $tipposl = null;
                            switch ($k) {
                                case 'OPL_EL':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'el']);
                                    break;
                                case 'OPL_KV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'kv']);
                                    break;
                                case 'OPL_OM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'om']);
                                    break;
                                case 'OPL_OT':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'ot']);
                                    break;
                                case 'OPL_SM':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'sm']);
                                    break;
                                case 'OPL_HV':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'hv']);
                                    break;
                                case 'OPL_UB':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'ub']);
                                    break;
                                case 'OPL_SN':
                                    $tipposl = UtTipposl::findOne(['old_tipusl' => 'sn']);
                                    break;
                            }


                            if ($tipposl <> null) {
                                $findposl = UtPosl::findOne(['id_abonent' => $abon->id, 'id_tipposl' => $tipposl->id]);
                                if ($findposl == null) {
//								die("Error!!!  Not find is $dbf  to UtPosl $schet $k");
                                    $messageLog = [
                                        'status' => 'Error for import ',
                                        'Base' => 'opl.dbf',
                                        'Poslug' => $findposl,
                                        'schet' => $schet,
                                        'Error' => 'Schet ' . $schet . ' not found poslug ' . $k . ' ' . $tipposl->poslug .' '. date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . substr($fields['DT'], 6, 2))).' '.$v,
                                    ];

                                    Yii::error($messageLog, 'import_err');


                                } else {
                                    if ($this->NewOpl($findposl, $tipposl, $fields, $v)){
//										echo 'Schet ' . $schet . ' import success ' . $k . ' ' . $tipposl->poslug .' '. date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . substr($fields['DT'], 6, 2))).' '.$v . "\n";
                                    }
                                }


                            }
                        }


                    }

                }


            }
        }



        return true;

    }

    function NewOpl($findposl, $tipposl, $fields, $v)

    {
        $narah = new UtOpl();

        $narah->id_org = 1;
        $narah->period = $this->lastperiod;
        $narah->id_abonent = $findposl->id_abonent;
        $narah->id_posl = $findposl->id;
        $narah->id_tipposl = $findposl->id_tipposl;
        $narah->tipposl = $tipposl->poslug;
        $narah->dt = date('Y-m-d', strtotime(substr($fields['DT'], 0, 4) . '-' . substr($fields['DT'], 4, 2) . '-' . substr($fields['DT'], 6, 2)));
        $narah->pach = $fields['PACH'];
        $narah->sum = $v;
        $narah->note = trim($fields['NOTE']);


        if ($narah->validate()) {
            $narah->save();

            return true;
        } else{
            $messageLog = [
                'status' => 'Errror for import (validation)',
                'Base' => 'OPL.DBF',
                'Poslug' => $findposl,
                'Error' => $findposl->getAbonent()->asArray()->one()['schet'] . ' ' . $tipposl->tipposl,
            ];

            Yii::error($messageLog, 'import_err');
        }
        return true;
    }

//    public function beforeAction($action) {
//        if($action->id === 'bot'){
//            Yii::$app->controller->enableCsrfValidation = false;
//        }
//        return parent::beforeAction($action);
//    }

}