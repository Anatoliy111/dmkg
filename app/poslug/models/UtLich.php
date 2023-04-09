<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_lich".
 *
 * @property int $id
 * @property int $id_org організація
 * @property int $id_abonent абонент
 * @property int $id_pokaz вид показника
 * @property string $period період
 * @property string $data дата показника
 * @property double $pokaz_n попередні показники
 * @property double $pokaz_k показники
 * @property double $rizn різниця
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPokaz $pokaz
 */
class UtLich extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_lich';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_abonent', 'id_pokaz', 'period', 'data', 'pokaz_n', 'pokaz_k', 'rizn'], 'required'],
            [['id_org', 'id_abonent', 'id_pokaz'], 'integer'],
            [['period', 'data'], 'safe'],
            [['pokaz_n', 'pokaz_k', 'rizn'], 'number'],
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
            'data' => Yii::t('easyii', 'Data'),
            'pokaz_n' => Yii::t('easyii', 'Pokaz N'),
            'pokaz_k' => Yii::t('easyii', 'Pokaz K'),
            'rizn' => Yii::t('easyii', 'Rizn'),
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
