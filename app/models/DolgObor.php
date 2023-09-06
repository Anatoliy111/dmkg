<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vw_obkr}}".
 *
 * @property int|null $kl
 * @property string|null $period
 * @property string|null $kontrol
 * @property string|null $schet
 * @property string|null $wid
 * @property string|null $poslug
 * @property string|null $fio
 * @property string|null $ulnaim
 * @property string|null $nomdom
 * @property string|null $nomkv
 * @property float|null $org
 * @property string|null $idcod
 * @property float|null $koli_p
 * @property float|null $koli_pf
 * @property float|null $plos_bb
 * @property float|null $plos_ob
 * @property string|null $priv
 * @property string|null $lgota
 * @property string|null $n_dog
 * @property string|null $d_dog
 * @property float|null $tarif
 * @property float|null $dolg
 * @property float|null $nach
 * @property float|null $subs
 * @property float|null $opl
 * @property float|null $uder
 * @property float|null $komp
 * @property float|null $wzmz
 * @property float|null $wozw
 * @property float|null $movw
 * @property float|null $pere
 * @property float|null $sal
 * @property float|null $bgst
 * @property float|null $prst
 * @property float|null $bgend
 * @property float|null $prend
 * @property float|null $fullnach
 * @property float|null $fullopl
 * @property float|null $oplnotsubs
 */
class DolgObor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vw_obkr}}';
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
            [['kl'], 'integer'],
            [['period', 'fio'], 'string'],
            [['org', 'koli_p', 'koli_pf', 'plos_bb', 'plos_ob', 'tarif', 'dolg', 'nach', 'subs', 'opl', 'uder', 'komp', 'wzmz', 'wozw', 'movw', 'pere', 'sal', 'bgst', 'prst', 'bgend', 'prend', 'fullnach', 'fullopl', 'oplnotsubs'], 'number'],
            [['kontrol'], 'string', 'max' => 40],
            [['schet', 'n_dog'], 'string', 'max' => 10],
            [['wid'], 'string', 'max' => 2],
            [['poslug'], 'string', 'max' => 15],
            [['ulnaim'], 'string', 'max' => 64],
            [['nomdom', 'nomkv'], 'string', 'max' => 5],
            [['idcod'], 'string', 'max' => 32],
            [['priv'], 'string', 'max' => 1],
            [['lgota'], 'string', 'max' => 9],
            [['d_dog'], 'string', 'max' => 8],
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
            'kontrol' => 'Kontrol',
            'schet' => 'Schet',
            'wid' => 'Wid',
            'poslug' => 'Poslug',
            'fio' => 'Fio',
            'ulnaim' => 'Ulnaim',
            'nomdom' => 'Nomdom',
            'nomkv' => 'Nomkv',
            'org' => 'Org',
            'idcod' => 'Idcod',
            'koli_p' => 'Koli P',
            'koli_pf' => 'Koli Pf',
            'plos_bb' => 'Plos Bb',
            'plos_ob' => 'Plos Ob',
            'priv' => 'Priv',
            'lgota' => 'Lgota',
            'n_dog' => 'N Dog',
            'd_dog' => 'D Dog',
            'tarif' => 'Tarif',
            'dolg' => 'Dolg',
            'nach' => 'Nach',
            'subs' => 'Subs',
            'opl' => 'Opl',
            'uder' => 'Uder',
            'komp' => 'Komp',
            'wzmz' => 'Wzmz',
            'wozw' => 'Wozw',
            'movw' => 'Movw',
            'pere' => 'Pere',
            'sal' => 'Sal',
            'bgst' => 'Bgst',
            'prst' => 'Prst',
            'bgend' => 'Bgend',
            'prend' => 'Prend',
            'fullnach' => 'Fullnach',
            'fullopl' => 'Fullopl',
            'oplnotsubs' => 'Oplnotsubs',
        ];
    }
}
