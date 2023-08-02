<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ut_abonpokazn".
 *
 * @property int $id
 * @property int|null $id_abonent
 * @property string $schet
 * @property string $date_ins
 * @property string $data
 * @property int $pokazn
 * @property string|null $name
 * @property int $status
 * @property string $vid
 */
class UtAbonpokazn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ut_abonpokazn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pokazn', 'status'], 'integer'],
            [['id_abonent','schet', 'date_pok', 'pokazn', 'vid'], 'required'],
            [['date_ins', 'date_pok'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 64],
            [['vid'], 'string', 'max' => 32],
            [['pokazn'], function ($attribute) {
                $pok = UtPokazn::find()->where(['SCHET' => $this->schet])->orderBy(['DATE_POK' => SORT_DESC])->one();
                if ($this->pokazn<=$pok->POKAZN) {
                    $this->addError($attribute, "Ваш показник меньший або рівний за останній зареєстрований показник!!!");
                }
                else {
                    $poksite = UtAbonpokazn::find()->where(['schet' => $this->schet])->orderBy(['date_ins' => SORT_DESC])->one();
                    if ($poksite<>null)
                        if ($poksite->date_pok == $this->date_pok) {
                            if ($poksite->vid == 'site') $this->addError($attribute,  "Ви вже сьогодні подали показник " . $poksite->pokazn . " через кабінет споживача!!! За один день здаємо тільки один показник!");
                            if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже сьогодні подали показник " . $poksite->pokazn . " через ViberBot!!! За один день здаємо тільки один показник!");
                        } elseif ($this->pokazn <= $poksite->pokazn) {
                            if ($poksite->vid == 'site') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->date_pok . " через кабінет споживача!!!");
                            if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->date_pok . " через ViberBot!!!");
                        }
                    }


            }],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_abonent' => 'Id Abonent',
            'schet' => 'Schet',
            'date_ins' => 'Date Ins',
            'date_pok' => 'Date Pok',
            'pokazn' => 'Показник',
            'name' => 'Name',
            'status' => 'Status',
            'vid' => 'Vid',
        ];
    }
}
