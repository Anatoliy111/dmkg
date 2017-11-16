<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_auth".
 *
 * @property int $id
 * @property string $date
 * @property int $id_kart
 * @property string $fio_p
 * @property string $fio_i
 * @property string $fio_b
 * @property string $passw
 * @property string $telef
 * @property string $email
 * @property int $status
 *
 * @property UtKart $kart
 * @property UtAuthfoto[] $utAuthfotos
 */
class UtAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_kart', 'fio_p', 'fio_i', 'passw', 'telef', 'email'], 'required'],
            [['date'], 'safe'],
            [['id_kart', 'status'], 'integer'],
            [['fio_p', 'fio_i', 'fio_b', 'passw', 'telef', 'email'], 'string', 'max' => 50],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtKart::className(), 'targetAttribute' => ['id_kart' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'date' => Yii::t('easyii', 'Date'),
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'fio_p' => Yii::t('easyii', 'Fio P'),
            'fio_i' => Yii::t('easyii', 'Fio I'),
            'fio_b' => Yii::t('easyii', 'Fio B'),
            'passw' => Yii::t('easyii', 'Passw'),
            'telef' => Yii::t('easyii', 'Telef'),
            'email' => Yii::t('easyii', 'Email'),
            'status' => Yii::t('easyii', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKart()
    {
        return $this->hasOne(UtKart::className(), ['id' => 'id_kart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtAuthfotos()
    {
        return $this->hasMany(UtAuthfoto::className(), ['id_auth' => 'id']);
    }
}
