<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viber_kppokazn".
 *
 * @property int $id
 * @property int $id_viber
 * @property string $schet
 * @property string $date
 * @property int $pokazn
 * @property int $upload
 *
 * @property Viber $viber
 */
class ViberKppokazn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viber_kppokazn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_viber', 'schet', 'date', 'pokazn'], 'required'],
            [['id_viber', 'pokazn', 'upload'], 'integer'],
            [['date'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['id_viber'], 'exist', 'skipOnError' => true, 'targetClass' => Viber::className(), 'targetAttribute' => ['id_viber' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_viber' => 'Id Viber',
            'schet' => 'Schet',
            'date' => 'Date',
            'pokazn' => 'Pokazn',
            'upload' => 'Upload',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViber()
    {
        return $this->hasOne(Viber::className(), ['id' => 'id_viber']);
    }
}
