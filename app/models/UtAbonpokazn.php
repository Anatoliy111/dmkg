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
            [['id_abonent','schet', 'pokazn', 'vid'], 'required'],
            [['date_ins'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 64],
            [['vid'], 'string', 'max' => 32],
            [['pokazn'], function ($attribute) {
                $pok = Pokazn::find()->where(['schet' => iconv('UTF-8', 'windows-1251', $this->schet)])->andWhere(['or', ['del' => 0], ['del' => null]])->orderBy(['date_pok' => SORT_DESC])->one();
                $period = $_SESSION['period'];
                if ($this->pokazn<$pok->pokazn) {
                    $this->addError($attribute, "Ваш показник меньший за останній зареєстрований показник ".$pok->pokazn."!!! Спробуйте ще");
                }
                else {
         //           $poksite = UtAbonpokazn::find()->where(['schet' => $this->schet])->orderBy(['date_ins' => SORT_DESC])->one();
                    $poksite = UtAbonpokazn::find()->where(['schet' => iconv('windows-1251', 'UTF-8', $this->schet)])->andwhere(['>=','data',$period])->orderBy(['date_ins' => SORT_DESC])->one();
                    if ($poksite<>null)
                        if ($poksite->data == $this->data) {
                            if ($poksite->vid == 'site') $this->addError($attribute,  "Ви вже сьогодні подали показник " . $poksite->pokazn . " через кабінет споживача!!! За один день здаємо тільки один показник!");
                            if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже сьогодні подали показник " . $poksite->pokazn . " через ViberBot!!! За один день здаємо тільки один показник!");
                        } elseif ($this->pokazn <= $poksite->pokazn) {
                            if ($poksite->vid == 'site') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->data . " через кабінет споживача!!!");
                            if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->data . " через ViberBot!!!");
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
