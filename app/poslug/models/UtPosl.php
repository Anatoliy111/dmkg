<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_posl".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property string $period період
 * @property int $id_tipposl тип послуг
 * @property int $flag_vrem признак тимчасової
 * @property string $date_n дата початку
 * @property string $date_k дата кінця
 * @property string $n_dog ном договору
 * @property string $date_dog дата договору
 * @property double $nnorma норма
 * @property int $flag_dom признак послуги багатокв. будинку
 * @property int $id_dom силка на будинок
 * @property int $activ активна
 *
 * @property UtNarah[] $utNarahs
 * @property UtOrg $org
 * @property UtTipposl $tipposl
 * @property UtAbonent $abonent
 * @property UtDom $dom
 * @property UtUtrim[] $utUtrims
 */
class UtPosl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_posl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_abonent', 'period', 'id_tipposl'], 'required'],
            [['id_org', 'id_abonent', 'id_tipposl', 'flag_vrem', 'flag_dom', 'id_dom', 'activ'], 'integer'],
            [['period', 'date_n', 'date_k', 'date_dog'], 'safe'],
            [['nnorma'], 'number'],
            [['n_dog'], 'string', 'max' => 24],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
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
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'flag_vrem' => Yii::t('easyii', 'Flag Vrem'),
            'date_n' => Yii::t('easyii', 'Date N'),
            'date_k' => Yii::t('easyii', 'Date K'),
            'n_dog' => Yii::t('easyii', 'N Dog'),
            'date_dog' => Yii::t('easyii', 'Date Dog'),
            'nnorma' => Yii::t('easyii', 'Nnorma'),
            'flag_dom' => Yii::t('easyii', 'Flag Dom'),
            'id_dom' => Yii::t('easyii', 'Id Dom'),
            'activ' => Yii::t('easyii', 'Activ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtNarahs()
    {
        return $this->hasMany(UtNarah::className(), ['id_posl' => 'id']);
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
    public function getAbonent()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_abonent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDom()
    {
        return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_posl' => 'id']);
    }
}
