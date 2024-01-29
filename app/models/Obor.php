<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%obor}}".
 *
 * @property string|null $schet
 * @property string|null $wid
 * @property string|null $fio
 * @property float|null $koef
 * @property float|null $tarif
 * @property string|null $bl
 * @property string|null $su_dt
 * @property float|null $su_dolg0
 * @property float|null $su_dolg
 * @property string|null $su_dtr
 * @property string|null $su_nr
 * @property string|null $su_period
 * @property float|null $su_vidm
 * @property string|null $n_dog
 * @property string|null $d_dog
 * @property float|null $dolg
 * @property float|null $nach
 * @property float|null $nach_full
 * @property float|null $wozb
 * @property float|null $subs
 * @property float|null $komp
 * @property string|null $fl1
 * @property float|null $opl
 * @property float|null $opl_ud
 * @property string|null $opl_dt
 * @property float|null $uder
 * @property float|null $wozw
 * @property float|null $wozw_kas
 * @property float|null $wzmz
 * @property float|null $pere
 * @property string|null $plomb
 * @property float|null $movw
 * @property float|null $norma
 * @property float|null $newrec
 * @property float|null $sal
 * @property float|null $kl_ntar
 * @property float|null $nach_old
 * @property float|null $tarsubs
 * @property int $kl
 * @property string|null $period
 * @property int|null $upd
 */
class Obor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%obor}}';
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
            [['koef', 'tarif', 'su_dolg0', 'su_dolg', 'su_vidm', 'dolg', 'nach', 'nach_full', 'wozb', 'subs', 'komp', 'opl', 'opl_ud', 'uder', 'wozw', 'wozw_kas', 'wzmz', 'pere', 'movw', 'norma', 'newrec', 'sal', 'kl_ntar', 'nach_old', 'tarsubs'], 'number'],
            [['su_dt', 'su_dtr', 'opl_dt', 'period'], 'string'],
            [['upd'], 'integer'],
            [['schet', 'n_dog'], 'string', 'max' => 10],
            [['wid'], 'string', 'max' => 2],
            [['fio'], 'string', 'max' => 25],
            [['bl', 'fl1', 'plomb'], 'string', 'max' => 1],
            [['su_nr'], 'string', 'max' => 16],
            [['su_period'], 'string', 'max' => 30],
            [['d_dog'], 'string', 'max' => 8],
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
            'fio' => 'Fio',
            'koef' => 'Koef',
            'tarif' => 'Tarif',
            'bl' => 'Bl',
            'su_dt' => 'Su Dt',
            'su_dolg0' => 'Su Dolg0',
            'su_dolg' => 'Su Dolg',
            'su_dtr' => 'Su Dtr',
            'su_nr' => 'Su Nr',
            'su_period' => 'Su Period',
            'su_vidm' => 'Su Vidm',
            'n_dog' => 'N Dog',
            'd_dog' => 'D Dog',
            'dolg' => 'Dolg',
            'nach' => 'Nach',
            'nach_full' => 'Nach Full',
            'wozb' => 'Wozb',
            'subs' => 'Subs',
            'komp' => 'Komp',
            'fl1' => 'Fl1',
            'opl' => 'Opl',
            'opl_ud' => 'Opl Ud',
            'opl_dt' => 'Opl Dt',
            'uder' => 'Uder',
            'wozw' => 'Wozw',
            'wozw_kas' => 'Wozw Kas',
            'wzmz' => 'Wzmz',
            'pere' => 'Pere',
            'plomb' => 'Plomb',
            'movw' => 'Movw',
            'norma' => 'Norma',
            'newrec' => 'Newrec',
            'sal' => 'Sal',
            'kl_ntar' => 'Kl Ntar',
            'nach_old' => 'Nach Old',
            'tarsubs' => 'Tarsubs',
            'kl' => 'Kl',
            'period' => 'Period',
            'upd' => 'Upd',
        ];
    }
}
