<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domrab".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_dom
 * @property int $id_tarifvid
 * @property int $id_naryad
 * @property int $id_normrab
 * @property string $ed_izm
 * @property double $norm_ed
 * @property int $kol_day
 * @property double $obiem
 * @property double $norm_chas
 * @property string $notevid
 * @property double $summa
 * @property int $proveden
 *
 * @property UtOrg $org
 * @property UtDom $dom
 * @property UtTarifvid $idTarifv
 * @property UtDomnaryad $naryad
 * @property UtNormrab $normrab
 */
class UtDomrab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domrab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_dom', 'id_tarifvid', 'id_naryad'], 'required'],
            [['id_org', 'id_dom', 'id_tarifvid', 'id_naryad', 'id_normrab', 'kol_day', 'proveden'], 'integer'],
            [['period'], 'safe'],
            [['norm_ed', 'obiem', 'norm_chas', 'summa'], 'number'],
            [['ed_izm'], 'string', 'max' => 11],
            [['notevid'], 'string', 'max' => 200],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
            [['id_naryad'], 'exist', 'skipOnError' => true, 'targetClass' => UtDomnaryad::className(), 'targetAttribute' => ['id_naryad' => 'id']],
            [['id_normrab'], 'exist', 'skipOnError' => true, 'targetClass' => UtNormrab::className(), 'targetAttribute' => ['id_normrab' => 'id']],
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
            'id_dom' => Yii::t('easyii', 'Id Dom'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'id_naryad' => Yii::t('easyii', 'Id Naryad'),
            'id_normrab' => Yii::t('easyii', 'Id Normrab'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'norm_ed' => Yii::t('easyii', 'Norm Ed'),
            'kol_day' => Yii::t('easyii', 'Kol Day'),
            'obiem' => Yii::t('easyii', 'Obiem'),
            'norm_chas' => Yii::t('easyii', 'Norm Chas'),
            'notevid' => Yii::t('easyii', 'Notevid'),
            'summa' => Yii::t('easyii', 'Summa'),
            'proveden' => Yii::t('easyii', 'Proveden'),
        ];
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
    public function getDom()
    {
        return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
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
    public function getNaryad()
    {
        return $this->hasOne(UtDomnaryad::className(), ['id' => 'id_naryad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNormrab()
    {
        return $this->hasOne(UtNormrab::className(), ['id' => 'id_normrab']);
    }
}
