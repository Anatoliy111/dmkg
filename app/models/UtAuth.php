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
 * @property string $id_receiver
 *
 * @property UtAbonent $abonent
 */
class UtAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const SCENARIO_REG = 'reg';
    const SCENARIO_EMAIL = 'email';
//    const SCENARIO_TOKEN= 'token';

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
            [['id_abonent', 'fio', 'pass', 'email', 'authtoken','vid'], 'required'],
            [['id_abonent'], 'integer'],
            ['email', 'email'],
            [['fio', 'pass', 'email', 'authtoken','vid'], 'string', 'max' => 64],
            [['id_receiver'], 'string', 'max' => 30],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['id_abonent' => 'id']],
//            [['authtoken'], 'compare',  'compareValue' => $this->authtoken, 'operator' => '==', 'message' => 'token not found'],
//            [['authtoken'], 'exist', 'skipOnError' => true, 'targetClass' => UtAuth::class, 'targetAttribute' => ['authtoken' => 'authtoken'],'message' => 'token not found','on' => self::SCENARIO_TOKEN],

//            [['email'], 'unique', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['email' => 'email'],'message' => 'Email вже зареєстрований!!!'],
     //       ['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають !!!'],
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
            'id_receiver' => 'id receiver',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_REG] = ['fio','pass','email','authtoken','vid'];
        $scenarios[self::SCENARIO_EMAIL] = ['email','authtoken','vid'];
//        $scenarios[self::SCENARIO_TOKEN] = [['authtoken'], 'required'];
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
