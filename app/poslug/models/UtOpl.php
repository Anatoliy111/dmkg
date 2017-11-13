<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_opl".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_abonent
 * @property int $id_posl
 * @property int $id_tipposl
 * @property string $tipposl
 * @property string $dt
 * @property int $pach
 * @property double $sum
 * @property string $note
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent

 */
class UtOpl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_opl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_abonent'], 'required'],
            [['id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'pach'], 'integer'],
            [['period', 'dt'], 'safe'],
			[['tipposl'], 'string', 'max' => 64],
            [['sum'], 'number'],
            [['note'], 'string'],
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
            'id' => Yii::t('easyii', 'ID'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'period' => Yii::t('easyii', 'Period'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'id_posl' => Yii::t('easyii', 'Id Posl'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
			'tipposl' => Yii::t('app', 'Tipposl'),
            'dt' => Yii::t('easyii', 'Dt'),
            'pach' => Yii::t('easyii', 'Pach'),
            'sum' => Yii::t('easyii', 'Sum'),
            'note' => Yii::t('easyii', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery


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

}
