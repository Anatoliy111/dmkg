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
class
UtAbonent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $pass1;
    public $pass2;


    const SCENARIO_PASS = 'password';
    const SCENARIO_REG = 'reg';
    const SCENARIO_CONFREG = 'confreg';
    const SCENARIO_EMAIL = 'email';
    const SCENARIO_FIO = 'fio';

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
            [['fio','pass1','pass2','email','pass'], 'required'],
            [['date_pass'], 'safe'],
            [['del', 'status'], 'integer'],
            [['fio', 'passopen'], 'string', 'max' => 64],
            [['fio'], 'string', 'min' => 5],
            [['telef'], 'string', 'max' => 15],
            [['email'], 'email'],
            [['pass'], 'string', 'min' => 5],
            [['pass1'], 'string', 'min' => 5],
            [['pass2'], 'string', 'min' => 5],
            ['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають, повторіть пароль ще раз!!!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ПІП',
            'pass' => 'Введіть пароль',
            'date_pass' => 'Date Pass',
            'passopen' => 'Passopen',
            'telef' => 'телефон',
            'del' => 'Del',
            'email' => 'Email',
            'status' => 'Status',
            'pass1' => 'Введіть пароль',
            'pass2' => 'Повторіть пароль',
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
        $scenarios[self::SCENARIO_REG] = ['email','fio','pass1','pass2'];
        $scenarios[self::SCENARIO_CONFREG] = ['fio','pass','email'];
        $scenarios[self::SCENARIO_EMAIL] = ['email'];
        $scenarios[self::SCENARIO_FIO] = ['fio'];
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
