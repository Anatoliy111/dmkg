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
 *
 * @property UtAbonent[] $utAbonents
 * @property UtOldorg $oldorg
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
            [['name'], 'required'],
            [['id_oldorg'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['fio_ruk', 'adress'], 'string', 'max' => 64],
            [['tel'], 'string', 'max' => 20],
            [['id_oldorg'], 'exist', 'skipOnError' => true, 'targetClass' => UtOldorg::className(), 'targetAttribute' => ['id_oldorg' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
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
    public function getUtAbonents()
    {
        return $this->hasMany(UtAbonent::className(), ['id_rabota' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldorg()
    {
        return $this->hasOne(UtOldorg::className(), ['id' => 'id_oldorg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_rabota' => 'id']);
    }
}
