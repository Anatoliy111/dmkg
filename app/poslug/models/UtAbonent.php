<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_abonent".
 *
 * @property int $id
 * @property int $id_org организация
 * @property int $schet особовий рахунок
 * @property string $fio ФИО
 * @property int $id_kart адресна картка 
 * @property string $note заметки
 * @property int $id_oldkart силка на стару базу
 *
 * @property UtKart $kart
 * @property UtOrg $org
 * @property UtOldkart $oldkart
 * @property UtLgot[] $utLgots
 * @property UtLich[] $utLiches
 * @property UtLichskl[] $utLichskls
 * @property UtNarah[] $utNarahs
 * @property UtPokaz[] $utPokazs
 * @property UtPosl[] $utPosls
 * @property UtSubs[] $utSubs
 * @property UtUtrim[] $utUtrims
 */
class UtAbonent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_abonent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'schet', 'id_kart'], 'required'],
            [['id_org', 'schet', 'id_kart','id_oldkart'], 'integer'],
            [['note'], 'string'],
            [['fio'], 'string', 'max' => 124],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtKart::className(), 'targetAttribute' => ['id_kart' => 'id']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_oldkart'], 'exist', 'skipOnError' => true, 'targetClass' => UtOldkart::className(), 'targetAttribute' => ['id_oldkart' => 'id']],
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
            'schet' => Yii::t('easyii', 'Schet'),
            'fio' => Yii::t('easyii', 'Fio'),
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'note' => Yii::t('easyii', 'Note'),
            'id_oldkart' => Yii::t('easyii', 'Id Oldkart'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldkart()
    {
        return $this->hasOne(UtOldkart::className(), ['id' => 'id_oldkart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLgots()
    {
        return $this->hasMany(UtLgot::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLiches()
    {
        return $this->hasMany(UtLich::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLichskls()
    {
        return $this->hasMany(UtLichskl::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtNarahs()
    {
        return $this->hasMany(UtNarah::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPokazs()
    {
        return $this->hasMany(UtPokaz::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtPosls()
    {
        return $this->hasMany(UtPosl::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtSubs()
    {
        return $this->hasMany(UtSubs::className(), ['id_abonent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtUtrims()
    {
        return $this->hasMany(UtUtrim::className(), ['id_abonent' => 'id']);
    }
}
