<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtDomrab;

/**
 * SearchUtDomrab represents the model behind the search form of `app\poslug\models\UtDomrab`.
 */
class SearchUtDomrab extends UtDomrab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_dom', 'id_tarifvid', 'id_naryad', 'id_normrab', 'kol_day', 'proveden'], 'integer'],
            [['period', 'ed_izm', 'notevid'], 'safe'],
            [['norm_ed', 'obiem', 'norm_chas', 'summa'], 'number'],
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
        $query = UtDomrab::find();

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
            'id_dom' => $this->id_dom,
            'id_tarifvid' => $this->id_tarifvid,
            'id_naryad' => $this->id_naryad,
            'id_normrab' => $this->id_normrab,
            'norm_ed' => $this->norm_ed,
            'kol_day' => $this->kol_day,
            'obiem' => $this->obiem,
            'norm_chas' => $this->norm_chas,
            'summa' => $this->summa,
            'proveden' => $this->proveden,
        ]);

        $query->andFilterWhere(['like', 'ed_izm', $this->ed_izm])
            ->andFilterWhere(['like', 'notevid', $this->notevid]);

        return $dataProvider;
    }
}
