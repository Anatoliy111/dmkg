<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_authfoto".
 *
 * @property int $id
 * @property string $dirfoto
 * @property int $id_auth
 *
 * @property UtAuth $auth
 */
class UtAuthfoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_authfoto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_auth'], 'integer'],
            [['dirfoto'], 'string', 'max' => 50],
            [['id_auth'], 'exist', 'skipOnError' => true, 'targetClass' => UtAuth::className(), 'targetAttribute' => ['id_auth' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'dirfoto' => Yii::t('easyii', 'Dirfoto'),
            'id_auth' => Yii::t('easyii', 'Id Auth'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(UtAuth::className(), ['id' => 'id_auth']);
    }
}
