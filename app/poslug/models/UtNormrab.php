<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_normrab".
 *
 * @property int $id
 * @property int $id_tarifvid
 * @property string $shifr
 * @property string $naim
 * @property string $ed_izm
 * @property double $norma
 *
 * @property UtDommat[] $utDommats
 * @property UtDomnaryadmat[] $utDomnaryadmats
 * @property UtDomrab[] $utDomrabs
 * @property UtTarifvid $idTarifv
 */
class UtNormrab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_normrab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tarifvid'], 'integer'],
            [['shifr', 'naim', 'ed_izm', 'norma'], 'required'],
            [['norma'], 'number'],
            [['shifr', 'ed_izm'], 'string', 'max' => 11],
            [['naim'], 'string', 'max' => 50],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'shifr' => Yii::t('easyii', 'Shifr'),
            'naim' => Yii::t('easyii', 'Naim'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'norma' => Yii::t('easyii', 'Norma'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDommats()
    {
        return $this->hasMany(UtDommat::className(), ['id_normrab' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomnaryadmats()
    {
        return $this->hasMany(UtDomnaryadmat::className(), ['id_normrab' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomrabs()
    {
        return $this->hasMany(UtDomrab::className(), ['id_normrab' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }
}
