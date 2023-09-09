<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%nach}}".
 *
 * @property string|null $schet
 * @property string|null $wid
 * @property string|null $lgota
 * @property string|null $lg_fio
 * @property string|null $lg_posv
 * @property string|null $lg_ser
 * @property string|null $lg_dt
 * @property float|null $lg_koli
 * @property string|null $lg_kat
 * @property float|null $tarif
 * @property float|null $sum
 * @property float|null $sum_full
 * @property float|null $razn
 * @property float|null $razn1
 * @property float|null $tarif1
 * @property float|null $fl_sch
 * @property string|null $idcod
 * @property float|null $calc_days
 * @property string|null $info
 * @property int $id
 * @property string|null $period
 * @property int|null $upd
 *
 * @property Wid $w
 */
class DolgNach extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nach}}';
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
            [['lg_koli', 'tarif', 'sum', 'sum_full', 'razn', 'razn1', 'tarif1', 'fl_sch', 'calc_days'], 'number'],
            [['period'], 'string'],
            [['upd'], 'integer'],
            [['schet', 'lg_dt', 'idcod'], 'string', 'max' => 10],
            [['wid', 'lgota', 'lg_kat'], 'string', 'max' => 2],
            [['lg_fio'], 'string', 'max' => 35],
            [['lg_posv'], 'string', 'max' => 9],
            [['lg_ser'], 'string', 'max' => 3],
            [['info'], 'string', 'max' => 4],
            [['wid'], 'exist', 'skipOnError' => true, 'targetClass' => DolgWid::class, 'targetAttribute' => ['wid' => 'wid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'schet' => 'Schet',
            'wid' => 'Wid',
            'lgota' => 'Lgota',
            'lg_fio' => 'Lg Fio',
            'lg_posv' => 'Lg Posv',
            'lg_ser' => 'Lg Ser',
            'lg_dt' => 'Lg Dt',
            'lg_koli' => 'Lg Koli',
            'lg_kat' => 'Lg Kat',
            'tarif' => 'Тариф',
            'sum' => 'Сума',
            'sum_full' => 'Sum Full',
            'razn' => 'Показник',
            'razn1' => 'Razn1',
            'tarif1' => 'Tarif1',
            'fl_sch' => 'Fl Sch',
            'idcod' => 'Idcod',
            'calc_days' => 'Calc Days',
            'info' => 'Info',
            'id' => 'ID',
            'period' => 'Період',
            'upd' => 'Upd',
        ];
    }

    /**
     * Gets query for [[W]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWid()
    {
        return $this->hasOne(DolgWid::class, ['wid' => 'wid']);
    }
}
