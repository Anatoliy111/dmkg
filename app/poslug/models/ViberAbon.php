<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "viber_abon".
 *
 * @property int $id
 * @property int $id_viber
 * @property string $org
 * @property int $id_utkart
 * @property string $note
 *
 * @property UtKart $utkart
 * @property Viber $viber
 */
class ViberAbon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viber_abon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_viber', 'org', 'id_utkart', 'note'], 'required'],
            [['id_viber', 'id_utkart'], 'integer'],
            [['org'], 'string', 'max' => 6],
            [['note'], 'string', 'max' => 64],
            [['id_utkart'], 'exist', 'skipOnError' => true, 'targetClass' => UtKart::className(), 'targetAttribute' => ['id_utkart' => 'id']],
            [['id_viber'], 'exist', 'skipOnError' => true, 'targetClass' => Viber::className(), 'targetAttribute' => ['id_viber' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_viber' => Yii::t('easyii', 'Id Viber'),
            'org' => Yii::t('easyii', 'Org'),
            'id_utkart' => Yii::t('easyii', 'Id Utkart'),
            'note' => Yii::t('easyii', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtkart()
    {
        return $this->hasOne(UtKart::className(), ['id' => 'id_utkart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViber()
    {
        return $this->hasOne(Viber::className(), ['id' => 'id_viber']);
    }
}
