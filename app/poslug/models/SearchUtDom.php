<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtDom;

/**
 * SearchUtDom represents the model behind the search form of `app\poslug\models\UtDom`.
 */
class SearchUtDom extends UtDom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ulica', 'kol_kv', 'kol_pod', 'kol_etag', 'lift', 'id_olddom'], 'integer'],
            [['n_dom', 'note'], 'safe'],
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
        $query = UtDom::find();

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
            'id_ulica' => $this->id_ulica,
            'kol_kv' => $this->kol_kv,
            'kol_pod' => $this->kol_pod,
            'kol_etag' => $this->kol_etag,
            'lift' => $this->lift,
            'id_olddom' => $this->id_olddom,
        ]);

        $query->andFilterWhere(['like', 'n_dom', $this->n_dom])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
