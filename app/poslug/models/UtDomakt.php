<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domakt".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_dom
 * @property int $id_postach
 * @property int $id_tarifvid
 * @property string $n_akt
 * @property double $obem
 * @property int $cena
 * @property int $kol
 * @property int $summa
 * @property string $notevid
 * @property int $proveden
 *
 * @property UtOrg $org
 * @property UtDom $dom
 * @property UtPostach $postach
 * @property UtTarifvid $idTarifv
 */
class UtDomakt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domakt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_dom', 'id_postach', 'id_tarifvid', 'n_akt', 'kol', 'summa', 'notevid', 'proveden'], 'required'],
            [['id_org', 'id_dom', 'id_postach', 'id_tarifvid', 'cena', 'kol', 'summa', 'proveden'], 'integer'],
            [['period'], 'safe'],
            [['obem'], 'number'],
            [['n_akt'], 'string', 'max' => 20],
            [['notevid'], 'string', 'max' => 200],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
            [['id_postach'], 'exist', 'skipOnError' => true, 'targetClass' => UtPostach::className(), 'targetAttribute' => ['id_postach' => 'id']],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
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
            'period' => Yii::t('easyii', 'Period'),
            'id_dom' => Yii::t('easyii', 'Id Dom'),
            'id_postach' => Yii::t('easyii', 'Id Postach'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'n_akt' => Yii::t('easyii', 'N Akt'),
            'obem' => Yii::t('easyii', 'Obem'),
            'cena' => Yii::t('easyii', 'Cena'),
            'kol' => Yii::t('easyii', 'Kol'),
            'summa' => Yii::t('easyii', 'Summa'),
            'notevid' => Yii::t('easyii', 'Notevid'),
            'proveden' => Yii::t('easyii', 'Proveden'),
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
    public function getDom()
    {
        return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostach()
    {
        return $this->hasOne(UtPostach::className(), ['id' => 'id_postach']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }
}
