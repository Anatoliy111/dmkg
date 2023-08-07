<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "h_voda".
 *
 * @property int $kl
 * @property int $yearmon
 * @property int $sch_cur
 * @property int $sch_razn
 *
 */
class HVoda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'h_voda';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('fdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yearmon'], 'integer'],
            [['sch_cur','sch_razn'], 'number'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'yearmon' => 'Yearmon',
            'sch_cur' => 'Показник',
            'sch_razn' => 'Куби',
        ];
    }
}
