<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_postach".
 *
 * @property int $id
 * @property string $postach
 * @property int $edrpou
 * @property string $note
 *
 * @property UtDomakt[] $utDomakts
 */
class UtPostach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_postach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postach'], 'required'],
            [['edrpou'], 'integer'],
            [['postach'], 'string', 'max' => 120],
            [['note'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'postach' => Yii::t('easyii', 'Postach'),
            'edrpou' => Yii::t('easyii', 'Edrpou'),
            'note' => Yii::t('easyii', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtDomakts()
    {
        return $this->hasMany(UtDomakt::className(), ['id_postach' => 'id']);
    }
}
