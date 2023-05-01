<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_abonent".
 *
 * @property int $id
 * @property int $id_org организация
 * @property string|null $schet особовий рахунок
 * @property string|null $fio ФИО
 * @property int|null $id_kart адресна картка 
 * @property string|null $note заметки
 * @property int|null $val
 * @property int $del видалена
 * @property string|null $pass
 * @property string|null $date_pass
 * @property string|null $passopen
 * @property string|null $email
 * @property int|null $telefon
 * @property string|null $date_entry

 *
 * @property UtAbschet[] $utAbschets
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
    const SCENARIO_EMAIL = 'email';

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
            [['pass1', 'pass2'], 'required'],
            [['id_org'], 'required'],
            [['id_org', 'id_kart', 'val', 'del', 'telefon'], 'integer'],
            [['note'], 'string'],
            [['date_pass', 'date_entry', 'vb_date'], 'safe'],
            [['schet'], 'string', 'max' => 11],
            [['fio'], 'string', 'max' => 124],
            [['pass', 'passopen'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 50],
            [['enterpass'], 'string', 'min' => 5],
            [['pass1'], 'string', 'max' => 64],
            [['pass2','pass','passopen'], 'string', 'max' => 64],
            [['pass1'], 'string', 'min' => 5],
            [['pass2'], 'string', 'min' => 5],
            ['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають !!!'],
            [['enterpass'], 'compare',  'compareValue' => $this->pass, 'operator' => '==', 'message' => 'Код доступу не вірний !!!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_org' => 'организация',
            'schet' => 'особовий рахунок',
            'fio' => 'ФИО',
            'id_kart' => 'адресна картка ',
            'note' => 'заметки',
            'val' => 'Val',
            'del' => 'видалена',
            'pass' => 'Pass',
            'date_pass' => 'Date Pass',
            'passopen' => 'Passopen',
            'email' => 'Email',
            'telefon' => 'Telefon',
            'date_entry' => 'Date Entry',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_PASS] = [['pass1', 'pass2'], 'required'];
        $scenarios[self::SCENARIO_EMAIL] = [['email', 'enterpass'], 'required'];
        return $scenarios;
    }

    /**
     * Gets query for [[UtAbschets]].
     *
     * @return \yii\db\ActiveQuery|UtAbschetQuery
     */
    public function getUtAbschets()
    {
        return $this->hasMany(UtAbschet::class, ['id_abonent' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UtAbonentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UtAbonentQuery(get_called_class());
    }
}
