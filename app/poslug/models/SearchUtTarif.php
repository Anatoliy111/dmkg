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
            [['id', 'id_org', 'id_tipposl', 'id_vidpokaz', 'del'], 'integer'],
            [['tarif1', 'tarif2', 'tarif3', 'koef_skl', 'norma', 'normalgot', 'normalgotsm'], 'number'],
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
            'tarif1' => $this->tarif1,
            'tarif2' => $this->tarif2,
            'tarif3' => $this->tarif3,
            'koef_skl' => $this->koef_skl,
            'norma' => $this->norma,
            'normalgot' => $this->normalgot,
            'normalgotsm' => $this->normalgotsm,
            'del' => $this->del,
        ]);

        return $dataProvider;
    }
}
