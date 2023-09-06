<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%period}}".
 *
 * @property int $kl
 * @property string|null $period
 * @property int|null $aktiv
 */
class DolgPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%period}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dolgdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period'], 'string'],
            [['aktiv'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'period' => 'Period',
            'aktiv' => 'Aktiv',
        ];
    }
}
