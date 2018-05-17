<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_dominfo".
 *
 * @property int $id
 * @property int $id_dom
 * @property string $form_vlas
 * @property int $god_eksp
 * @property string $teh_stan
 * @property int $kol_etag
 * @property int $kol_pod
 * @property int $kol_kv
 * @property int $kol_kvpriv
 * @property int $kol_kvkom
 * @property double $plos
 * @property double $plos_kv
 * @property double $plos_nokv
 * @property int $kol_lud
 * @property string $tip_dom
 * @property string $lift
 * @property double $plos_terit
 * @property int $kol_podval
 * @property int $kol_kladov
 *
 * @property UtDom $dom
 */
class UtDominfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_dominfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dom'], 'required'],
            [['id', 'id_dom', 'god_eksp', 'kol_etag', 'kol_pod', 'kol_kv', 'kol_kvpriv', 'kol_kvkom', 'kol_lud', 'kol_podval', 'kol_kladov'], 'integer'],
            [['plos', 'plos_kv', 'plos_nokv', 'plos_terit'], 'number'],
            [['form_vlas', 'teh_stan', 'tip_dom', 'lift'], 'string', 'max' => 30],
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
            'id_dom' => Yii::t('easyii', 'Id Dom'),
            'form_vlas' => Yii::t('easyii', 'Form Vlas'),
            'god_eksp' => Yii::t('easyii', 'God Eksp'),
            'teh_stan' => Yii::t('easyii', 'Teh Stan'),
            'kol_etag' => Yii::t('easyii', 'Kol Etag'),
            'kol_pod' => Yii::t('easyii', 'Kol Pod'),
            'kol_kv' => Yii::t('easyii', 'Kol Kv'),
            'kol_kvpriv' => Yii::t('easyii', 'Kol Kvpriv'),
            'kol_kvkom' => Yii::t('easyii', 'Kol Kvkom'),
            'plos' => Yii::t('easyii', 'Plos'),
            'plos_kv' => Yii::t('easyii', 'Plos Kv'),
            'plos_nokv' => Yii::t('easyii', 'Plos Nokv'),
            'kol_lud' => Yii::t('easyii', 'Kol Lud'),
            'tip_dom' => Yii::t('easyii', 'Tip Dom'),
            'lift' => Yii::t('easyii', 'Lift'),
            'plos_terit' => Yii::t('easyii', 'Plos Terit'),
            'kol_podval' => Yii::t('easyii', 'Kol Podval'),
            'kol_kladov' => Yii::t('easyii', 'Kol Kladov'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDom()
    {
        return $this->hasOne(UtDom::className(), ['id' => 'id_dom']);
    }
}
