<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_abonkart".
 *
 * @property int $id
 * @property int $id_abon
 * @property int $id_kart
 * @property string|null $schet
 *
 * @property UtAbonent $abon
 * @property UtKart $kart
 */
class UtAbonkart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ut_abonkart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_abon', 'id_kart'], 'required'],
            [['id_abon', 'id_kart'], 'integer'],
            [['schet'], 'string', 'max' => 11],
            [['id_abon'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['id_abon' => 'id']],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtKart::class, 'targetAttribute' => ['id_kart' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_abon' => 'Id Abon',
            'id_kart' => 'Id Kart',
            'schet' => 'Schet',
        ];
    }

    /**
     * Gets query for [[Abon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbon()
    {
        return $this->hasOne(UtAbonent::class, ['id' => 'id_abon']);
    }

    /**
     * Gets query for [[Kart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKart()
    {
        return $this->hasOne(UtKart::class, ['id' => 'id_kart']);
    }

}
