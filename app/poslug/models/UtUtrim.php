<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_utrim".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property string $period період
 * @property int $id_posl послуга
 * @property int $id_tipposl тип послуги
 * @property int $id_vidutr вид утримань
 * @property int $id_rabota робота
 * @property double $summa сума
 * @property int $procent процент
 * @property string $data_n дата початку
 * @property string $data_k дата кінця
 * @property string $zayav заява
 * @property int $flag_vrem флаг тимчасової
 * @property int $activ активна
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPosl $posl
 * @property UtVidutrim $vidutr
 * @property UtRabota $rabota
 * @property UtTipposl $tipposl
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
            [['id_org', 'id_abonent', 'period', 'id_posl', 'id_vidutr'], 'required'],
            [['id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'id_vidutr', 'id_rabota', 'procent', 'flag_vrem', 'activ'], 'integer'],
            [['period', 'data_n', 'data_k'], 'safe'],
            [['summa'], 'number'],
            [['zayav'], 'string', 'max' => 200],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_posl'], 'exist', 'skipOnError' => true, 'targetClass' => UtPosl::className(), 'targetAttribute' => ['id_posl' => 'id']],
            [['id_vidutr'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidutrim::className(), 'targetAttribute' => ['id_vidutr' => 'id']],
            [['id_rabota'], 'exist', 'skipOnError' => true, 'targetClass' => UtRabota::className(), 'targetAttribute' => ['id_rabota' => 'id']],
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
            'id_org' => Yii::t('easyii', 'Id Org'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'period' => Yii::t('easyii', 'Period'),
            'id_posl' => Yii::t('easyii', 'Id Posl'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidutr' => Yii::t('easyii', 'Id Vidutr'),
            'id_rabota' => Yii::t('easyii', 'Id Rabota'),
            'summa' => Yii::t('easyii', 'Summa'),
            'procent' => Yii::t('easyii', 'Procent'),
            'data_n' => Yii::t('easyii', 'Data N'),
            'data_k' => Yii::t('easyii', 'Data K'),
            'zayav' => Yii::t('easyii', 'Zayav'),
            'flag_vrem' => Yii::t('easyii', 'Flag Vrem'),
            'activ' => Yii::t('easyii', 'Activ'),
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
    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_abonent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosl()
    {
        return $this->hasOne(UtPosl::className(), ['id' => 'id_posl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidutr()
    {
        return $this->hasOne(UtVidutrim::className(), ['id' => 'id_vidutr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRabota()
    {
        return $this->hasOne(UtRabota::className(), ['id' => 'id_rabota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }
}
