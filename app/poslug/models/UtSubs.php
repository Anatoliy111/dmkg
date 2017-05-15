<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_subs".
 *
 * @property int $id
 * @property string $period період
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property int $id_tipposl тип послуги
 * @property int $sum сума
 *
 * @property UtAbonent $abonent
 * @property UtTipposl $tipposl
 * @property UtOrg $org
 */
class UtSubs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_subs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period', 'id_org', 'id_abonent', 'id_tipposl', 'sum'], 'required'],
            [['period'], 'safe'],
            [['id_org', 'id_abonent', 'id_tipposl', 'sum'], 'integer'],
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
            'period' => Yii::t('easyii', 'Period'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'sum' => Yii::t('easyii', 'Sum'),
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
