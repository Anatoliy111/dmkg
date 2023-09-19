<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%viber_abon}}".
 *
 * @property int $id
 * @property int $id_viber
 * @property string $date_ins
 * @property string $org
 * @property string|null $schet
 * @property int|null $id_utkart
 * @property string|null $note
 */
class ViberAbon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%viber_abon}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_viber', 'org'], 'required'],
            [['id_viber', 'id_utkart'], 'integer'],
            [['date_ins'], 'safe'],
            [['org'], 'string', 'max' => 7],
            [['schet'], 'string', 'max' => 10],
            [['note'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_viber' => 'Id Viber',
            'date_ins' => 'Date Ins',
            'org' => 'Org',
            'schet' => 'Schet',
            'id_utkart' => 'Id Utkart',
            'note' => 'Note',
        ];
    }

    public function getKart()
    {
        return $this->hasOne(DolgKart::className(), ['schet' => 'schet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViber()
    {
        return $this->hasOne(Viber::className(), ['id' => 'id_viber']);
    }
}
