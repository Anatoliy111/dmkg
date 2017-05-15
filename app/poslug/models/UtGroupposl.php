<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_groupposl".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $groups група послуг
 * @property int $flag_subs флаг субсидії
 *
 * @property UtOrg $org
 * @property UtTipposl[] $utTipposls
 */
class UtGroupposl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_groupposl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'groups'], 'required'],
            [['id_org', 'flag_subs'], 'integer'],
            [['groups'], 'string', 'max' => 32],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
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
            'groups' => Yii::t('easyii', 'Groups'),
            'flag_subs' => Yii::t('easyii', 'Flag Subs'),
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
    public function getUtTipposls()
    {
        return $this->hasMany(UtTipposl::className(), ['id_groupposl' => 'id']);
    }
}
