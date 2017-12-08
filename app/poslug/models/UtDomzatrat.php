<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_domzatrat".
 *
 * @property int $id
 * @property int $id_ulica вулиця
 * @property string $dom номер будинку
 * @property string $note нотатки
 * @property string $date
 * @property double $sum
 *
 * @property UtUlica $ulica
 */
class UtDomzatrat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_domzatrat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ulica', 'dom', 'note', 'date', 'sum'], 'required'],
            [['id_ulica'], 'integer'],
            [['note'], 'string'],
            [['date'], 'safe'],
            [['sum'], 'number'],
            [['dom'], 'string', 'max' => 11],
			[['id_ulica'], 'exist', 'skipOnError' => true, 'targetClass' => UtUlica::className(), 'targetAttribute' => ['id_ulica' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_ulica' => Yii::t('easyii', 'Id Ulica'),
			'ulica' => Yii::t('easyii', 'Ulica'),
            'dom' => Yii::t('easyii', 'Dom'),
            'note' => Yii::t('easyii', 'Note'),
            'date' => Yii::t('easyii', 'Date'),
            'sum' => Yii::t('easyii', 'Sum'),
        ];
    }


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUlica()
	{
		return $this->hasOne(UtUlica::className(), ['id' => 'id_ulica']);
	}
}
