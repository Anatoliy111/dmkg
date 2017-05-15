<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_olddom".
 *
 * @property int $id
 * @property int $id_ul
 * @property string $dom
 * @property string $ndom
 * @property string $real_dom реальний ном дому
 * @property string $ul вул
 * @property int $pod кол квартир
 * @property string $rajon
 *
 * @property UtDom[] $utDoms
 * @property UtUlica[] $utUlicas
 */
class UtOlddom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
	 *
     */

	public $ulicaname;

	public static function tableName()
    {
        return 'ut_olddom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ul', 'pod'], 'integer'],
            [['dom', 'ndom', 'real_dom'], 'string', 'max' => 4],
            [['ul', 'rajon'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_ul' => Yii::t('easyii', 'Id Ul'),
            'dom' => Yii::t('easyii', 'Dom'),
            'ndom' => Yii::t('easyii', 'Ndom'),
            'real_dom' => Yii::t('easyii', 'Real Dom'),
            'ul' => Yii::t('easyii', 'Ul'),
            'pod' => Yii::t('easyii', 'Pod'),
            'rajon' => Yii::t('easyii', 'Rajon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDoms()
    {
        return $this->hasMany(UtDom::className(), ['id_olddom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getUtUlicas()
//    {
//        return $this->hasMany(UtUlica::className(), ['id' => 'id_ul']);
//    }

	public function getUlica()
	{
		return $this->hasOne(UtUlica::className(), ['id' => 'id_ul']);
	}

	public function getUlicaname()
	{
		return $this->id_ul === null ? null : $this->ulica->ul;
	}
}
