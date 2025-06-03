<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vw_dom}}".
 *
 * @property float|null $kl_ul
 * @property string|null $ulnaim
 * @property string|null $nomdom
 * @property int|null $ndom
 */
class DolgDom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vw_dom}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dolgdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kl_ul'], 'number'],
            [['ulnaim', 'nomdom'], 'string'],
            [['ndom'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl_ul' => 'Вулиця',
            'ulnaim' => 'Ulnaim',
            'nomdom' => 'Nomdom',
            'ndom' => 'Ndom',
        ];
    }
}
