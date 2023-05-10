<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_utrim".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_kart абонент
 * @property string $period період
 * @property string $tipposl послуга
 * @property int $id_tipposl тип послуги
 * @property int $id_vidutr вид утримань
 * @property int $id_rabota робота
 * @property double $summa сума
 * @property int $procent процент
 * @property string $data_n дата початку
 * @property string $data_k дата кінця
 * @property string $zayav заява
 * @property int $flag_vrem флаг тимчасової
 *
 * @property UtAbonent $abonent
 * @property UtOrg $org
 */
class UtUtrim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_utrim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_kart', 'period'], 'required'],
            [['id_org', 'id_kart', 'id_tipposl', 'id_vidutr', 'id_rabota', 'procent', 'flag_vrem'], 'integer'],
            [['period', 'data_n', 'data_k'], 'safe'],
            [['summa'], 'number'],
            [['tipposl'], 'string', 'max' => 64],
            [['zayav'], 'string', 'max' => 200],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_kart' => 'id']],
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
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'period' => Yii::t('easyii', 'Period'),
            'tipposl' => Yii::t('easyii', 'Tipposl'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidutr' => Yii::t('easyii', 'Id Vidutr'),
            'id_rabota' => Yii::t('easyii', 'Id Rabota'),
            'summa' => Yii::t('easyii', 'Summa'),
            'procent' => Yii::t('easyii', 'Procent'),
            'data_n' => Yii::t('easyii', 'Data N'),
            'data_k' => Yii::t('easyii', 'Data K'),
            'zayav' => Yii::t('easyii', 'Zayav'),
            'flag_vrem' => Yii::t('easyii', 'Flag Vrem'),
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
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }
}
