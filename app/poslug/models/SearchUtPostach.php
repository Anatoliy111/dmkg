<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtPostach;

/**
 * SearchUtPostach represents the model behind the search form of `app\poslug\models\UtPostach`.
 */
class SearchUtPostach extends UtPostach
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'edrpou'], 'integer'],
            [['postach', 'note'], 'safe'],
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
        $query = UtPostach::find();

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
            'edrpou' => $this->edrpou,
        ]);

        $query->andFilterWhere(['like', 'postach', $this->postach])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
