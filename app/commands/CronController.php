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
use Yii;
use yii\console\Controller;
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
    public static $UPLOADS_DIR = 'uploads/import/cron';

    public $lastperiod;

    public function actionIndex($message = 'hello00000000000000 world')
    {
        echo $message . "\n";
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
            mkdir($uploadPath, 0644, true);
        }

        $filename = $uploadPath . '/OPL.DBF';
        if (file_exists($filename)) {

            UtOpl::deleteAll('period = :period', [':period' => $this->lastperiod]);

            $dbf = @dbase_open($filename, 0) or die("Error!!!  Opening $filename");
            @dbase_pack($dbf);
            $rowsCount = dbase_numrecords($dbf);
//            $functionname = 'import' . strstr($fname, '.', true);


            $pr = floor($rowsCount/100);
            $prr = $pr;
            $n=0;
            for ($i = 1; $i <= $rowsCount; $i++) {
                //                $nomrec = $nomrec +1;
                $this->importOPL($dbf, $i);
                if ($i==$prr){
                    $prr=$prr+$pr;
                    $n=$n+1;
                    echo 'Выпонено '.$n .'%'. "\n";
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

}