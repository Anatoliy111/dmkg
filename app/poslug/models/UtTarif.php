<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarif".
 *
 * @property int $id
 * @property int $idplan
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
 * @property double $norma
 * @property int $del активна
 *
 * @property UtOrg $org
 * @property UtTipposl $tipposl
 * @property UtVidpokaz $vidpokaz
 * @property UtTarifab[] $utTarifabs
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
            [['id_org', 'id_tipposl', 'kl', 'name','period'], 'required'],
            [['id_org', 'id_tipposl', 'id_vidpokaz', 'kl','podezd'], 'integer'],
			[['name'], 'string', 'max' => 25],
            [['period'], 'safe'],
            [['tarifplan', 'tariffakt', 'norma'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_tipposl'], 'exist', 'skipOnError' => true, 'targetClass' => UtTipposl::className(), 'targetAttribute' => ['id_tipposl' => 'id']],
            [['id_vidpokaz'], 'exist', 'skipOnError' => true, 'targetClass' => UtVidpokaz::className(), 'targetAttribute' => ['id_vidpokaz' => 'id']],
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
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'id_dom' => Yii::t('easyii', 'Dom'),
            'kl' => Yii::t('easyii', 'Kl'),
			'name' => Yii::t('easyii', 'Nametarif'),
            'tarifplan' => Yii::t('easyii', 'Tarifplan'),
            'tariffakt' => Yii::t('easyii', 'Tariffakt'),
            'norma' => Yii::t('easyii', 'Norma'),
            'del' => Yii::t('easyii', 'Del'),
            'podezd' => Yii::t('easyii', 'podezd'),
            'period' => Yii::t('easyii', 'period'),
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

    public function getPoslvid()
    {
        $posl = $this->hasOne(UtTipposl::className(), ['id' => 'id_tipposl']);
        return $posl->primaryModel['tipposl']->getVidpokaz();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidpokaz()
    {
        return $this->hasOne(UtVidpokaz::className(), ['id' => 'id_vidpokaz']);
    }

    public function getDom()
    {
        return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
    }

	public function getUtTarifabs()
	{
		return $this->hasMany(UtTarifab::className(), ['id_tarif' => 'id']);
	}
}
