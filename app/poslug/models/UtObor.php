<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_obor".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_abonent
 * @property int $id_posl
 * @property double $dolg
 * @property double $nach
 * @property double $subs
 * @property double $opl
 * @property double $uder
 * @property double $sal
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPosl $posl
 */
class UtObor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_obor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_abonent', 'id_posl'], 'required'],
            [['id_org', 'id_abonent', 'id_posl'], 'integer'],
            [['period'], 'safe'],
            [['dolg', 'nach', 'subs', 'opl', 'uder', 'sal'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_posl'], 'exist', 'skipOnError' => true, 'targetClass' => UtPosl::className(), 'targetAttribute' => ['id_posl' => 'id']],
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
            'dolg' => Yii::t('easyii', 'Dolg'),
            'nach' => Yii::t('easyii', 'Nach'),
            'subs' => Yii::t('easyii', 'Subs'),
            'opl' => Yii::t('easyii', 'Opl'),
            'uder' => Yii::t('easyii', 'Uder'),
            'sal' => Yii::t('easyii', 'Sal'),
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


	public function getTipposl()
	{
		return	UtTipposl::findOne([
				'id' => $this->posl->id_tipposl,
			]);

	}

    public function sort()
    {
        $this->orderBy(['period' => SORT_DESC]);
        return $this;
    }
}
