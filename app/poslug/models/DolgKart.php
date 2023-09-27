<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "{{%kart}}".
 *
 * @property string|null $schet
 * @property string|null $numb
 * @property string|null $fio
 * @property string|null $im
 * @property string|null $ot
 * @property string|null $fio_v
 * @property string|null $idcod
 * @property string|null $cex
 * @property string|null $tabn
 * @property string|null $fio_tabn
 * @property string|null $lg_nofam
 * @property string|null $koli_lg
 * @property float|null $koli_p
 * @property float|null $koli_pf
 * @property float|null $koli_k
 * @property float|null $plos_bb
 * @property float|null $plos_ob
 * @property string|null $priv
 * @property float|null $etag
 * @property string|null $lgota
 * @property string|null $lg_posv
 * @property string|null $lg_ser
 * @property string|null $lg_fio
 * @property string|null $lg_date
 * @property string|null $lg_kat
 * @property string|null $fl_chern
 * @property string|null $fl_lifte
 * @property string|null $fl_lifto
 * @property string|null $fl_klet
 * @property string|null $fl_muso
 * @property string|null $fl_osv
 * @property string|null $fl_ubor
 * @property string|null $fl_vent
 * @property string|null $fl_zima
 * @property string|null $fl_rem
 * @property string|null $fl_ditm
 * @property string|null $fl_tual
 * @property string|null $fl_nolift
 * @property string|null $fl_nokan
 * @property float|null $max_ud
 * @property float|null $nom
 * @property float|null $org
 * @property string|null $d_dog
 * @property string|null $n_dog
 * @property string|null $zaya
 * @property string|null $restr
 * @property string|null $note
 * @property string|null $note1
 * @property string|null $flag
 * @property float|null $wozw_ot_
 * @property string|null $telef
 * @property float|null $kl_ul
 * @property string|null $ulnaim
 * @property string|null $nomdom
 * @property string|null $nomkv
 * @property float|null $lift
 * @property float|null $val
 * @property int $kl
 * @property int|null $upd
 */
class DolgKart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kart}}';
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
            [['koli_p', 'koli_pf', 'koli_k', 'plos_bb', 'plos_ob', 'etag', 'max_ud', 'nom', 'org', 'wozw_ot_', 'kl_ul', 'lift', 'val'], 'number'],
            [['upd'], 'integer'],
            [['schet'], 'string', 'max' => 10],
            [['numb', 'koli_lg', 'd_dog'], 'string', 'max' => 8],
            [['fio', 'lg_fio'], 'string', 'max' => 45],
            [['im', 'ot'], 'string', 'max' => 15],
            [['fio_v'], 'string', 'max' => 35],
            [['idcod'], 'string', 'max' => 32],
            [['cex'], 'string', 'max' => 3],
            [['tabn', 'nomdom', 'nomkv'], 'string', 'max' => 5],
            [['fio_tabn', 'n_dog', 'telef'], 'string', 'max' => 20],
            [['lg_nofam', 'priv', 'fl_chern', 'fl_lifte', 'fl_lifto', 'fl_klet', 'fl_muso', 'fl_osv', 'fl_ubor', 'fl_vent', 'fl_zima', 'fl_rem', 'fl_ditm', 'fl_tual', 'fl_nolift', 'fl_nokan', 'zaya', 'restr', 'flag'], 'string', 'max' => 1],
            [['lgota'], 'string', 'max' => 9],
            [['lg_posv'], 'string', 'max' => 25],
            [['lg_ser', 'lg_kat'], 'string', 'max' => 12],
            [['lg_date'], 'string', 'max' => 33],
            [['note', 'note1', 'ulnaim'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'schet' => 'Schet',
            'numb' => 'Numb',
            'fio' => 'Fio',
            'im' => 'Im',
            'ot' => 'Ot',
            'fio_v' => 'Fio V',
            'idcod' => 'Idcod',
            'cex' => 'Cex',
            'tabn' => 'Tabn',
            'fio_tabn' => 'Fio Tabn',
            'lg_nofam' => 'Lg Nofam',
            'koli_lg' => 'Koli Lg',
            'koli_p' => 'Koli P',
            'koli_pf' => 'Koli Pf',
            'koli_k' => 'Koli K',
            'plos_bb' => 'Plos Bb',
            'plos_ob' => 'Plos Ob',
            'priv' => 'Priv',
            'etag' => 'Etag',
            'lgota' => 'Lgota',
            'lg_posv' => 'Lg Posv',
            'lg_ser' => 'Lg Ser',
            'lg_fio' => 'Lg Fio',
            'lg_date' => 'Lg Date',
            'lg_kat' => 'Lg Kat',
            'fl_chern' => 'Fl Chern',
            'fl_lifte' => 'Fl Lifte',
            'fl_lifto' => 'Fl Lifto',
            'fl_klet' => 'Fl Klet',
            'fl_muso' => 'Fl Muso',
            'fl_osv' => 'Fl Osv',
            'fl_ubor' => 'Fl Ubor',
            'fl_vent' => 'Fl Vent',
            'fl_zima' => 'Fl Zima',
            'fl_rem' => 'Fl Rem',
            'fl_ditm' => 'Fl Ditm',
            'fl_tual' => 'Fl Tual',
            'fl_nolift' => 'Fl Nolift',
            'fl_nokan' => 'Fl Nokan',
            'max_ud' => 'Max Ud',
            'nom' => 'Nom',
            'org' => 'Org',
            'd_dog' => 'D Dog',
            'n_dog' => 'N Dog',
            'zaya' => 'Zaya',
            'restr' => 'Restr',
            'note' => 'Note',
            'note1' => 'Note1',
            'flag' => 'Flag',
            'wozw_ot_' => 'Wozw Ot',
            'telef' => 'Telef',
            'kl_ul' => 'Kl Ul',
            'ulnaim' => 'Ulnaim',
            'nomdom' => 'Nomdom',
            'nomkv' => 'Nomkv',
            'lift' => 'Lift',
            'val' => 'Val',
            'kl' => 'Kl',
            'upd' => 'Upd',
        ];
    }

    public function getUlica()
    {
        return $this->hasOne(DolgUl::className(), ['kl' => 'kl_ul']);
    }

    public function period()
    {
//        $sql = 'Select id_org,period from ut_obor group by id_org,period order by id_org,period ';
//        $periodd1 = UtObor::findbysql($sql)->all();
        $periodd  = DolgPeriod::find()->select('period')->groupBy('period')->orderBy('period')->all();
        return $periodd;
    }

    public function lastperiod()
    {
//        $sql = 'Select id_org,period from ut_obor group by id_org,period order by id_org,period ';
//        $lastperiod = UtObor::find()->all();
        $lastperiod = DolgPeriod::find()->max('period');
//        $lastperiod = UtObor::find()->select(['period, id_org'])->distinct();
//        $lastperiod = ArrayHelper::map(UtUlica::find()->asArray()->all(), 'ID', 'ul'),
        return $lastperiod;
    }

}
