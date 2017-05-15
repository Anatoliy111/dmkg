<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_narah".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property string $period період
 * @property int $id_posl послуга
 * @property int $id_tipposl тип послуги
 * @property int $id_vidlgot
 * @property int $id_tarif тариф
 * @property double $tarif тариф
 * @property int $id_vidpokaz вид показника
 * @property double $pokaznik показник
 * @property string $ed_izm од вим
 * @property double $nnorma норма
 * @property double $sum сума
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPosl $posl
 * @property UtTipposl $tipposl
 * @property UtPokaz $vidpokaz
 * @property UtVidlgot $vidlgot
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
            [['id_org', 'id_abonent', 'id_posl', 'tarif', 'pokaznik', 'ed_izm', 'sum'], 'required'],
            [['id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'id_tarif', 'id_vidpokaz',  'id_vidlgot'], 'integer'],
            [['tarif', 'pokaznik', 'nnorma', 'sum'], 'number'],
			[['period'], 'safe'],
            [['ed_izm'], 'string', 'max' => 11],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_posl'], 'exist', 'skipOnError' => true, 'targetClass' => UtPosl::className(), 'targetAttribute' => ['id_posl' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
            [['id_vidpokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokaz' => 'id']],
            [['id_vidlgot'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidlgot::className(), 'targetAttribute' => ['id_vidlgot' => 'id']],
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
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'id_posl' => Yii::t('easyii', 'Id Posl'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidlgot' => Yii::t('easyii', 'Id Vidlgot'),
            'id_tarif' => Yii::t('easyii', 'Id Tarif'),
            'tarif' => Yii::t('easyii', 'Tarif'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
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
    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_abonent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosl()
    {
        return $this->hasOne(UtPosl::className(), ['id' => 'id_posl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getVidpokaz()
	{
		return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidlgot()
    {
        return $this->hasOne(UtVidlgot::className(), ['id' => 'id_vidlgot']);
    }
}
