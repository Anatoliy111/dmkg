<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_sotr".
 *
 * @property int $id
 * @property string $dolgnost
 * @property string $fio
 *
 * @property UtDomnaryad[] $utDomnaryads
 */
class UtSotr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_sotr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dolgnost', 'fio'], 'required'],
            [['dolgnost'], 'string', 'max' => 30],
            [['fio'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'dolgnost' => Yii::t('easyii', 'Dolgnost'),
            'fio' => Yii::t('easyii', 'Fio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomnaryads()
    {
        return $this->hasMany(UtDomnaryad::className(), ['id_sotr' => 'id']);
    }
}
