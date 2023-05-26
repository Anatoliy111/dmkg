<?php

namespace app\models;

use app\models\UtAbonent;
use yii\base\BaseObject;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * SearchUtAbonent represents the model behind the search form of `app\models\UtAbonent`.
 */
class SearchUtAbonent extends UtAbonent
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_AUTH = 'auth';

    public function rules()
    {
        return [
            [['id', 'del', 'status'], 'integer'],
            [['fio', 'date_pass', 'passopen', 'telef'], 'safe'],
            [['email'], 'email'],
            [['pass'], 'string', 'min' => 5],
            [['email', 'pass'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_AUTH] = ['email', 'pass'];
        return $scenarios;
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
        $query = UtAbonent::find();

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
            'date_pass' => $this->date_pass,
            'del' => $this->del,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'passopen', $this->passopen])
            ->andFilterWhere(['like', 'telef', $this->telef])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function searchauth($params)
    {
        $query = UtAbonent::find();

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

        $query->andFilterWhere(['like', 'passopen', $this->pass])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
