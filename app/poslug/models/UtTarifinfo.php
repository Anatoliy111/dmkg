<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_tarifinfo".
 *
 * @property int $id
 * @property int $id_tarifplan
 * @property int $id_tarifvid
 * @property double $tarifplan
 * @property double $tariffact
 * @property UtTarifvid $idTarifv
 * @property UtTarifplan $tarifplan0
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
            [['id_tarifplan', 'id_tarifvid'], 'required'],
            [['id_tarifplan', 'id_tarifvid'], 'integer'],
            [['tarifplan','tariffact'], 'number'],
            [['id_tarifvid'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifvid::className(), 'targetAttribute' => ['id_tarifvid' => 'id']],
            [['id_tarifplan'], 'exist', 'skipOnError' => true, 'targetClass' => UtTarifplan::className(), 'targetAttribute' => ['id_tarifplan' => 'id']],
//            ['id_tarifvid', 'in', 'range' => UtTarifinfo::find()->select('id_tarifvid')->where(['id_tarifplan' => 'id_tarifplan'])->asArray()->column(),'not'=>true,'message' => 'Такий вид тарифу вже додано !!!'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_tarifplan' => Yii::t('easyii', 'Id Tarifplan'),
            'id_tarifvid' => Yii::t('easyii', 'Id Tarifvid'),
            'tarifplan' => Yii::t('easyii', 'Tarifplan'),
            'tariffact' => Yii::t('easyii', 'Tariffact'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTarifv()
    {
        return $this->hasOne(UtTarifvid::className(), ['id' => 'id_tarifvid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarifplan0()
    {
        return $this->hasOne(UtTarifplan::className(), ['id' => 'id_tarifplan']);
    }


}
