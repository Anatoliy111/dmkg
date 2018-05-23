<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifplan".
 *
 * @property int $id
 * @property string $period
 * @property int $id_dom
 * @property string $ul
 * @property int $id_tipposl
 * @property int $id_vidpokaz
 * @property double $tarifplan
 *
 * @property UtDom $dom
 * @property UtTipposl $tipposl
 * @property UtVidpokaz $vidpokaz
 */
class UtTarifplan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tarifplan';
    }

    /**
     * @inheritdoc
     */

    public $periodmes;

    public function rules()
    {
        return [
            [['period', 'id_dom', 'id_tipposl', 'id_vidpokaz'], 'required'],
            [['period','periodmes'], 'safe'],
            [['id_dom', 'id_tipposl', 'id_vidpokaz'], 'integer'],
            [['tarifplan'], 'number'],
            [['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
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
            'period' => Yii::t('easyii', 'Period'),
            'id_dom' => Yii::t('easyii', 'Dom'),
            'id_tipposl' => Yii::t('easyii', 'Id Tipposl'),
            'id_vidpokaz' => Yii::t('easyii', 'Id Vidpokaz'),
            'tarifplan' => Yii::t('easyii', 'Tarifplan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDom()
    {
        $dom = $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
        return $dom;
    }

    public function getDomul()//Выборка наименований улиц по связям ut_tarifplan->ut_dom->ut_ulica
    {
        $dom = $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
        return $dom->primaryModel['dom']->getUlica();
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
