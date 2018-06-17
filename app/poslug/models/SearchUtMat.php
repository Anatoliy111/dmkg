<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtMat;

/**
 * SearchUtMat represents the model behind the search form of `app\poslug\models\UtMat`.
 */
class SearchUtMat extends UtMat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nom_n', 'naim', 'ed_izm'], 'safe'],
            [['kol', 'cena', 'summa', 'ostat'], 'number'],
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
        $query = UtMat::find();

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
            'kol' => $this->kol,
            'cena' => $this->cena,
            'summa' => $this->summa,
            'ostat' => $this->ostat,
        ]);

        $query->andFilterWhere(['like', 'nom_n', $this->nom_n])
            ->andFilterWhere(['like', 'naim', $this->naim])
            ->andFilterWhere(['like', 'ed_izm', $this->ed_izm]);

        return $dataProvider;
    }
}
