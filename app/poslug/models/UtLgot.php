<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_lgot".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $period період
 * @property int $id_abonent абонент
 * @property int $id_vidlgot вид льготи
 * @property string $fio ПІБ льготника
 * @property string $posv_ser посвідчення
 * @property string $date_n дата початку льготи
 * @property string $date_k дата закінчення льготи
 * @property int $kat категорія
 * @property int $flag_vrem признан тимчасової льготи
 * @property int $activ активно
 *
 * @property UtAbonent $abonent
 * @property UtOrg $org
 * @property UtVidlgot $vidlgot
 */
class UtLgot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_lgot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_abonent', 'id_vidlgot'], 'required'],
            [['id_org', 'id_abonent', 'id_vidlgot', 'kat', 'flag_vrem', 'activ'], 'integer'],
            [['period', 'date_n', 'date_k'], 'safe'],
            [['fio', 'posv_ser'], 'string', 'max' => 64],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
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
            'period' => Yii::t('easyii', 'Period'),
            'id_abonent' => Yii::t('easyii', 'Id Abonent'),
            'id_vidlgot' => Yii::t('easyii', 'Id Vidlgot'),
            'fio' => Yii::t('easyii', 'Fio'),
            'posv_ser' => Yii::t('easyii', 'Posv Ser'),
            'date_n' => Yii::t('easyii', 'Date N'),
            'date_k' => Yii::t('easyii', 'Date K'),
            'kat' => Yii::t('easyii', 'Kat'),
            'flag_vrem' => Yii::t('easyii', 'Flag Vrem'),
            'activ' => Yii::t('easyii', 'Activ'),
        ];
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
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidlgot()
    {
        return $this->hasOne(UtVidlgot::className(), ['id' => 'id_vidlgot']);
    }
}
