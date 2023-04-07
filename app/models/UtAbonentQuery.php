<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UtAbonent]].
 *
 * @see UtAbonent
 */
class UtAbonentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UtAbonent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UtAbonent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
