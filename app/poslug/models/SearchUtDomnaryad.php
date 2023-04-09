<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtDomnaryad;

/**
 * SearchUtDomnaryad represents the model behind the search form of `app\poslug\models\UtDomnaryad`.
 */
class SearchUtDomnaryad extends UtDomnaryad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_tarifvid', 'id_sotr', 'proveden'], 'integer'],
            [['period'], 'safe'],
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
        $query = UtDomnaryad::find();

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
            'id_tarifvid' => $this->id_tarifvid,
            'id_sotr' => $this->id_sotr,
            'proveden' => $this->proveden,
            'summa' => $this->summa,
        ]);

        return $dataProvider;
    }
}
