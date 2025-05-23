<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pokazn}}".
 *
 * @property int $id
 * @property int|null $yearmon
 * @property float|null $pokazn
 * @property string|null $date_pok
 * @property int|null $vid_pok
 * @property int|null $n_doc
 * @property string|null $date_zn
 * @property int|null $vid_zn
 * @property string|null $schet
 * @property int|null $id_lich
 * @property float|null $ppp
 * @property string|null $fio
 * @property int|null $fl_bigpok
 * @property string|null $user_naim
 * @property int|null $id_user
 * @property string $date_user
 * @property string|null $note
 * @property int|null $del
 * @property int|null $pokaznik
 */
class Pokazn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pokazn}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('hvddb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yearmon', 'vid_pok', 'n_doc', 'vid_zn', 'id_lich', 'fl_bigpok', 'id_user', 'del', 'pokaznik'], 'integer'],
            [['pokazn', 'ppp'], 'number'],
            [['date_pok', 'date_zn'], 'string'],
            [['date_user'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['fio'], 'string', 'max' => 64],
            [['user_naim'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'yearmon' => 'Yearmon',
            'pokazn' => 'Pokazn',
            'date_pok' => 'Date Pok',
            'vid_pok' => 'Vid Pok',
            'n_doc' => 'N Doc',
            'date_zn' => 'Date Zn',
            'vid_zn' => 'Vid Zn',
            'schet' => 'Schet',
            'id_lich' => 'Id Lich',
            'ppp' => 'Ppp',
            'fio' => 'Fio',
            'fl_bigpok' => 'Fl Bigpok',
            'user_naim' => 'User Naim',
            'id_user' => 'Id User',
            'date_user' => 'Date User',
            'note' => 'Note',
            'del' => 'Del',
            'pokaznik' => 'Pokaznik',
        ];
    }

    public function getSprzn()
    {
        return $this->hasOne(SprZn::className(), ['id' => 'vid_pok']);
    }
}
