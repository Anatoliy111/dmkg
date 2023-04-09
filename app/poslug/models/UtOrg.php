<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_org".
 *
 * @property int $id
 * @property string $naim найменування
 * @property string $naim_full повне найменування
 * @property int $edrpou ЄДРПОУ
 * @property string $adress адреса
 * @property string $tel телефон
 *
 * @property UtAbonent[] $utAbonents
 * @property UtGroupposl[] $utGroupposls
 * @property UtLgot[] $utLgots
 * @property UtLich[] $utLiches
 * @property UtLichskl[] $utLichskls
 * @property UtNarah[] $utNarahs
 * @property UtPlgot[] $utPlgots
 * @property UtPokaz[] $utPokazs
 * @property UtPosl[] $utPosls
 * @property UtSubs[] $utSubs
 * @property UtTarif[] $utTarifs
 * @property UtTipposl[] $utTipposls
 * @property UtUtrim[] $utUtrims
 * @property UtVidlgot[] $utVidlgots
 */
class UtOrg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['naim'], 'required'],
            [['edrpou'], 'integer'],
            [['naim', 'adress'], 'string', 'max' => 64],
            [['naim_full'], 'string', 'max' => 254],
            [['tel'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'naim' => Yii::t('easyii', 'Naim'),
            'naim_full' => Yii::t('easyii', 'Naim Full'),
            'edrpou' => Yii::t('easyii', 'Edrpou'),
            'adress' => Yii::t('easyii', 'Adress'),
            'tel' => Yii::t('easyii', 'Tel'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtAbonents()
    {
        return $this->hasMany(UtAbonent::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtGroupposls()
    {
        return $this->hasMany(UtGroupposl::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLgots()
    {
        return $this->hasMany(UtLgot::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLiches()
    {
        return $this->hasMany(UtLich::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLichskls()
    {
        return $this->hasMany(UtLichskl::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtNarahs()
    {
        return $this->hasMany(UtNarah::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPlgots()
    {
        return $this->hasMany(UtPlgot::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPokazs()
    {
        return $this->hasMany(UtPokaz::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPosls()
    {
        return $this->hasMany(UtPosl::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtSubs()
    {
        return $this->hasMany(UtSubs::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTarifs()
    {
        return $this->hasMany(UtTarif::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtTipposls()
    {
        return $this->hasMany(UtTipposl::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_org' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtVidlgots()
    {
        return $this->hasMany(UtVidlgot::className(), ['id_org' => 'id']);
    }
}
