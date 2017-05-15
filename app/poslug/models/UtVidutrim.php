<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_vidutrim".
 *
 * @property int $id
 * @property string $vidutrim вид утримань
 * @property int $flag_vrem флаг тимчасової
 *
 * @property UtUtrim[] $utUtrims
 */
class UtVidutrim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_vidutrim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vidutrim'], 'required'],
            [['flag_vrem'], 'integer'],
            [['vidutrim'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'vidutrim' => Yii::t('easyii', 'Vidutrim'),
            'flag_vrem' => Yii::t('easyii', 'Flag Vrem'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_vidutr' => 'id']);
    }
}
