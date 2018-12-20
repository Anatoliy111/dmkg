<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_period".
 *
 * @property int $id
 * @property string $period
 * @property string $mes
 * @property int $imp_km
 * @property int $imp_kp
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
            [['imp_km', 'imp_kp'], 'integer'],
            [['mes'], 'string', 'max' => 15],
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
            'mes' => Yii::t('easyii', 'Mes'),
            'imp_km' => Yii::t('easyii', 'Imp Km'),
            'imp_kp' => Yii::t('easyii', 'Imp Kp'),
        ];
    }
}
