<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtPosl;

/**
 * SearchUtPosl represents the model behind the search form of `app\poslug\models\UtPosl`.
 */
class SearchUtPosl extends UtPosl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_tipposl', 'flag_vrem', 'flag_dom', 'id_dom', 'del'], 'integer'],
            [['period', 'date_n', 'date_k', 'n_dog', 'date_dog'], 'safe'],
            [['nnorma'], 'number'],
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
        $query = UtPosl::find();

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
            'id_abonent' => $this->id_abonent,
            'id_tipposl' => $this->id_tipposl,
            'flag_vrem' => $this->flag_vrem,
            'date_n' => $this->date_n,
            'date_k' => $this->date_k,
            'date_dog' => $this->date_dog,
            'nnorma' => $this->nnorma,
            'flag_dom' => $this->flag_dom,
            'id_dom' => $this->id_dom,
            'del' => $this->del,
        ]);

        $query->andFilterWhere(['like', 'n_dog', $this->n_dog]);

        return $dataProvider;
    }
}
