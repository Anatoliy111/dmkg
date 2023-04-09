<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domnaryad".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_tarifvid
 * @property int $id_sotr
 * @property int $proveden
 * @property double $summa
 *
 * @property UtDommat[] $utDommats
 * @property UtOrg $org
 * @property UtTarifvid $idTarifv
 * @property UtSotr $sotr
 * @property UtDomnaryadmat[] $utDomnaryadmats
 * @property UtDomrab[] $utDomrabs
 */
class UtDomnaryad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domnaryad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_tarifvid', 'id_sotr'], 'required'],
            [['id_org', 'id_tarifvid', 'id_sotr', 'proveden'], 'integer'],
            [['period'], 'safe'],
            [['summa'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
            [['id_sotr'], 'exist', 'skipOnError' => true, 'targetClass' => UtSotr::className(), 'targetAttribute' => ['id_sotr' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'period' => Yii::t('easyii', 'Period'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'id_sotr' => Yii::t('easyii', 'Mayster'),
            'proveden' => Yii::t('easyii', 'Proveden'),
            'summa' => Yii::t('easyii', 'Summa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDommats()
    {
        return $this->hasMany(UtDommat::className(), ['id_naryad' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotr()
    {
        return $this->hasOne(UtSotr::className(), ['id' => 'id_sotr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomnaryadmats()
    {
        return $this->hasMany(UtDomnaryadmat::className(), ['id_naryad' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomrabs()
    {
        return $this->hasMany(UtDomrab::className(), ['id_naryad' => 'id']);
    }
}
