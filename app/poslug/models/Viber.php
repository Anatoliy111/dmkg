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
            [['api_key', 'org', 'id_receiver', 'name', 'status', 'note'], 'required'],
            [['api_key'], 'string', 'max' => 50],
            [['org'], 'string', 'max' => 6],
            [['id_receiver'], 'string', 'max' => 30],
            [['name', 'status', 'note'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'api_key' => Yii::t('easyii', 'Api Key'),
            'org' => Yii::t('easyii', 'Org'),
            'id_receiver' => Yii::t('easyii', 'Id Receiver'),
            'name' => Yii::t('easyii', 'Name'),
            'status' => Yii::t('easyii', 'Status'),
            'note' => Yii::t('easyii', 'Note'),
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
