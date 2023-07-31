<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_voda".
 *
 * @property int|null $ID
 * @property int|null $YEARMON
 * @property string|null $SCHET
 * @property float|null $SCH_CUR
 * @property float|null $KUB
 * @property string|null $DATE_POK
 */
class UtVoda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ut_voda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'YEARMON'], 'integer'],
            [['SCH_CUR', 'KUB'], 'number'],
            [['DATE_POK'], 'safe'],
            [['SCHET'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'YEARMON' => 'Yearmon',
            'SCHET' => 'Schet',
            'SCH_CUR' => 'Sch Cur',
            'KUB' => 'Kub',
            'DATE_POK' => 'Date Pok',
        ];
    }
}
