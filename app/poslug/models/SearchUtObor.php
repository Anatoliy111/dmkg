<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtObor;

/**
 * SearchUtObor represents the model behind the search form of `app\poslug\models\UtObor`.
 */
class SearchUtObor extends UtObor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_posl'], 'integer'],
            [['period'], 'safe'],
            [['dolg', 'nach', 'subs', 'opl', 'pere', 'sal'], 'number'],
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
        $query = UtObor::find();

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
            'dolg' => $this->dolg,
            'nach' => $this->nach,
            'subs' => $this->subs,
            'opl' => $this->opl,
            'pere' => $this->pere,
            'sal' => $this->sal,
        ]);

        return $dataProvider;
    }
}
