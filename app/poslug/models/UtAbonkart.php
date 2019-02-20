<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_abonkart".
 *
 * @property int $id
 * @property int $id_abon
 * @property int $id_kart
 */
class UtAbonkart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_abonkart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_abon', 'id_kart'], 'required'],
            [['id_abon', 'id_kart'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_abon' => Yii::t('easyii', 'Id Abon'),
            'id_kart' => Yii::t('easyii', 'Id Kart'),
        ];
    }
}
