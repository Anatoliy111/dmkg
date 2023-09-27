<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "{{%wid}}".
 *
 * @property string|null $wid
 * @property float|null $id_org
 * @property string|null $naim
 * @property string|null $snaim
 * @property string|null $wnaim
 * @property string|null $par
 * @property string|null $fl0
 * @property string|null $fl
 * @property string|null $cod
 * @property string|null $abonpl
 * @property string|null $vnesk
 * @property float|null $group
 * @property float|null $npp
 * @property string|null $vid
 * @property string|null $fl_nonach
 * @property string|null $fl_noopl
 * @property string|null $fl_vtch
 * @property string|null $fl_noobor
 * @property float|null $fl_gropl
 * @property float|null $fl_subs
 * @property float|null $val
 * @property int|null $upd
 */
class DolgWid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%wid}}';
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
            [['id_org', 'group', 'npp', 'fl_gropl', 'fl_subs', 'val'], 'number'],
            [['upd'], 'integer'],
            [['wid', 'abonpl', 'vnesk'], 'string', 'max' => 2],
            [['naim'], 'string', 'max' => 15],
            [['snaim'], 'string', 'max' => 8],
            [['wnaim'], 'string', 'max' => 20],
            [['par'], 'string', 'max' => 10],
            [['fl0', 'fl', 'fl_nonach', 'fl_noopl', 'fl_vtch', 'fl_noobor'], 'string', 'max' => 1],
            [['cod'], 'string', 'max' => 5],
            [['vid'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wid' => 'Wid',
            'id_org' => 'Id Org',
            'naim' => 'Naim',
            'snaim' => 'Snaim',
            'wnaim' => 'Wnaim',
            'par' => 'Par',
            'fl0' => 'Fl0',
            'fl' => 'Fl',
            'cod' => 'Cod',
            'abonpl' => 'Abonpl',
            'vnesk' => 'Vnesk',
            'group' => 'Group',
            'npp' => 'Npp',
            'vid' => 'Vid',
            'fl_nonach' => 'Fl Nonach',
            'fl_noopl' => 'Fl Noopl',
            'fl_vtch' => 'Fl Vtch',
            'fl_noobor' => 'Fl Noobor',
            'fl_gropl' => 'Fl Gropl',
            'fl_subs' => 'Fl Subs',
            'val' => 'Val',
            'upd' => 'Upd',
        ];
    }
}
