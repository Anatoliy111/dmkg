<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ea_roles".
 *
 * @property int $id
 * @property string $roles
 */
class EaRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ea_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roles'], 'required'],
            [['roles'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'roles' => Yii::t('easyii', 'Roles'),
        ];
    }
}
