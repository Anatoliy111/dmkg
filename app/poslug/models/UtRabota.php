<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_rabota".
 *
 * @property int $id
 * @property string $name найменування
 * @property string $fio_ruk керівник
 * @property string $adress адреса
 * @property string $tel телефон
 * @property int $id_oldorg
 * @property int $id_org
 *
 * @property UtAbonent[] $utAbonents
 * @property UtUtrim[] $utUtrims
 */
class UtRabota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_rabota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_oldorg'], 'integer'],
			[['id_org'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['fio_ruk', 'adress'], 'string', 'max' => 64],
            [['tel'], 'string', 'max' => 20],
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
            'name' => Yii::t('easyii', 'Name'),
            'fio_ruk' => Yii::t('easyii', 'Fio Ruk'),
            'adress' => Yii::t('easyii', 'Adress'),
            'tel' => Yii::t('easyii', 'Tel'),
            'id_oldorg' => Yii::t('easyii', 'Id Oldorg'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getUtKart()
	{
		return $this->hasMany(UtKart::className(), ['id_rabota' => 'id']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_rabota' => 'id']);
    }
}
