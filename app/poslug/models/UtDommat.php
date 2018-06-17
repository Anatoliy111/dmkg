<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_dommat".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_dom
 * @property int $id_tarifvid
 * @property int $id_naryad
 * @property int $id_normrab
 * @property string $nom_n
 * @property string $naim
 * @property string $ed_izm
 * @property double $kol
 * @property double $summa
 * @property int $proveden
 *
 * @property UtOrg $org
 * @property UtTarifvid $idTarifv
 * @property UtDomnaryad $naryad
 * @property UtNormrab $normrab
 */
class UtDommat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_dommat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_dom', 'id_tarifvid', 'nom_n', 'naim', 'ed_izm', 'kol', 'summa'], 'required'],
            [['id_org', 'id_dom', 'id_tarifvid', 'id_naryad', 'id_normrab', 'proveden'], 'integer'],
            [['period'], 'safe'],
            [['kol', 'summa'], 'number'],
            [['nom_n', 'ed_izm'], 'string', 'max' => 11],
            [['naim'], 'string', 'max' => 50],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
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
            'nom_n' => Yii::t('easyii', 'Nom N'),
            'naim' => Yii::t('easyii', 'Naim'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'kol' => Yii::t('easyii', 'Kol'),
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
