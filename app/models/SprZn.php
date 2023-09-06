<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spr_zn".
 *
 * @property int $id
 * @property string|null $vid_zn
 * @property int|null $vid_ob
 * @property string|null $vid_sp
 */
class SprZn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spr_zn';
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
            [['id','vid_ob'], 'integer'],
            [['vid_zn'], 'string', 'max' => 50],
            [['vid_sp'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vid_zn' => 'Vid Zn',
            'vid_ob' => 'Vid Ob',
            'vid_sp' => 'Vid Sp',
        ];
    }
}
