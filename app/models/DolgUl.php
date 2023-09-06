<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ul}}".
 *
 * @property float|null $kl
 * @property string|null $ul
 * @property float|null $val
 * @property int|null $upd
 */
class DolgUl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ul}}';
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
            [['kl', 'val'], 'number'],
            [['upd'], 'integer'],
            [['ul'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kl' => 'Kl',
            'ul' => 'Ul',
            'val' => 'Val',
            'upd' => 'Upd',
        ];
    }

    public static function getUL()
    {

        $allul = DolgUl::find()->all();
        foreach ($allul as $k=>$ul) {
            $allul[$k]['ul']=iconv('windows-1251', 'UTF-8', $ul->ul);
        }

        return $allul;
    }
}
