<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtDomakt;

/**
 * SearchUtDomakt represents the model behind the search form of `app\poslug\models\UtDomakt`.
 */
class SearchUtDomakt extends UtDomakt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_dom', 'id_postach', 'id_tarifvid', 'cena', 'kol', 'summa', 'proveden'], 'integer'],
            [['period', 'n_akt', 'notevid'], 'safe'],
            [['obem'], 'number'],
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
        $query = UtDomakt::find();

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
            'id_postach' => $this->id_postach,
            'id_tarifvid' => $this->id_tarifvid,
            'obem' => $this->obem,
            'cena' => $this->cena,
            'kol' => $this->kol,
            'summa' => $this->summa,
            'proveden' => $this->proveden,
        ]);

        $query->andFilterWhere(['like', 'n_akt', $this->n_akt])
            ->andFilterWhere(['like', 'notevid', $this->notevid]);

        return $dataProvider;
    }
}
