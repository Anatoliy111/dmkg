<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UtAbonent;

/**
 * SearchUtAbonent represents the model behind the search form of `app\models\UtAbonent`.
 */
class SearchUtAbonent extends UtAbonent
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_AUTH = 'auth';
    const SCENARIO_REG = 'registr';

    public function rules()
    {
        return [
            [['id', 'id_org', 'id_kart', 'val', 'del', 'telefon'], 'integer'],
            [['schet', 'fio', 'note', 'pass', 'date_pass', 'passopen','date_entry','email', 'vb_api_key', 'vb_date', 'vb_org', 'vb_receiver', 'vb_name', 'vb_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_AUTH] = ['email', 'pass',];
        $scenarios[self::SCENARIO_REG] = ['email', 'pass', 'fio'];
        return $scenarios;

//        return Model::scenarios();
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
            'id_org' => $this->id_org,
            'id_kart' => $this->id_kart,
            'val' => $this->val,
            'del' => $this->del,
            'date_pass' => $this->date_pass,
            'telefon' => $this->telefon,
            'date_entry' => $this->date_entry,
        ]);

        $query->andFilterWhere(['like', 'schet', $this->schet])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'passopen', $this->passopen])
            ->andFilterWhere(['like', 'email', $this->email]);


        return $dataProvider;
    }
}
