<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_plgot".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_tipposl тип послуги
 * @property int $id_vidlgot вид льготи
 *
 * @property UtOrg $org
 * @property UtTipposl $tipposl
 * @property UtVidlgot $vidlgot
 */
class UtPlgot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_plgot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_tipposl', 'id_vidlgot'], 'required'],
            [['id', 'id_org', 'id_tipposl', 'id_vidlgot'], 'integer'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
            [['id_vidlgot'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidlgot::className(), 'targetAttribute' => ['id_vidlgot' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidlgot' => Yii::t('easyii', 'Id Vidlgot'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidlgot()
    {
        return $this->hasOne(UtVidlgot::className(), ['id' => 'id_vidlgot']);
    }
}
