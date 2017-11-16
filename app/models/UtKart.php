<?php

namespace app\models;

use app\poslug\models\UtObor;
use app\poslug\models\UtUlica;
use Yii;

/**
 * This is the model class for table "ut_kart".
 *
 * @property int $id
 * @property string $name_f прізвище
 * @property string $name_i імя
 * @property string $name_o побатькові
 * @property string $fio власник
 * @property string $idcod ид.код
 * @property int $id_ulica вулиця
 * @property string $dom номер будинку
 * @property string $korp корпус
 * @property string $kv квартира
 * @property int $ur_fiz юр чи фіз
 * @property string $pass пароль
 * @property string $telef телефон
 * @property string $email
 * @property string $status
 * @property int $id_oldkart стара база
 *
 * @property UtUlica $ulica
 */
class UtKart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

	public $enterpass;
    public $periodd;
    public $lastperiod;
    public $MonthYear;


    public static function tableName()
    {
        return 'ut_kart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_f', 'fio', 'id_ulica', 'dom', 'enterpass'], 'required'],
            [['id_ulica','ur_fiz', 'id_oldkart','status'], 'integer'],
            [['name_f'], 'string', 'max' => 50],
            [['name_i', 'name_o','email'], 'string', 'max' => 30],
            [['fio', 'pass'], 'string', 'max' => 64],
            [['idcod'], 'string', 'max' => 25],
            [['dom'], 'string', 'max' => 4],
            [['kv'], 'string', 'max' => 5],
			[['MonthYear'], 'safe'],
			['email', 'email'],
            [['korp'], 'string', 'max' => 1],
            [['telef'], 'string', 'max' => 15],
            [['id_ulica'], 'exist', 'skipOnError' => true, 'targetClass' => UtUlica::className(), 'targetAttribute' => ['id_ulica' => 'id']],
//			[['enterschet'], 'string', 'min' => 8],
			[['enterpass'], 'string', 'min' => 7],
			[['auth_key', 'acess_token'], 'string', 'max' => 32],
//			[['enterpass'], 'compare',  'compareValue' => $this->pass, 'operator' => '==', 'message' => 'Код доступу не вірний !!!'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'name_f' => Yii::t('easyii', 'Name F'),
            'name_i' => Yii::t('easyii', 'Name I'),
            'name_o' => Yii::t('easyii', 'Name O'),
            'fio' => Yii::t('easyii', 'Fio'),
            'idcod' => Yii::t('easyii', 'Idcod'),
            'id_ulica' => Yii::t('easyii', 'Id Ulica'),
            'dom' => Yii::t('easyii', 'Dom'),
            'korp' => Yii::t('easyii', 'Korp'),
            'kv' => Yii::t('easyii', 'Kv'),
			'email' => Yii::t('easyii', 'Email'),
            'ur_fiz' => Yii::t('easyii', 'Ur Fiz'),
            'pass' => Yii::t('easyii', 'Pass'),
			'status' => Yii::t('easyii', 'Status'),
            'telef' => Yii::t('easyii', 'Telef'),
            'id_oldkart' => Yii::t('easyii', 'Id Oldkart'),
			'enterpass' => Yii::t('easyii', 'Еnterpass'),
			'MonthYear' => 'Період',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlica()
    {
        return $this->hasOne(UtUlica::className(), ['id' => 'id_ulica']);
    }

    public function period()
    {
//        $sql = 'Select id_org,period from ut_obor group by id_org,period order by id_org,period ';
//        $periodd1 = UtObor::findbysql($sql)->all();
		$periodd  = UtObor::find()->select('id_org','period')->groupBy('id_org','period')->orderBy('id_org','period')->all();
        return $periodd;
    }

    public function lastperiod()
    {
//        $sql = 'Select id_org,period from ut_obor group by id_org,period order by id_org,period ';
//        $lastperiod = UtObor::find()->all();
        $lastperiod = UtObor::find()->max('period');
//        $lastperiod = UtObor::find()->select(['period, id_org'])->distinct();
//        $lastperiod = ArrayHelper::map(UtUlica::find()->asArray()->all(), 'ID', 'ul'),
        return $lastperiod;
    }


}
