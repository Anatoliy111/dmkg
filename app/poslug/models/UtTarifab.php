<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifab".
 *
 * @property int $id
 * @property int $id_org
 * @property int $id_abonent
 * @property int $id_tarif
 * @property double $kortarif
 * @property double $sumtarif
 * @property double $endtarif
 * @property string $period
 * @property string $days
 * @property double $tarif
 * @property int $daymes
 * @property double $norma
 * @property int $del
 *
 * @property UtTarif $tarif0
 * @property UtAbonent $abonent
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
            [['id_org', 'id_abonent', 'id_tarif', 'kortarif', 'sumtarif', 'endtarif', 'period'], 'required'],
            [['id_org', 'id_abonent', 'id_tarif', 'daymes', 'del'], 'integer'],
            [['kortarif', 'sumtarif', 'endtarif', 'tarif', 'norma'], 'number'],
            [['period', 'days'], 'safe'],
            [['id_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarif::className(), 'targetAttribute' => ['id_tarif' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
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
            'id_tarif' => Yii::t('easyii', 'Id Tarif'),
            'kortarif' => Yii::t('easyii', 'Kortarif'),
            'sumtarif' => Yii::t('easyii', 'Sumtarif'),
            'endtarif' => Yii::t('easyii', 'Endtarif'),
            'period' => Yii::t('easyii', 'Period'),
            'days' => Yii::t('easyii', 'Days'),
            'tarif' => Yii::t('easyii', 'Tarif'),
            'daymes' => Yii::t('easyii', 'Daymes'),
            'norma' => Yii::t('easyii', 'Norma'),
            'del' => Yii::t('easyii', 'Del'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarif0()
    {
        return $this->hasOne(UtTarif::className(), ['id' => 'id_tarif']);
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
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }
}
