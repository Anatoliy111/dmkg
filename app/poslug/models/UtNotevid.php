<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_notevid".
 *
 * @property int $id
 * @property int $id_tarifvid
 * @property string $note
 *
 * @property UtTarifvid $idTarifv
 */
class UtNotevid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_notevid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tarifvid', 'note'], 'required'],
            [['id_tarifvid'], 'integer'],
            [['note'], 'string', 'max' => 200],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'note' => Yii::t('easyii', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }
}
