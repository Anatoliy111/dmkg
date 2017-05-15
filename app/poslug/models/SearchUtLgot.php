<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtLgot;

/**
 * SearchUtLgot represents the model behind the search form of `app\poslug\models\UtLgot`.
 */
class SearchUtLgot extends UtLgot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_vidlgot', 'kat', 'flag_vrem', 'activ'], 'integer'],
            [['period', 'fio', 'posv_ser', 'date_n', 'date_k'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UtLgot::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_org' => $this->id_org,
            'period' => $this->period,
            'id_abonent' => $this->id_abonent,
            'id_vidlgot' => $this->id_vidlgot,
            'date_n' => $this->date_n,
            'date_k' => $this->date_k,
            'kat' => $this->kat,
            'flag_vrem' => $this->flag_vrem,
            'activ' => $this->activ,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'posv_ser', $this->posv_ser]);

        return $dataProvider;
    }
}
