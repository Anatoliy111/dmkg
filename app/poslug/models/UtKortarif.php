<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_kortarif".
 *
 * @property int $id
 * @property int $id_tipposl
 * @property string $period
 * @property string $schet
 * @property string $schet1
 * @property double $days
 * @property double $tarif
 * @property string $note
 * @property int $kl_ntar
 *
 * @property UtTipposl $tipposl
 */
class UtKortarif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_kortarif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipposl'], 'required'],
            [['id_tipposl', 'kl_ntar'], 'integer'],
            [['days', 'tarif'], 'number'],
            [['period'], 'safe'],
            [['schet', 'schet1'], 'string', 'max' => 11],
            [['note'], 'string', 'max' => 50],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'schet' => Yii::t('easyii', 'Schet'),
            'schet1' => Yii::t('easyii', 'Schet1'),
            'days' => Yii::t('easyii', 'Days'),
            'tarif' => Yii::t('easyii', 'Tarif'),
            'note' => Yii::t('easyii', 'Note'),
            'kl_ntar' => Yii::t('easyii', 'Kl Ntar'),
            'period' => Yii::t('easyii', 'period'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }
}
