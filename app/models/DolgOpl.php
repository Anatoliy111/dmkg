<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%opl}}".
 *
 * @property float|null $fl
 * @property string|null $schet
 * @property float|null $fl_gropl
 * @property float|null $opl
 * @property string|null $rah
 * @property float|null $ym
 * @property float|null $id
 * @property float|null $opl_r
 * @property float|null $opl_as
 * @property float|null $opl_el
 * @property float|null $opl_hv
 * @property float|null $opl_av
 * @property float|null $opl_kv
 * @property float|null $opl_om
 * @property float|null $opl_op
 * @property float|null $opl_ot
 * @property float|null $opl_ov
 * @property float|null $opl_rs
 * @property float|null $opl_sm
 * @property float|null $opl_sn
 * @property float|null $opl_su
 * @property float|null $opl_ub
 * @property float|null $opl_sz
 * @property string|null $wzmz
 * @property float|null $pach
 * @property string|null $dt
 * @property string|null $restr
 * @property string|null $note
 * @property string|null $doc
 * @property int $kl
 * @property int|null $upd
 * @property string|null $period
 */
class DolgOpl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%opl}}';
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
            [['fl', 'fl_gropl', 'opl', 'ym', 'id', 'opl_r', 'opl_as', 'opl_el', 'opl_hv', 'opl_av', 'opl_kv', 'opl_om', 'opl_op', 'opl_ot', 'opl_ov', 'opl_rs', 'opl_sm', 'opl_sn', 'opl_su', 'opl_ub', 'opl_sz', 'pach'], 'number'],
            [['dt', 'period'], 'string'],
            [['upd'], 'integer'],
            [['schet'], 'string', 'max' => 10],
            [['rah'], 'string', 'max' => 7],
            [['wzmz', 'restr'], 'string', 'max' => 1],
            [['note'], 'string', 'max' => 44],
            [['doc'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fl' => 'Fl',
            'schet' => 'Schet',
            'fl_gropl' => 'Fl Gropl',
            'opl' => 'Opl',
            'rah' => 'Rah',
            'ym' => 'Ym',
            'id' => 'ID',
            'opl_r' => 'Opl R',
            'opl_as' => 'Opl As',
            'opl_el' => 'Opl El',
            'opl_hv' => 'Opl Hv',
            'opl_av' => 'Opl Av',
            'opl_kv' => 'Opl Kv',
            'opl_om' => 'Opl Om',
            'opl_op' => 'Opl Op',
            'opl_ot' => 'Opl Ot',
            'opl_ov' => 'Opl Ov',
            'opl_rs' => 'Opl Rs',
            'opl_sm' => 'Opl Sm',
            'opl_sn' => 'Opl Sn',
            'opl_su' => 'Opl Su',
            'opl_ub' => 'Opl Ub',
            'opl_sz' => 'Opl Sz',
            'wzmz' => 'Wzmz',
            'pach' => 'Pach',
            'dt' => 'Dt',
            'restr' => 'Restr',
            'note' => 'Note',
            'doc' => 'Doc',
            'kl' => 'Kl',
            'upd' => 'Upd',
            'period' => 'Period',
        ];
    }
}
