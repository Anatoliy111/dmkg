<?php

namespace app\models;

use Yii;
use yii\easyii\helpers\Data;

/**
 * This is the model class for table "pokazn".
 *
 * @property int $id
 * @property int|null $yearmon
 * @property float|null $pokazn
 * @property string|null $date_pok
 * @property string|null $vid_pok
 * @property int|null $n_doc
 * @property string|null $date_zn
 * @property int|null $vid_zn
 * @property string|null $schet
 * @property int|null $id_lich
 * @property float|null $ppp
 * @property string|null $fio
 */
class Pokazn extends \yii\db\ActiveRecord
{

    public $lastpokazn;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pokazn';
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
            [['pokazn'], 'required'],
            [['yearmon', 'vid_pok', 'n_doc', 'vid_zn', 'id_lich'], 'integer'],
            [['pokazn', 'ppp'], 'number'],
            [['fio'], 'string', 'max' => 64],
            [['fio'], 'string', 'min' => 5],
            [['date_pok', 'date_zn'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['pokazn'], function ($attribute) {
                $pok = Pokazn::find()->where(['schet' => $this->schet])->orderBy(['id' => SORT_DESC])->one();
                $this->lastpokazn = $pok->pokazn;
                if ($this->pokazn<$this->lastpokazn) {
                    $this->addError($attribute, "Ваш показник меньший за останній зареєстрований показник ".$this->lastpokazn."! Спробуйте ще!!!");
                }
//                if ($this->pokazn=$pok->pokazn) {
////                    $this->addError($attribute, "Ваш показник меньший за останній зареєстрований показник!!! Спробуйте ще");
//
//                }
                else {
//                    if ($this->pokazn>150) {
//
//
//                    }
                    $poksite = UtAbonpokazn::find()->where(['schet' => iconv('windows-1251', 'UTF-8', $this->schet)])->orderBy(['date_ins' => SORT_DESC])->one();
                    if ($poksite<>null)
                        if ($poksite->data == $this->date_pok) {
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
            'yearmon' => 'Yearmon',
            'pokazn' => 'Введіть показник',
            'pok' => 'Введіть показник',
            'date_pok' => 'Date Pok',
            'vid_pok' => 'Vid Pok',
            'n_doc' => 'N Doc',
            'date_zn' => 'Date Zn',
            'vid_zn' => 'Vid Zn',
            'schet' => 'Schet',
            'id_lich' => 'Id Lich',
            'ppp' => 'Ppp',
            'fio' => 'ПІП',
        ];
    }


    public function getSprzn()
    {
        return $this->hasOne(SprZn::className(), ['id' => 'vid_pok']);
    }
}
