<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domzatrat".
 *
 * @property int $id
 * @property int $id_dom вулиця
 * @property string $date
 * @property int $n_akt
 * @property int $id_org
 * @property double $kol
 * @property double $cena
 * @property double $obem
 * @property double $sum
 * @property string $note нотатки
 *
 * @property UtDom $dom
 * @property UtOrg $org
 */
class UtDomzatrat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domzatrat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dom', 'date', 'n_akt', 'id_org'], 'required'],
            [['id_dom', 'n_akt', 'id_org'], 'integer'],
            [['date'], 'safe'],
            [['kol', 'cena', 'obem', 'sum'], 'number'],
            [['note'], 'string'],
            [['id_dom'], 'exist', 'skipOnError' => true, 'targetClass' => UtDom::className(), 'targetAttribute' => ['id_dom' => 'id']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_dom' => Yii::t('easyii', 'Id Dom'),
            'date' => Yii::t('easyii', 'Date'),
            'n_akt' => Yii::t('easyii', 'N Akt'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'kol' => Yii::t('easyii', 'Kol'),
            'cena' => Yii::t('easyii', 'Cena'),
            'obem' => Yii::t('easyii', 'Obem'),
            'sum' => Yii::t('easyii', 'Sum'),
            'note' => Yii::t('easyii', 'Note'),
        ];
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
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }
}
