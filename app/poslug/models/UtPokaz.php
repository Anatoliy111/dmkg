<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_pokaz".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property int $id_vidpokaz вид показника
 * @property int $pokaznik показник
 * @property string $nser ном сер лічильника
 * @property string $date_vstan дата встановлення
 * @property string $date_pov дата повірки
 * @property int $flag_lich признак лічильника
 *
 * @property UtLich[] $utLiches
 * @property UtLichskl[] $utLichskls
 * @property UtNarah[] $utNarahs
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtVidpokaz $vidpokaz
 */
class UtPokaz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_pokaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_abonent', 'id_vidpokaz', 'pokaznik'], 'required'],
            [['id_org', 'id_abonent', 'id_vidpokaz', 'pokaznik', 'flag_lich'], 'integer'],
            [['date_vstan', 'date_pov'], 'safe'],
            [['nser'], 'string', 'max' => 100],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_vidpokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokaz' => 'id']],
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
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'pokaznik' => Yii::t('easyii', 'Pokaznik'),
            'nser' => Yii::t('easyii', 'Nser'),
            'date_vstan' => Yii::t('easyii', 'Date Vstan'),
            'date_pov' => Yii::t('easyii', 'Date Pov'),
            'flag_lich' => Yii::t('easyii', 'Flag Lich'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLiches()
    {
        return $this->hasMany(UtLich::className(), ['id_pokaz' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtLichskls()
    {
        return $this->hasMany(UtLichskl::className(), ['id_pokaz' => 'id']);
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
    public function getVidpokaz()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
    }
}
