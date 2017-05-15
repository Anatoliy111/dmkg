<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_edizm".
 *
 * @property int $id
 * @property string $edizm
 */
class UtEdizm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_edizm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edizm'], 'required'],
            [['edizm'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'edizm' => Yii::t('easyii', 'Edizm'),
        ];
    }
}
