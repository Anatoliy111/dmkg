<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtTarif;

/**
 * SearchUtTarif represents the model behind the search form of `app\poslug\models\UtTarif`.
 */
class SearchUtTarif extends UtTarif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_tipposl', 'id_vidpokaz', 'del', 'kl','podezd'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['period'], 'safe'],
            [['tarifplan', 'tariffakt', 'tarifend'], 'number'],
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
        $query = UtTarif::find();

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
            'id_tipposl' => $this->id_tipposl,
            'id_vidpokaz' => $this->id_vidpokaz,
            'kl' => $this->kl,
            'podezd' => $this->podezd,
            'period' => $this->period,
            'tarifplan' => $this->tarifplan,
            'tariffakt' => $this->tariffakt,
            'tarifend' => $this->tarifend,
            'del' => $this->del,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }
}
