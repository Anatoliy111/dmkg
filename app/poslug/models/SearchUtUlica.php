<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtUlica;

/**
 * SearchUtUlica represents the model behind the search form of `app\poslug\models\UtUlica`.
 */
class SearchUtUlica extends UtUlica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ul', 'st_ul'], 'safe'],
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
    public function search($params,$filter)
    {
        $query = UtUlica::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


		if ($filter <> null)
		{
			$this->load($filter);
    	}
		if ($params<>null)
		{
			$this->load($params);
		}


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'ul', $this->ul])
            ->andFilterWhere(['like', 'st_ul', $this->st_ul]);

        return $dataProvider;
    }
}
