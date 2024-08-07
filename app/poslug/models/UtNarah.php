<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_narah".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $period
 * @property int $id_kart абонент
 * @property int $id_posl послуга
 * @property int $id_tipposl тип послуги
 * @property string $tipposl
 * @property int $id_vidlgot
 * @property string $lgot
 * @property double $tarif тариф
 * @property int $id_vidpokaz вид показника
 * @property string $vidpokaz
 * @property double $pokaznik показник
 * @property string $ed_izm од вим
 * @property double $nnorma норма
 * @property double $sum сума
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 */
class UtNarah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_narah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_kart'], 'required'],
            [['id_org', 'id_kart', 'id_posl', 'id_tipposl', 'id_vidlgot', 'id_vidpokaz'], 'integer'],
            [['period'], 'safe'],
            [['tarif', 'pokaznik', 'nnorma', 'sum'], 'number'],
            [['tipposl', 'vidpokaz'], 'string', 'max' => 64],
            [['lgot'], 'string', 'max' => 5],
            [['ed_izm'], 'string', 'max' => 11],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_kart' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
            [['id_vidpokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokaz' => 'id']],
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
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'id_posl' => Yii::t('easyii', 'Id Posl'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'tipposl' => Yii::t('easyii', 'Tipposl'),
            'id_vidlgot' => Yii::t('easyii', 'Id Vidlgot'),
            'lgot' => Yii::t('easyii', 'Lgot'),
            'tarif' => Yii::t('easyii', 'Tarif'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'vidpokaz' => Yii::t('easyii', 'Vidpokaz'),
            'pokaznik' => Yii::t('easyii', 'Pokaznik'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'nnorma' => Yii::t('easyii', 'Nnorma'),
            'sum' => Yii::t('easyii', 'Sum'),
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
    public function getKart()
    {
        return $this->hasOne(UtKart::className(), ['id' => 'id_kart']);
    }

//    public function getTipposl1()
//    {
//        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
//    }

    public function getPoslvid()
    {
        $posl = $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
        $res = $posl->one();
        return $res->getVidpokaz();
    }

    public function getVidpokaz()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
    }
}
