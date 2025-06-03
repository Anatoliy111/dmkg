<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%VW_TAR}}".
 *
 * @property float|null $kl
 * @property string|null $period
 * @property string|null $name
 * @property float|null $tarif
 * @property float|null $norma
 * @property string|null $naim
 * @property string|null $vid
 * @property float|null $npp
 */
class DOLGVWTAR extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%VW_TAR}}';
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
            [['kl', 'tarif', 'norma', 'npp'], 'number'],
            [['period'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['naim'], 'string', 'max' => 15],
            [['vid'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'period' => 'Period',
            'name' => 'Name',
            'tarif' => 'Tarif',
            'norma' => 'Norma',
            'naim' => 'Naim',
            'vid' => 'Vid',
            'npp' => 'Npp',
        ];
    }
}
