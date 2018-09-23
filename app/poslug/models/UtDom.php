<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_dom".
 *
 * @property int $id
 * @property string $n_dom номер будинку
 * @property int $id_ulica вулиця
 * @property int $id_house дом из softproekt
 * @property string $note нотатки
 * @property string $image фото
 *
 * @property UtAbonent[] $utAbonents
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

    public $period;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['n_dom', 'id_ulica'], 'required'],
            [['id_ulica','id_house'], 'integer'],
            [['note','image'], 'string'],
            [['n_dom'], 'string', 'max' => 11],
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
            'note' => Yii::t('easyii', 'Note'),
            'image' => Yii::t('easyii', 'Image'),
            'id_house' => Yii::t('easyii', 'Id House'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtKart()
    {
        return $this->hasMany(UtKart::className(), ['id_dom' => 'id']);
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

    public function getUtTarif()
    {
        return $this->hasMany(UtTarif::className(), ['id_dom' => 'id']);
    }
}
