<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtRabota;

/**
 * SearchUtRabota represents the model behind the search form of `app\poslug\models\UtRabota`.
 */
class SearchUtRabota extends UtRabota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_oldorg'], 'integer'],
            [['name', 'fio_ruk', 'adress', 'tel'], 'safe'],
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
        $query = UtRabota::find();

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
            'id_oldorg' => $this->id_oldorg,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'fio_ruk', $this->fio_ruk])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}
