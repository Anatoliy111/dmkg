<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "viber".
 *
 * @property int $id
 * @property string $api_key
 * @property string $org
 * @property string $id_receiver
 * @property string $name
 * @property string $status
 * @property string $note
 *
 * @property ViberAbon[] $viberAbons
 */
class Viber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_key', 'org', 'id_receiver'], 'required'],
            [['api_key'], 'string', 'max' => 50],
            [['org'], 'string', 'max' => 7],
            [['id_receiver'], 'string', 'max' => 30],
            [['name', 'note'], 'string', 'max' => 64],
            [['status'], 'string', 'max' => 250],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'api_key' => 'Api Key',
            'org' => 'Org',
            'id_receiver' => 'Id Receiver',
            'name' => 'Name',
            'status' => 'Status',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViberAbons()
    {
        return $this->hasMany(ViberAbon::className(), ['id_viber' => 'id']);
    }
}
