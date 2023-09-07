<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ntarif}}".
 *
 * @property float|null $kl
 * @property float|null $kl_old
 * @property string|null $wid
 * @property string|null $name
 * @property string|null $schet
 * @property string|null $schet1
 * @property float|null $tarif
 * @property float|null $tarif_bl
 * @property float|null $tarif_l
 * @property float|null $norma
 * @property float|null $lift
 * @property float|null $tarsubs
 * @property float|null $val
 * @property string|null $period
 * @property int|null $upd
 * @property int $id
 */
class DolgNtarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ntarif}}';
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
            [['kl', 'kl_old', 'tarif', 'tarif_bl', 'tarif_l', 'norma', 'lift', 'tarsubs', 'val'], 'number'],
            [['period'], 'string'],
            [['upd'], 'integer'],
            [['wid'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 50],
            [['schet', 'schet1'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'kl_old' => 'Kl Old',
            'wid' => 'Wid',
            'name' => 'Name',
            'schet' => 'Schet',
            'schet1' => 'Schet1',
            'tarif' => 'Tarif',
            'tarif_bl' => 'Tarif Bl',
            'tarif_l' => 'Tarif L',
            'norma' => 'Norma',
            'lift' => 'Lift',
            'tarsubs' => 'Tarsubs',
            'val' => 'Val',
            'period' => 'Period',
            'upd' => 'Upd',
            'id' => 'ID',
        ];
    }
}
