<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtKart;

/**
 * SearchUtKart represents the model behind the search form of `app\poslug\models\UtKart`.
 */
class SearchUtKart extends UtKart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idcod', 'id_ulica', 'kv', 'ur_fiz', 'id_oldkart'], 'integer'],
            [['name_f', 'name_i', 'name_o', 'fio', 'dom', 'korp', 'pass', 'telef'], 'safe'],
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
        $query = UtKart::find();

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
            'idcod' => $this->idcod,
            'id_ulica' => $this->id_ulica,
            'kv' => $this->kv,
            'ur_fiz' => $this->ur_fiz,
            'id_oldkart' => $this->id_oldkart,
        ]);

        $query->andFilterWhere(['like', 'name_f', $this->name_f])
            ->andFilterWhere(['like', 'name_i', $this->name_i])
            ->andFilterWhere(['like', 'name_o', $this->name_o])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'dom', $this->dom])
            ->andFilterWhere(['like', 'korp', $this->korp])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'telef', $this->telef]);

        return $dataProvider;
    }
}
