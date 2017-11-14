<?php

namespace app\poslug\models;


use Yii;

/**
 * This is the model class for table "ut_kart".
 *
 * @property int $id
 * @property string $name_f прізвище
 * @property string $name_i імя
 * @property string $name_o побатькові
 * @property string $fio власник
 * @property int $idcod ид.код
 * @property int $id_ulica вулиця
 * @property string $dom номер будинку
 * @property string $korp корпус
 * @property string $kv квартира
 * @property int $ur_fiz юр чи фіз
 * @property string $pass пароль
 * @property string $telef телефон
 * @property int id_rabota робота
 * @property int $id_dom многокв дом
 * @property int $privat приватизация
 *
 * @property UtAbonent[] $utAbonents
 * @property UtUlica $ulica
 */
class UtKart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_kart';
    }
	public $pass1;
	public $pass2;

	const SCENARIO_ADDR = 'adres';
	const SCENARIO_PASS = 'password';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_f', 'fio', 'id_ulica'], 'required'],
            [['id_ulica', 'ur_fiz', 'id_dom', 'privat','id_rabota'], 'integer'],
            [['name_f'], 'string', 'max' => 50],
            [['name_i', 'name_o'], 'string', 'max' => 30],
            [['dom'], 'string', 'max' => 4],
			[['kv'], 'string', 'max' => 5],
            [['korp'], 'string', 'max' => 1],
            [['pass1'], 'string', 'max' => 64],
			[['pass2'], 'string', 'max' => 64],
			[['fio'], 'string', 'max' => 64],
            [['telef'], 'string', 'max' => 20],
			[['idcod'], 'string', 'max' => 25],
            [['id_ulica'], 'exist', 'skipOnError' => true, 'targetClass' => UtUlica::className(), 'targetAttribute' => ['id_ulica' => 'id']],
			[['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
			[['id_rabota'], 'exist', 'skipOnError' => true, 'targetClass' => UtRabota::className(), 'targetAttribute' => ['id_rabota' => 'id']],
			[['pass1'], 'string', 'min' => 5],
			[['pass2'], 'string', 'min' => 5],
			['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають !!!'],
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
            'ur_fiz' => Yii::t('easyii', 'Ur Fiz'),
            'pass1' => Yii::t('easyii', 'Pass1'),
			'pass2' => Yii::t('easyii', 'Pass2'),
            'telef' => Yii::t('easyii', 'Telef'),
			'id_rabota' => Yii::t('easyii', 'Rabota'),
			'id_dom' => Yii::t('easyii', 'Id Dom'),
			'privat' => Yii::t('easyii', 'Privat'),
        ];
    }

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_ADDR] = [['name_f', 'fio', 'id_ulica', 'dom'], 'required'];
		$scenarios[self::SCENARIO_PASS] = [['pass1', 'pass2'], 'required'];
		return $scenarios;
	}



    /**
     * @return \yii\db\ActiveQuery
	 *
	 *
	 *
     */
	public function getUtAbonents()
	{
		return $this->hasMany(UtAbonent::className(), ['id_kart' => 'id']);
	}

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUlica()
    {
        return $this->hasOne(UtUlica::className(), ['id' => 'id_ulica']);
    }

	public function getRabota()
	{
		return $this->hasOne(UtRabota::className(), ['id' => 'id_rabota']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDom()
	{
		return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
	}


}
