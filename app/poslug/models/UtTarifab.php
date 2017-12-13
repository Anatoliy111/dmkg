<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifab".
 *
 * @property int $id
 * @property int $id_org
 * @property int $id_tipposl
 * @property int $id_abonent
 * @property int $kl
 * @property string $nametarif
 * @property double $tarif
 * @property double $kortarif
 * @property double $endtarif
 * @property int $days
 * @property int $val
 * @property int $del
 *
 * @property UtAbonent $abonent
 * @property UtTipposl $tipposl
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
            [['id_org', 'id_tipposl', 'id_abonent'], 'required'],
            [['id_org', 'id_tipposl', 'id_abonent', 'kl', 'days', 'val', 'del'], 'integer'],
            [['tarif', 'kortarif', 'endtarif'], 'number'],
            [['nametarif'], 'string', 'max' => 50],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
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
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'kl' => Yii::t('easyii', 'Kl'),
            'nametarif' => Yii::t('easyii', 'Nametarif'),
            'tarif' => Yii::t('easyii', 'Tarif'),
            'kortarif' => Yii::t('easyii', 'Kortarif'),
            'endtarif' => Yii::t('easyii', 'Endtarif'),
            'days' => Yii::t('easyii', 'Days'),
            'val' => Yii::t('easyii', 'Val'),
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
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }
}
