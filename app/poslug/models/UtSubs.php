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
 * @property string $tipposl
 * @property double $sum сума
 * @property double $sum_ob об. плата
 *
 * @property UtAbonent $abonent
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
            [['period', 'id_org', 'id_abonent'], 'required'],
            [['period'], 'safe'],
            [['id_org', 'id_abonent', 'id_tipposl'], 'integer'],
			[['sum','sum_ob'], 'number'],
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
            'period' => Yii::t('easyii', 'Period'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
			'tipposl' => Yii::t('easyii', 'Tipposl'),
            'sum' => Yii::t('easyii', 'Sum'),
			'sum_ob' => Yii::t('easyii', 'Sum Ob'),
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
}
