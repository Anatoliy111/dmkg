<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lich".
 *
 * @property int $id
 * @property string|null $schet
 * @property string|null $tip
 * @property string|null $n_lich
 * @property string|null $data_vip
 * @property string|null $data_pov
 * @property string|null $n_inplomb
 * @property string|null $n_mgplomb
 * @property string|null $data_inp
 * @property string|null $data_mgp
 * @property string|null $data_zn
 * @property string|null $note
 * @property int|null $vid_zn
 * @property string|null $data_vig
 * @property string|null $data_stpov
 */
class Lich extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lich';
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
            [['id'], 'required'],
            [['id', 'vid_zn'], 'integer'],
            [['data_vip', 'data_pov', 'data_inp', 'data_mgp', 'data_zn', 'data_vig', 'data_stpov'], 'string'],
            [['schet'], 'string', 'max' => 10],
            [['tip', 'n_lich', 'n_inplomb', 'n_mgplomb'], 'string', 'max' => 20],
            [['note'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schet' => 'Schet',
            'tip' => 'Tip',
            'n_lich' => 'N Lich',
            'data_vip' => 'Data Vip',
            'data_pov' => 'Дата повірки',
            'n_inplomb' => 'N Inplomb',
            'n_mgplomb' => 'N Mgplomb',
            'data_inp' => 'Data Inp',
            'data_mgp' => 'Data Mgp',
            'data_zn' => 'Data Zn',
            'note' => 'Note',
            'vid_zn' => 'Vid Zn',
            'data_vig' => 'Дата виготовлення',
            'data_stpov' => 'Data Stpov',
        ];
    }
}
