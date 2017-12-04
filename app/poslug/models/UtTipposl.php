<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tipposl".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $poslug послуга
 * @property int $id_groupposl група послуг
 * @property string $old_tipusl
 * @property string $ed_izm од вим
 * @property int $id_vidpokaz вид показника
 * @property int $flag_nar флаг нарахувань
 * @property int $flag_norm флаг норми
 * @property int $flag_lgot флаг льготи
 * @property int $flag_dom флаг багат будинк
 * @property int $id_vidpokazprop вид показника абонента при пропорційному нарахуванню
 * @property int $val
 * @property int $del видалена
 *
 * @property UtNarah[] $utNarahs
 * @property UtPlgot[] $utPlgots
 * @property UtPosl[] $utPosls
 * @property UtSubs[] $utSubs
 * @property UtTarif[] $utTarifs
 * @property UtOrg $org
 * @property UtVidpokaz $vidpokaz
 * @property UtVidpokaz $vidpokazprop
 * @property UtGroupposl $groupposl
 * @property UtUtrim[] $utUtrims
 */
class UtTipposl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tipposl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'poslug', 'old_tipusl'], 'required'],
//            [['ed_izm'], function ($this)
//                                                        {
//                                                            if ($this->id_vidpokaz <> null)
//                                                            {
//                                                                return UtVidpokaz::findOne(['id' => $this->id_vidpokaz])->ed_izm;
//
//                                                            }
//
//                                                        }],
            [['id_org', 'id_groupposl', 'id_vidpokaz', 'flag_nar', 'flag_norm', 'flag_lgot', 'flag_dom', 'id_vidpokazprop', 'del','val'], 'integer'],
            [['poslug'], 'string', 'max' => 64],
            [['old_tipusl'], 'string', 'max' => 3],
            [['ed_izm'], 'string', 'max' => 10],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_vidpokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokaz' => 'id']],
            [['id_vidpokazprop'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokazprop' => 'id']],
            [['id_groupposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtGroupposl::className(), 'targetAttribute' => ['id_groupposl' => 'id']],
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
            'poslug' => Yii::t('easyii', 'Poslug'),
            'id_groupposl' => Yii::t('easyii', 'Id Groupposl'),
            'old_tipusl' => Yii::t('easyii', 'Old Tipusl'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'flag_nar' => Yii::t('easyii', 'Flag Nar'),
            'flag_norm' => Yii::t('easyii', 'Flag Norm'),
            'flag_lgot' => Yii::t('easyii', 'Flag Lgot'),
            'flag_dom' => Yii::t('easyii', 'Flag Dom'),
            'id_vidpokazprop' => Yii::t('easyii', 'Id Vidpokazprop'),
            'del' => Yii::t('easyii', 'Del'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtNarahs()
    {
        return $this->hasMany(UtNarah::className(), ['id_tipposl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPlgots()
    {
        return $this->hasMany(UtPlgot::className(), ['id_tipposl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPosls()
    {
        return $this->hasMany(UtPosl::className(), ['id_tipposl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtSubs()
    {
        return $this->hasMany(UtSubs::className(), ['id_tipposl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTarifs()
    {
        return $this->hasMany(UtTarif::className(), ['id_tipposl' => 'id']);
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
    public function getVidpokaz()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidpokazprop()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokazprop']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupposl()
    {
        return $this->hasOne(UtGroupposl::className(), ['id' => 'id_groupposl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_tipposl' => 'id']);
    }

    public function getEdizm()
    {
        return $this->hasOne(UtEdizm::className(), ['id' => 'ed_izm']);
    }
}
