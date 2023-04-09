<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_vidpokaz".
 *
 * @property int $id
 * @property string $vid_pokaz вид показника
 * @property int $flag_lich флаг лічильника
 * @property int $flag_lichskl флаг лічильника складного
 * @property string $ed_izm од вим
 * @property int $flag_dom флаг багатокв будинку
 *
 * @property UtPokaz[] $utPokazs
 * @property UtTarif[] $utTarifs
 * @property UtTipposl[] $utTipposls
 * @property UtTipposl[] $utTipposls0
 */
class UtVidpokaz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_vidpokaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid_pokaz'], 'required'],
            [['flag_lich', 'flag_lichskl', 'flag_dom', 'flag_dom'], 'integer'],
            [['vid_pokaz'], 'string', 'max' => 64],
            [['ed_izm'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'vid_pokaz' => Yii::t('easyii', 'Vid Pokaz'),
            'flag_lich' => Yii::t('easyii', 'Flag Lich'),
            'flag_lichskl' => Yii::t('easyii', 'Flag Lichskl'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'flag_dom' => Yii::t('easyii', 'Flag Dom'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPokazs()
    {
        return $this->hasMany(UtPokaz::className(), ['id_vidpokaz' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTarifs()
    {
        return $this->hasMany(UtTarif::className(), ['id_vidpokaz' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTipposls()
    {
        return $this->hasMany(UtTipposl::className(), ['id_vidpokaz' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTipposls0()
    {
        return $this->hasMany(UtTipposl::className(), ['id_vidpokazprop' => 'id']);
    }

    public function getEdizm()
    {
        return $this->hasOne(UtEdizm::className(), ['id' => 'ed_izm']);
    }
}
