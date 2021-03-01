<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kpcentr_pokazn".
 *
 * @property int $id
 * @property string $schet
 * @property string $date
 * @property int $pokazn
 */
class KpcentrPokazn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpcentr_pokazn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schet', 'date', 'pokazn'], 'required'],
            [['date'], 'safe'],
            [['pokazn'], 'integer'],
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
            'date' => 'Date',
            'pokazn' => 'Pokazn',
        ];
    }
}
