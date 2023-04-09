<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_setting".
 *
 * @property int $id
 * @property string $downdir
 */
class UtSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['downdir'], 'required'],
            [['downdir'], 'string', 'max' => 124],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'downdir' => Yii::t('easyii', 'Downdir'),
        ];
    }
}
