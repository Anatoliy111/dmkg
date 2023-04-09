<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtLich;

/**
 * SearchUtLich represents the model behind the search form of `app\poslug\models\UtLich`.
 */
class SearchUtLich extends UtLich
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_pokaz'], 'integer'],
            [['period', 'data'], 'safe'],
            [['pokaz_n', 'pokaz_k', 'rizn'], 'number'],
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
        $query = UtLich::find();

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
            'id_abonent' => $this->id_abonent,
            'id_pokaz' => $this->id_pokaz,
            'period' => $this->period,
            'data' => $this->data,
            'pokaz_n' => $this->pokaz_n,
            'pokaz_k' => $this->pokaz_k,
            'rizn' => $this->rizn,
        ]);

        return $dataProvider;
    }
}
