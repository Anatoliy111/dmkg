<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_mat".
 *
 * @property int $id
 * @property string $nom_n
 * @property string $naim
 * @property string $ed_izm
 * @property double $kol
 * @property double $cena
 * @property double $summa
 * @property double $ostat
 */
class UtMat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_mat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nom_n', 'naim', 'ed_izm'], 'required'],
            [['id'], 'integer'],
            [['kol', 'cena', 'summa', 'ostat'], 'number'],
            [['nom_n', 'ed_izm'], 'string', 'max' => 11],
            [['naim'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'nom_n' => Yii::t('easyii', 'Nom N'),
            'naim' => Yii::t('easyii', 'Naim'),
            'ed_izm' => Yii::t('easyii', 'Ed Izm'),
            'kol' => Yii::t('easyii', 'Kol'),
            'cena' => Yii::t('easyii', 'Cena'),
            'summa' => Yii::t('easyii', 'Summa'),
            'ostat' => Yii::t('easyii', 'Ostat'),
        ];
    }
}
