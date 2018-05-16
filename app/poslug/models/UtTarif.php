<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarif".
 *
 * @property int $id
 * @property int $id_org організація
 * @property string $period
 * @property string $name
 * @property int $id_tipposl тип послуг
 * @property int $id_dom dom
 * @property int $id_vidpokaz вид показника
 * @property int $podezd
 * @property int $kl ключ
 * @property double $tarifplan тариф
 * @property double $tariffakt тариф
 * @property double $tarifend тариф
 * @property int $del активна
 *
 * @property UtOrg $org
 * @property UtTipposl $tipposl
 * @property UtVidpokaz $vidpokaz
 */
class UtTarif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tarif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_tipposl', 'kl', 'tarif1', 'name'], 'required'],
            [['id_org', 'id_tipposl', 'id_vidpokaz', 'kl'], 'integer'],
			[['name'], 'string', 'max' => 25],
            [['tarif1', 'tarif2', 'tarif3', 'koef_skl', 'norma', 'normalgot', 'normalgotsm'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
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
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'kl' => Yii::t('easyii', 'Kl'),
			'name' => Yii::t('easyii', 'Name'),
            'tarif1' => Yii::t('easyii', 'Tarif1'),
            'tarif2' => Yii::t('easyii', 'Tarif2'),
            'tarif3' => Yii::t('easyii', 'Tarif3'),
            'koef_skl' => Yii::t('easyii', 'Koef Skl'),
            'norma' => Yii::t('easyii', 'Norma'),
            'normalgot' => Yii::t('easyii', 'Normalgot'),
            'normalgotsm' => Yii::t('easyii', 'Normalgotsm'),
            'del' => Yii::t('easyii', 'Del'),
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
    public function getTipposl()
    {
        return $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidpokaz()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
    }
}
