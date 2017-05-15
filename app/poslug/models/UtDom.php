<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_dom".
 *
 * @property int $id
 * @property string $n_dom номер будинку
 * @property int $id_ulica вулиця
 * @property int $kol_kv кіль квартир
 * @property int $kol_pod кіль піїздів
 * @property int $kol_etag кіль поверхів
 * @property int $lift чи є ліфт
 * @property string $note нотатки
 * @property int $id_olddom стара база дом
 *
 * @property UtAbonent[] $utAbonents
 * @property UtOlddom $olddom
 * @property UtUlica $ulica
 * @property UtPosl[] $utPosls
 */
class UtDom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_dom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['n_dom', 'id_ulica'], 'required'],
            [['id_ulica', 'kol_kv', 'kol_pod', 'kol_etag', 'lift', 'id_olddom'], 'integer'],
            [['note'], 'string'],
            [['n_dom'], 'string', 'max' => 11],
            [['id_olddom'], 'exist', 'skipOnError' => true, 'targetClass' => UtOlddom::className(), 'targetAttribute' => ['id_olddom' => 'id']],
            [['id_ulica'], 'exist', 'skipOnError' => true, 'targetClass' => UtUlica::className(), 'targetAttribute' => ['id_ulica' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'n_dom' => Yii::t('easyii', 'N Dom'),
            'id_ulica' => Yii::t('easyii', 'Id Ulica'),
            'kol_kv' => Yii::t('easyii', 'Kol Kv'),
            'kol_pod' => Yii::t('easyii', 'Kol Pod'),
            'kol_etag' => Yii::t('easyii', 'Kol Etag'),
            'lift' => Yii::t('easyii', 'Lift'),
            'note' => Yii::t('easyii', 'Note'),
            'id_olddom' => Yii::t('easyii', 'Id Olddom'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtAbonents()
    {
        return $this->hasMany(UtAbonent::className(), ['id_dom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOlddom()
    {
        return $this->hasOne(UtOlddom::className(), ['id' => 'id_olddom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlica()
    {
        return $this->hasOne(UtUlica::className(), ['id' => 'id_ulica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPosls()
    {
        return $this->hasMany(UtPosl::className(), ['id_dom' => 'id']);
    }
}
