<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_period".
 *
 * @property int $id
 * @property string $period
 */
class UtPeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period'], 'required'],
            [['period'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'period' => Yii::t('easyii', 'Period'),
        ];
    }
}
