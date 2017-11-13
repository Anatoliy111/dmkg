<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifab".
 *
 * @property int $id
 * @property int $id_org
 * @property int $id_tarif
 * @property int $id_abonent
 * @property int $del
 *
 * @property UtAbonent $abonent
 * @property UtOrg $org
 * @property UtTarif $tarif
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
            [['id_org', 'id_tarif', 'id_abonent'], 'required'],
            [['id_org', 'id_tarif', 'id_abonent', 'del'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'id_org' => Yii::t('app', 'Id Org'),
            'id_tarif' => Yii::t('app', 'Id Tarif'),
            'id_abonent' => Yii::t('app', 'Id Abonent'),
            'del' => Yii::t('app', 'Del'),
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
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarif()
    {
        return $this->hasOne(UtTarif::className(), ['id' => 'id_tarif']);
    }
}
