<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtAuth;

/**
 * SearchUtAuth represents the model behind the search form of `app\poslug\models\UtAuth`.
 */
class SearchUtAuth extends UtAuth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kart', 'status'], 'integer'],
            [['date', 'fio_p', 'fio_i', 'fio_b', 'passw', 'telef', 'email'], 'safe'],
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
        $query = UtAuth::find();

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
            'date' => $this->date,
            'id_kart' => $this->id_kart,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fio_p', $this->fio_p])
            ->andFilterWhere(['like', 'fio_i', $this->fio_i])
            ->andFilterWhere(['like', 'fio_b', $this->fio_b])
            ->andFilterWhere(['like', 'passw', $this->passw])
            ->andFilterWhere(['like', 'telef', $this->telef])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
