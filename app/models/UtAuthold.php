<?php

namespace app\models;

use app\poslug\models\UtAbonent;
use app\poslug\models\UtAuthfoto;
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
class UtAuthold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


	public static function tableName()
    {
        return 'ut_auth';
    }

	public $pass1;
	public $pass2;
	public $schet;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_kart', 'fio_p', 'fio_i', 'pass1', 'pass2', 'telef', 'email', 'schet'], 'required'],
//			['date', 'default', 'value' => date('Y-m-d')],
			[['fio_p', 'fio_i', 'fio_b', 'email'], 'trim'],
            [['date'], 'safe'],
            [['id_kart', 'status'], 'integer'],
            [['fio_p', 'fio_i', 'fio_b', 'passw', 'telef', 'email', 'pass1', 'pass2','schet'], 'string', 'max' => 50],
			[['pass1'], 'string', 'min' => 5],
			[['pass2'], 'string', 'min' => 5],
			[['schet'], 'string', 'min' => 7],
			['email', 'email'],
			['schet', 'in', 'range' => UtAbonent::find()->select('schet')->joinWith('kart')->where(['ut_kart.status' => 0])->asArray()->column()],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtKart::className(), 'targetAttribute' => ['id_kart' => 'id']],
			['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають !!!'],
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
			'schet' => Yii::t('easyii', 'Schet'),
			'pass1' => Yii::t('easyii', 'Pass1'),
			'pass2' => Yii::t('easyii', 'Pass2'),
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
}
