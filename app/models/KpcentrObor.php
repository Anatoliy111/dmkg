<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kpcentr_obor".
 *
 * @property int $id
 * @property string $period
 * @property string $schet
 * @property string $wid
 * @property string $naim_wid
 * @property string $fio
 * @property string $im
 * @property string $ot
 * @property double $dolg
 * @property double $opl
 * @property double $sal
 * @property string $ulnaim
 * @property string $nomdom
 * @property string $nomkv
 */
class KpcentrObor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpcentr_obor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period', 'schet', 'wid', 'naim_wid', 'fio', 'ulnaim'], 'required'],
            [['period'], 'safe'],
            //[['dolg', 'opl', 'sal'], 'number'],
            [['schet'], 'string', 'max' => 10],
            [['wid'], 'string', 'max' => 2],
            [['naim_wid', 'im', 'ot'], 'string', 'max' => 15],
            [['fio'], 'string', 'max' => 45],
            [['ulnaim'], 'string', 'max' => 64],
            [['nomdom', 'nomkv'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period' => 'Period',
            'schet' => 'Schet',
            'wid' => 'Wid',
            'naim_wid' => 'Naim Wid',
            'fio' => 'Fio',
            'im' => 'Im',
            'ot' => 'Ot',
            'dolg' => 'Dolg',
            'opl' => 'Opl',
            'sal' => 'Sal',
            'ulnaim' => 'Ulnaim',
            'nomdom' => 'Nomdom',
            'nomkv' => 'Nomkv',
        ];
    }
}
