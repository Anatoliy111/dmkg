<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtNarah;

/**
 * SearchUtNarah represents the model behind the search form of `app\poslug\models\UtNarah`.
 */
class SearchUtNarah extends UtNarah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'id_vidlgot', 'id_tarif', 'id_vidpokaz'], 'integer'],
            [['period', 'tipposl', 'lgot', 'vidpokaz', 'ed_izm'], 'safe'],
            [['tarif', 'pokaznik', 'nnorma', 'sum'], 'number'],
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
        $query = UtNarah::find();

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
            'period' => $this->period,
            'id_abonent' => $this->id_abonent,
            'id_posl' => $this->id_posl,
            'id_tipposl' => $this->id_tipposl,
            'id_vidlgot' => $this->id_vidlgot,
            'id_tarif' => $this->id_tarif,
            'tarif' => $this->tarif,
            'id_vidpokaz' => $this->id_vidpokaz,
            'pokaznik' => $this->pokaznik,
            'nnorma' => $this->nnorma,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'tipposl', $this->tipposl])
            ->andFilterWhere(['like', 'lgot', $this->lgot])
            ->andFilterWhere(['like', 'vidpokaz', $this->vidpokaz])
            ->andFilterWhere(['like', 'ed_izm', $this->ed_izm]);

        return $dataProvider;
    }
}
