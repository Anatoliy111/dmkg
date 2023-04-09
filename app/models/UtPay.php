<?php

namespace app\models;

use app\poslug\models\UtAbonent;
use Yii;

/**
 * This is the model class for table "ut_pay".
 *
 * @property int $id
 * @property int $id_kart
 * @property int $id_abonent
 * @property string $datepay
 * @property string $datestat
 * @property double $summ
 * @property string $textpay
 * @property string $status
 * @property int $tippay 1=priv 2=other
 */
class UtPay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_pay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kart', 'id_abonent', 'datepay'], 'required'],
            [['id_kart', 'id_abonent', 'tippay'], 'integer'],
            [['datepay', 'datestat'], 'safe'],
            [['summ'], 'number'],
            [['textpay', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'datepay' => Yii::t('easyii', 'Datepay'),
            'datestat' => Yii::t('easyii', 'Datestat'),
            'summ' => Yii::t('easyii', 'Summ'),
            'textpay' => Yii::t('easyii', 'Textpay'),
            'status' => Yii::t('easyii', 'Status'),
            'tippay' => Yii::t('easyii', 'Tippay'),
        ];
    }

    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_abonent']);
    }

    public function getKart()
    {
        return $this->hasOne(UtKart::className(), ['id' => 'id_kart']);
    }

}
