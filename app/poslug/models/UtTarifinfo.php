<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifinfo".
 *
 * @property int $id
 * @property int $id_tarif
 * @property int $id_tarifvid
 * @property double $tarifplan
 * @property double $tariffakt
 * @property double $tarifend
 *
 * @property UtTarif $tarif
 * @property UtTarifvid $idTarifv
 */
class UtTarifinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_tarifinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tarif', 'id_tarifvid'], 'required'],
            [['id_tarif', 'id_tarifvid'], 'integer'],
            [['tarifplan', 'tariffakt', 'tarifend'], 'number'],
            [['id_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarif::className(), 'targetAttribute' => ['id_tarif' => 'id']],
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
            'id_tarif' => Yii::t('easyii', 'Id Tarif'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'tarifplan' => Yii::t('easyii', 'Tarifplan'),
            'tariffakt' => Yii::t('easyii', 'Tariffakt'),
            'tarifend' => Yii::t('easyii', 'Tarifend'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarif()
    {
        return $this->hasOne(UtTarif::className(), ['id' => 'id_tarif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }
}
