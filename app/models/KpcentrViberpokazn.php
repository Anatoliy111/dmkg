<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kpcentr_viberpokazn".
 *
 * @property int $id
 * @property string $schet
 * @property string $data
 * @property int $pokazn
 * @property int $status
 */
class KpcentrViberpokazn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpcentr_viberpokazn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schet', 'data', 'pokazn'], 'required'],
            [['data'], 'safe'],
            [['pokazn', 'status'], 'integer'],
            [['schet'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schet' => 'Schet',
            'data' => 'Data',
            'pokazn' => 'Pokazn',
            'status' => 'Status',
        ];
    }
}
