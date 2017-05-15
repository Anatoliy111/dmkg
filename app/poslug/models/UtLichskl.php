<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_lichskl".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property int $id_pokaz вид показника
 * @property string $period період
 * @property string $date дата введення показників
 * @property double $pokaz_nt1 попередні показники
 * @property double $pokaz_nt2 попередні показники
 * @property double $pokaz_nt3 попередні показники
 * @property double $pokaz_kt1 показники
 * @property double $pokaz_kt2 показники
 * @property double $pokaz_kt3 показники
 * @property double $rizn_t1 різниця
 * @property double $rizn_t2 різниця
 * @property double $rizn_t3 різниця
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPokaz $pokaz
 */
class UtLichskl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_lichskl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_abonent', 'id_pokaz', 'period', 'date'], 'required'],
            [['id_org', 'id_abonent', 'id_pokaz'], 'integer'],
            [['period', 'date'], 'safe'],
            [['pokaz_nt1', 'pokaz_nt2', 'pokaz_nt3', 'pokaz_kt1', 'pokaz_kt2', 'pokaz_kt3', 'rizn_t1', 'rizn_t2', 'rizn_t3'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_abonent'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_abonent' => 'id']],
            [['id_pokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtPokaz::className(), 'targetAttribute' => ['id_pokaz' => 'id']],
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
            'id_pokaz' => Yii::t('easyii', 'Id Pokaz'),
            'period' => Yii::t('easyii', 'Period'),
            'date' => Yii::t('easyii', 'Date'),
            'pokaz_nt1' => Yii::t('easyii', 'Pokaz Nt1'),
            'pokaz_nt2' => Yii::t('easyii', 'Pokaz Nt2'),
            'pokaz_nt3' => Yii::t('easyii', 'Pokaz Nt3'),
            'pokaz_kt1' => Yii::t('easyii', 'Pokaz Kt1'),
            'pokaz_kt2' => Yii::t('easyii', 'Pokaz Kt2'),
            'pokaz_kt3' => Yii::t('easyii', 'Pokaz Kt3'),
            'rizn_t1' => Yii::t('easyii', 'Rizn T1'),
            'rizn_t2' => Yii::t('easyii', 'Rizn T2'),
            'rizn_t3' => Yii::t('easyii', 'Rizn T3'),
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
    public function getPokaz()
    {
        return $this->hasOne(UtPokaz::className(), ['id' => 'id_pokaz']);
    }
}
