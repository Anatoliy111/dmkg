<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtNormrab;

/**
 * SearchUtNormrab represents the model behind the search form of `app\poslug\models\UtNormrab`.
 */
class SearchUtNormrab extends UtNormrab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tarifvid'], 'integer'],
            [['shifr', 'naim', 'ed_izm'], 'safe'],
            [['norma'], 'number'],
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
        $query = UtNormrab::find();

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
            'id_tarifvid' => $this->id_tarifvid,
            'norma' => $this->norma,
        ]);

        $query->andFilterWhere(['like', 'shifr', $this->shifr])
            ->andFilterWhere(['like', 'naim', $this->naim])
            ->andFilterWhere(['like', 'ed_izm', $this->ed_izm]);

        return $dataProvider;
    }
}
