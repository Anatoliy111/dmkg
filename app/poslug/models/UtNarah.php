<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_narah".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $period
 * @property int $id_abonent абонент
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
            [['id_org', 'period', 'id_abonent'], 'required'],
            [['id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'id_vidlgot', 'id_vidpokaz'], 'integer'],
            [['period'], 'safe'],
            [['tarif', 'pokaznik', 'nnorma', 'sum'], 'number'],
            [['tipposl', 'vidpokaz'], 'string', 'max' => 64],
            [['lgot'], 'string', 'max' => 5],
            [['ed_izm'], 'string', 'max' => 11],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_org' => Yii::t('app', 'Id Org'),
            'period' => Yii::t('app', 'Period'),
            'id_abonent' => Yii::t('app', 'Id Abonent'),
            'id_posl' => Yii::t('app', 'Id Posl'),
            'id_tipposl' => Yii::t('app', 'Id Tipposl'),
            'tipposl' => Yii::t('app', 'Tipposl'),
            'id_vidlgot' => Yii::t('app', 'Id Vidlgot'),
            'lgot' => Yii::t('app', 'Lgot'),
            'tarif' => Yii::t('app', 'Tarif'),
            'id_vidpokaz' => Yii::t('app', 'Id Vidpokaz'),
            'vidpokaz' => Yii::t('app', 'Vidpokaz'),
            'pokaznik' => Yii::t('app', 'Pokaznik'),
            'ed_izm' => Yii::t('app', 'Ed Izm'),
            'nnorma' => Yii::t('app', 'Nnorma'),
            'sum' => Yii::t('app', 'Sum'),
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
    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_abonent']);
    }
}
