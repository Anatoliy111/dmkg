<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domnaryadmat".
 *
 * @property int $id
 * @property int $id_naryad
 * @property int $id_normrab
 * @property string $nom_n
 * @property string $naim
 * @property string $ed_izm
 * @property double $kol
 * @property double $cena
 * @property double $summa
 *
 * @property UtDomnaryad $naryad
 * @property UtNormrab $normrab
 */
class UtDomnaryadmat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domnaryadmat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_naryad', 'id_normrab', 'nom_n', 'naim', 'ed_izm', 'kol', 'cena', 'summa'], 'required'],
            [['id_naryad', 'id_normrab'], 'integer'],
            [['kol', 'cena', 'summa'], 'number'],
            [['nom_n', 'ed_izm'], 'string', 'max' => 11],
            [['naim'], 'string', 'max' => 50],
            [['id_naryad'], 'exist', 'skipOnError' => true, 'targetClass' => UtDomnaryad::className(), 'targetAttribute' => ['id_naryad' => 'id']],
            [['id_normrab'], 'exist', 'skipOnError' => true, 'targetClass' => UtNormrab::className(), 'targetAttribute' => ['id_normrab' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_naryad' => Yii::t('easyii', 'Id Naryad'),
            'id_normrab' => Yii::t('easyii', 'Id Normrab'),
            'nom_n' => Yii::t('easyii', 'Nom N'),
            'naim' => Yii::t('easyii', 'Naim'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'kol' => Yii::t('easyii', 'Kol'),
            'cena' => Yii::t('easyii', 'Cena'),
            'summa' => Yii::t('easyii', 'Summa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaryad()
    {
        return $this->hasOne(UtDomnaryad::className(), ['id' => 'id_naryad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNormrab()
    {
        return $this->hasOne(UtNormrab::className(), ['id' => 'id_normrab']);
    }
}
