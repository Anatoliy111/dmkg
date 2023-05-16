<?php

namespace app\models;

use app\poslug\models\UtDom;
use Yii;

/**
 * This is the model class for table "ut_abonent".
 *
 * @property int $id
 * @property string $fio власник
 * @property string|null $pass пароль
 * @property string|null $date_pass
 * @property string|null $passopen
 * @property string|null $telef телефон
 * @property int|null $del
 * @property string|null $email
 * @property int|null $status
 *
 * @property UtAbonkart[] $utAbonkarts
 */
class UtAbonent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $pass1;
    public $pass2;
    public $enterpass;


    const SCENARIO_PASS = 'password';


    public static function tableName()
    {
        return 'ut_abonent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio'], 'required'],
            [['date_pass'], 'safe'],
            [['del', 'status'], 'integer'],
            [['fio', 'passopen'], 'string', 'max' => 64],
            [['telef'], 'string', 'max' => 15],
            [['email'], 'email'],
            [['pass'], 'string', 'min' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ПІБ',
            'pass' => 'пароль',
            'date_pass' => 'Date Pass',
            'passopen' => 'Passopen',
            'telef' => 'телефон',
            'del' => 'Del',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[UtAbonkarts]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PASS] = ['pass1', 'pass2'];
        return $scenarios;
    }

    public function getAbonkarts()
    {
        return $this->hasMany(UtAbonkart::class, ['id_abon' => 'id']);
    }

    public function getKarts()
    {
        $abkarts =$this->hasMany(UtAbonkart::class, ['id_abon' => 'id']);

        return $abkarts->primaryModel['dom']->getUlica();

    }
}
