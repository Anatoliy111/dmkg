<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_vidlgot".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $lgota назва льгота скорочена
 * @property string $lgota_s назва льгота повна
 * @property double $razmer розмір
 * @property int $kod_subs код субсидії
 *
 * @property UtLgot[] $utLgots
 * @property UtPlgot[] $utPlgots
 * @property UtOrg $org
 */
class UtVidlgot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_vidlgot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'lgota', 'lgota_s', 'razmer', 'kod_subs'], 'required'],
            [['id_org', 'kod_subs'], 'integer'],
            [['razmer'], 'number'],
            [['lgota'], 'string', 'max' => 3],
            [['lgota_s'], 'string', 'max' => 64],
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
            'lgota' => Yii::t('easyii', 'Lgota'),
            'lgota_s' => Yii::t('easyii', 'Lgota S'),
            'razmer' => Yii::t('easyii', 'Razmer'),
            'kod_subs' => Yii::t('easyii', 'Kod Subs'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLgots()
    {
        return $this->hasMany(UtLgot::className(), ['id_vidlgot' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPlgots()
    {
        return $this->hasMany(UtPlgot::className(), ['id_vidlgot' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }
}
