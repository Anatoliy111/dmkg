<?php

namespace app\models;

use Yii;
use yii\easyii\helpers\Data;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pokazn".
 *
 * @property int $id
 * @property int|null $yearmon
 * @property int|null $pokazn
 * @property int|null $pokaznik
 * @property int|null $vid_pok
 * @property int|null $n_doc
 * @property string|null $date_zn
 * @property int|null $vid_zn
 * @property string|null $schet
 * @property int|null $id_lich
 * @property float|null $ppp
 * @property string|null $fio
 * @property int|null $fl_bigpok
 */
class Pokazn extends \yii\db\ActiveRecord
{

    public $lastpokazn;
    public $fl_pokazn;
//    public $kub;
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
            [['yearmon', 'vid_pok', 'n_doc', 'vid_zn', 'id_lich','fl_bigpok','pokazn'], 'integer'],
            [['date_pok', 'date_zn'], 'safe'],
            [['schet'], 'string', 'max' => 10],
            [['fio'], 'string', 'max' => 64],
            [['pokazn'], function ($attribute) {
                $session = Yii::$app->session;
                $pok = Pokazn::find()->where(['schet' => $this->schet])->andWhere(['or', ['del' => 0], ['del' => null]])->orderBy(['id' => SORT_DESC])->one();
                $this->lastpokazn = $pok->pokazn;
                $kub = $this->pokazn-$this->lastpokazn;
                $period = $_SESSION['period'];
                if ($this->pokazn<$this->lastpokazn) {
                    $this->addError($attribute, "Ваш показник меньший за останній зареєстрований показник ".$this->lastpokazn."! Спробуйте ще!!!");
                }
                else {
                    if ($kub > 100 and $this->vid_pok <> 21) {
                        if (isset($session['bigkub'])) {
                            //                   if (array_key_exists('bigkub',$session)) {
                            if ($kub <> $session['bigkub']) {
                                $this->addError($attribute, "Ваш показник " . $this->pokazn . " перевищує 100 кубів!!! Бажаєте продовжити(зберегти) ?");
                                $session->set('bigkub', $kub);
                                //                          $session['bigkub'] = $kub;
                            }
                        } else {
                            $this->addError($attribute, "Ваш показник " . $this->pokazn . " перевищує 100 кубів !!! Бажаєте продовжити(зберегти)?");
                            $session->set('bigkub', $kub);
                        }
                    } else {
                        $session->set('bigkub', 0);
//                       // $poksite = UtAbonpokazn::find()->where(['schet' => iconv('windows-1251', 'UTF-8', $this->schet)])->orderBy(['date_ins' => SORT_DESC])->one();
                        $poksite = UtAbonpokazn::find()->where(['schet' => iconv('windows-1251', 'UTF-8', $this->schet)])->andwhere(['>=','data',$period])->orderBy(['date_ins' => SORT_DESC])->one();
                        if ($poksite <> null)
                            if ($poksite->data == $this->date_pok) {
                                if ($poksite->vid == 'site') $this->addError($attribute, "Ви вже сьогодні подали показник " . $poksite->pokazn . " через кабінет споживача!!! За один день здаємо тільки один показник!");
                                if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже сьогодні подали показник " . $poksite->pokazn . " через ViberBot!!! За один день здаємо тільки один показник!");
                            } elseif ($this->pokazn <= $poksite->pokazn) {
                                if ($poksite->vid == 'site') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->data . " через кабінет споживача!!!");
                                if ($poksite->vid == 'viber') $this->addError($attribute, "Ви вже подали показник " . $poksite->pokazn . ' ' . $poksite->data . " через ViberBot!!!");
                            }
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
          //  'ppp' => 'Ppp'
            'fio' => 'ПІП'
        ];
    }


    public function getSprzn()
    {
        return $this->hasOne(SprZn::className(), ['id' => 'vid_pok']);
    }
}
