<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifvid".
 *
 * @property int $id
 * @property int $id_tipposl
 * @property int $code_servi
 * @property string $name
 *
 * @property UtTipposl $tipposl
 */
class UtTarifvid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tarifvid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipposl', 'name'], 'required'],
            [['id_tipposl','code_servi'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'name' => Yii::t('easyii', 'Names'),
            'code_servi' => Yii::t('easyii', 'Code Servi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }
}
