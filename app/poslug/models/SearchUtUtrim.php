<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtUtrim;

/**
 * SearchUtUtrim represents the model behind the search form of `app\poslug\models\UtUtrim`.
 */
class SearchUtUtrim extends UtUtrim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_posl', 'id_tipposl', 'id_vidutr', 'id_rabota', 'procent', 'flag_vrem', 'activ'], 'integer'],
            [['period', 'data_n', 'data_k', 'zayav'], 'safe'],
            [['summa'], 'number'],
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
        $query = UtUtrim::find();

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
            'period' => $this->period,
            'id_posl' => $this->id_posl,
            'id_tipposl' => $this->id_tipposl,
            'id_vidutr' => $this->id_vidutr,
            'id_rabota' => $this->id_rabota,
            'summa' => $this->summa,
            'procent' => $this->procent,
            'data_n' => $this->data_n,
            'data_k' => $this->data_k,
            'flag_vrem' => $this->flag_vrem,
            'activ' => $this->activ,
        ]);

        $query->andFilterWhere(['like', 'zayav', $this->zayav]);

        return $dataProvider;
    }
}
