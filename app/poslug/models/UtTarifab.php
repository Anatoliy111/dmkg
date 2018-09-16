<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifab".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_abonent
 * @property int $id_tarif
 * @property double $kortarif коригуючий тариф
 * @property double $sumtarif тариф
 * @property double $endtarif сумарный тариф
 * @property int $del
 *
 * @property UtAbonent $abonent
 * @property UtTarif $tarif
 * @property UtOrg $org
 */
class UtTarifab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tarifab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org','id_abonent','id_tarif'], 'required'],
            [['id_org', 'id_abonent','del','id_tarif'], 'integer'],
			[['period'], 'safe'],
            [['kortarif','sumtarif','endtarif'], 'number'],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
			[['id_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarif::className(), 'targetAttribute' => ['id_tarif' => 'id']],
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
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
			'period' => Yii::t('easyii', 'Period'),
            'id_tarif' => Yii::t('easyii', 'Id Tarif'),
            'del' => Yii::t('easyii', 'Del'),
        ];
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

	public function getTarif()
	{
		return $this->hasOne(UtTarif::className(), ['id' => 'id_tarif']);
	}
}
