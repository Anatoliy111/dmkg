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
 * @property string|null $vb_api_key
 * @property string $vb_date
 * @property string|null $vb_org
 * @property string|null $vb_receiver
 * @property string|null $vb_name
 * @property string|null $vb_status
 *
 * @property UtAbschet[] $utAbschets
 */
class UtAbonent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['id_org'], 'required'],
            [['id_org', 'id_kart', 'val', 'del', 'telefon'], 'integer'],
            [['note'], 'string'],
            [['date_pass', 'date_entry', 'vb_date'], 'safe'],
            [['schet'], 'string', 'max' => 11],
            [['fio'], 'string', 'max' => 124],
            [['pass', 'passopen', 'vb_name', 'vb_status'], 'string', 'max' => 64],
            [['email', 'vb_api_key'], 'string', 'max' => 50],
            [['vb_org'], 'string', 'max' => 7],
            [['vb_receiver'], 'string', 'max' => 30],
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
            'vb_api_key' => 'Vb Api Key',
            'vb_date' => 'Vb Date',
            'vb_org' => 'Vb Org',
            'vb_receiver' => 'Vb Receiver',
            'vb_name' => 'Vb Name',
            'vb_status' => 'Vb Status',
        ];
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
