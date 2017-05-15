<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_oldobor".
 *
 * @property int $id
 * @property int $id_usl
 * @property int $klients_id
 * @property int $id_mes
 * @property int $god
 * @property double $dolg_n
 * @property double $nach
 * @property double $oplata
 * @property double $subs
 * @property double $dolg_k
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $pereschet
 */
class UtOldobor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_oldobor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usl', 'klients_id'], 'required'],
            [['id_usl', 'klients_id', 'id_mes', 'god', 'pereschet'], 'integer'],
            [['dolg_n', 'nach', 'oplata', 'subs', 'dolg_k'], 'number'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_usl' => Yii::t('easyii', 'Id Usl'),
            'klients_id' => Yii::t('easyii', 'Klients ID'),
            'id_mes' => Yii::t('easyii', 'Id Mes'),
            'god' => Yii::t('easyii', 'God'),
            'dolg_n' => Yii::t('easyii', 'Dolg N'),
            'nach' => Yii::t('easyii', 'Nach'),
            'oplata' => Yii::t('easyii', 'Oplata'),
            'subs' => Yii::t('easyii', 'Subs'),
            'dolg_k' => Yii::t('easyii', 'Dolg K'),
            'CREATED_AT' => Yii::t('easyii', 'Created  At'),
            'UPDATED_AT' => Yii::t('easyii', 'Updated  At'),
            'pereschet' => Yii::t('easyii', 'Pereschet'),
        ];
    }
}
