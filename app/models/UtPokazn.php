<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_pokazn".
 *
 * @property int|null $ID
 * @property int|null $YEARMON
 * @property float|null $POKAZN
 * @property string|null $DATE_POK
 * @property int|null $VID_POK
 * @property int|null $N_DOC
 * @property string|null $DATE_ZN
 * @property int|null $VID_ZN
 * @property string|null $SCHET
 * @property int|null $ID_LICH
 * @property string|null $VID
 */
class UtPokazn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ut_pokazn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'YEARMON', 'VID_POK', 'N_DOC', 'VID_ZN', 'ID_LICH'], 'integer'],
            [['POKAZN'], 'number'],
            [['DATE_POK', 'DATE_ZN'], 'safe'],
            [['SCHET'], 'string', 'max' => 10],
            [['VID'], 'string', 'max' => 50],
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
            'POKAZN' => 'Pokazn',
            'DATE_POK' => 'Date Pok',
            'VID_POK' => 'Vid Pok',
            'N_DOC' => 'N Doc',
            'DATE_ZN' => 'Date Zn',
            'VID_ZN' => 'Vid Zn',
            'SCHET' => 'Schet',
            'ID_LICH' => 'Id Lich',
            'VID' => 'Vid',
        ];
    }
}
