<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_auth".
 *
 * @property int $id
 * @property int $id_abonent
 * @property string $fio
 * @property string $pass
 * @property string $email
 * @property string $authtoken
 * @property string $vid
 *
 * @property UtAbonent $abonent
 */
class UtAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $pass1;
    public $pass2;

    const SCENARIO_REG = 'reg';
    const SCENARIO_EMAIL = 'email';

    const VID_AUTHSITE = 'authsite';
    const VID_AUTHVIBER = 'authviber';
    const VID_FOGPASS = 'fogpass';

    public static function tableName()
    {
        return 'ut_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_abonent', 'fio', 'pass', 'email', 'authtoken','pass1','pass2','vid'], 'required'],
            [['id_abonent'], 'integer'],
            [['pass1'], 'string', 'min' => 5],
            [['pass2'], 'string', 'min' => 5],
            ['email', 'email'],
            [['fio', 'pass', 'email', 'authtoken','vid'], 'string', 'max' => 64],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['id_abonent' => 'id']],
            ['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають !!!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_abonent' => 'Id Abonent',
            'fio' => 'ПІБ',
            'pass' => 'Pass',
            'email' => 'Email',
            'authtoken' => 'Authtoken',
            'pass1' => 'Введіть пароль',
            'pass2' => 'Повторіть пароль',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_REG] = ['fio','pass1','pass2','email','authtoken','vid'];
        $scenarios[self::SCENARIO_EMAIL] = ['email','authtoken','vid'];
        return $scenarios;
    }

    /**
     * Gets query for [[Abonent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::class, ['id' => 'id_abonent']);
    }
}
