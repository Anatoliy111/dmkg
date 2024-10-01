<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%h_voda}}".
 *
 * @property int $kl
 * @property int $yearmon
 * @property int|null $plomb опломбирован=1
 * @property string|null $fio
 * @property int|null $wid
 * @property int|null $wid_prev
 * @property string|null $dom
 * @property string|null $kvart
 * @property string $schet
 * @property string|null $n_sch РЅРѕРјРµСЂ СЃС‡РµС‚С‡РёРєР°
 * @property float|null $sch_old счетчик старое знач
 * @property float|null $sch_cur счетчик текущее знач
 * @property float|null $sch_razn куби поточний місяць
 * @property float|null $sch_razn2 куби наступний місяць
 * @property float|null $koli_p колич прописано   в текущем месяце
 * @property int|null $koli_p0 колич прописано на начало месяца
 * @property int|null $koli_p1 колич прописано на конец месяца
 * @property float|null $nor_razn по норме кубы
 * @property float|null $grp_razn по подъезду кубы
 * @property int|null $pere_day перерахунок за минулий місяць днів
 * @property float|null $pere_razn перерахунок куби
 * @property int|null $id_kontr
 * @property string|null $ul
 * @property string|null $n_dom
 * @property string|null $kv
 * @property string|null $note
 * @property float|null $koli_f
 * @property float|null $rasch_kub
 * @property float|null $rasch_nor
 * @property int|null $pod
 * @property string|null $rasch_note
 * @property string|null $date_pok
 * @property int|null $vid_pok
 * @property float|null $kub_mes
 * @property string|null $lich_pov Naimensha data povirki
 * @property int $org
 * @property int|null $vid_rn
 * @property int|null $filtr
 * @property int|null $pompa
 * @property int|null $zn_lich
 * @property int|null $znold_lich
 * @property string|null $date_zn
 * @property int|null $lich_to
 * @property int|null $klntar
 * @property string|null $tarif_name
 * @property float|null $norma
 * @property float|null $old_norm минула норма за нездачу показника
 * @property float|null $del_norm
 * @property float|null $prev_norm
 * @property float|null $spis
 * @property int|null $lich_yearmon
 * @property int|null $edrpou
 * @property int|null $kl_ul
 * @property string|null $r_nach
 * @property float|null $norm_blich
 * @property float|null $kub_nobalans
 * @property float|null $kub_all
 * @property float|null $plosch_ur площа юриків
 * @property float|null $pererah
 * @property string|null $r_nobal
 */
class HVoda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%h_voda}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('hvddb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yearmon', 'plomb', 'wid', 'wid_prev', 'koli_p0', 'koli_p1', 'pere_day', 'id_kontr', 'pod', 'vid_pok', 'org', 'vid_rn', 'filtr', 'pompa', 'zn_lich', 'znold_lich', 'lich_to', 'klntar', 'lich_yearmon', 'edrpou', 'kl_ul'], 'integer'],
            [['dom', 'kvart', 'date_pok', 'lich_pov', 'date_zn'], 'string'],
            [['schet'], 'required'],
            [['sch_old', 'sch_cur', 'sch_razn', 'sch_razn2', 'koli_p', 'nor_razn', 'grp_razn', 'pere_razn', 'koli_f', 'rasch_kub', 'rasch_nor', 'kub_mes', 'norma', 'old_norm', 'del_norm', 'prev_norm', 'spis', 'norm_blich', 'kub_nobalans', 'kub_all', 'plosch_ur', 'pererah'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'yearmon' => 'Yearmon',
            'plomb' => 'Plomb',
            'fio' => 'Fio',
            'wid' => 'Wid',
            'wid_prev' => 'Wid Prev',
            'dom' => 'Dom',
            'kvart' => 'Kvart',
            'schet' => 'Schet',
            'n_sch' => 'N Sch',
            'sch_old' => 'Sch Old',
            'sch_cur' => 'sch cur',
            'sch_razn' => 'Sch Razn',
            'sch_razn2' => 'Sch Razn2',
            'koli_p' => 'Koli P',
            'koli_p0' => 'Koli P0',
            'koli_p1' => 'Koli P1',
            'nor_razn' => 'Nor Razn',
            'grp_razn' => 'Grp Razn',
            'pere_day' => 'Pere Day',
            'pere_razn' => 'Pere Razn',
            'id_kontr' => 'Id Kontr',
            'ul' => 'Ul',
            'n_dom' => 'N Dom',
            'kv' => 'Kv',
            'note' => 'Note',
            'koli_f' => 'Koli F',
            'rasch_kub' => 'Rasch Kub',
            'rasch_nor' => 'Rasch Nor',
            'pod' => 'Pod',
            'rasch_note' => 'Rasch Note',
            'date_pok' => 'Date Pok',
            'vid_pok' => 'Vid Pok',
            'kub_mes' => 'Kub Mes',
            'lich_pov' => 'Lich Pov',
            'org' => 'Org',
            'vid_rn' => 'Vid Rn',
            'filtr' => 'Filtr',
            'pompa' => 'Pompa',
            'zn_lich' => 'Zn Lich',
            'znold_lich' => 'Znold Lich',
            'date_zn' => 'Date Zn',
            'lich_to' => 'Lich To',
            'klntar' => 'Klntar',
            'tarif_name' => 'Tarif Name',
            'norma' => 'Norma',
            'old_norm' => 'Old Norm',
            'del_norm' => 'Del Norm',
            'prev_norm' => 'Prev Norm',
            'spis' => 'Spis',
            'lich_yearmon' => 'Lich Yearmon',
            'edrpou' => 'Edrpou',
            'kl_ul' => 'Kl Ul',
            'r_nach' => 'R Nach',
            'norm_blich' => 'Norm Blich',
            'kub_nobalans' => 'Kub Nobalans',
            'kub_all' => 'Kub All',
            'plosch_ur' => 'Plosch Ur',
            'pererah' => 'Pererah',
            'r_nobal' => 'R Nobal',
        ];
    }

    public function getSprzn()
    {
        return $this->hasOne(SprZn::className(), ['id' => 'wid']);
    }
}
