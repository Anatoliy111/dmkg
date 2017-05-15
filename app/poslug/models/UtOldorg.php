<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_oldorg".
 *
 * @property int $id
 * @property int $org
 * @property string $name
 * @property string $ruk
 *
 * @property UtRabota[] $utRabotas
 */
class UtOldorg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_oldorg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['ruk'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'org' => Yii::t('easyii', 'Org'),
            'name' => Yii::t('easyii', 'Name'),
            'ruk' => Yii::t('easyii', 'Ruk'),
        ];
    }

	public function getFormAttribs() {
		return [
			['class' => '\kartik\grid\SerialColumn'],

			'org',
			'name',
			'ruk',
[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
		];

	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtRabotas()
    {
        return $this->hasMany(UtRabota::className(), ['id_oldorg' => 'id']);
    }
}
