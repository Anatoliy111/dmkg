<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_lich".
 *
 * @property int|null $ID
 * @property string|null $SCHET
 * @property string|null $TIP
 * @property string|null $N_LICH
 * @property string|null $DATA_POV
 * @property string|null $DATA_VIG
 * @property int|null $VID_ZN
 */
class UtLich extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ut_lich';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'VID_ZN'], 'integer'],
            [['DATA_POV', 'DATA_VIG'], 'safe'],
            [['SCHET'], 'string', 'max' => 10],
            [['TIP', 'N_LICH'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SCHET' => 'Рахунок',
            'TIP' => 'Тип лічильника',
            'N_LICH' => '№ лічильника',
            'DATA_POV' => 'Дата повірки',
            'DATA_VIG' => 'Дата виготовлення',
            'VID_ZN' => 'Vid Zn',
        ];
    }
}
