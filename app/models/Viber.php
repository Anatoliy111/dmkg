<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%viber}}".
 *
 * @property int $id
 * @property string $api_key
 * @property string $date_ins
 * @property string $org
 * @property string $id_receiver
 * @property string $name
 * @property string $status
 * @property int $admin
 * @property int $id_abonent
 * @property string $note
 */
class Viber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%viber}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['api_key', 'org', 'id_receiver'], 'required'],
            [['date_ins'], 'safe'],
            [['admin', 'id_abonent'], 'integer'],
            [['api_key'], 'string', 'max' => 50],
            [['org'], 'string', 'max' => 7],
            [['id_receiver'], 'string', 'max' => 30],
            [['name', 'status', 'note'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'api_key' => 'Api Key',
            'date_ins' => 'Date Ins',
            'org' => 'Org',
            'id_receiver' => 'Id Receiver',
            'name' => 'Name',
            'status' => 'Status',
            'admin' => 'Admin',
            'id_abonent' => 'Id Abonent',
            'note' => 'Note',
        ];
    }

    public function getViberAbons()
    {
        return $this->hasMany(ViberAbon::className(), ['id_viber' => 'id']);
    }

    public function getUtAbonkart()
    {
        return $this->hasMany(UtAbonkart::className(), ['id_abon' => 'id_abonent']);
    }
}
