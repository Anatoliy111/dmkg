<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kpcentr_pokazn".
 *
 * @property int $id
 * @property string $period
 * @property string $schet
 * @property string $date_pok
 * @property int $pokazn
 * @property int $status
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
            [['schet', 'date_pok', 'pokazn'], 'required'],
            [['period'], 'safe'],
            [['date_pok'], 'safe'],
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
            'period' => 'Period',
            'schet' => 'Schet',
            'date_pok' => 'Date',
            'pokazn' => 'Pokazn',
            'status' => 'Status',
        ];
    }
}
