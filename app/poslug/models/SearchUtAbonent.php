<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtAbonent;

/**
 * SearchUtAbonent represents the model behind the search form of `app\poslug\models\UtAbonent`.
 */
class SearchUtAbonent extends UtAbonent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'schet', 'id_kart', 'id_rabota', 'ur_fiz', 'id_dom', 'privat', 'id_oldkart'], 'integer'],
            [['fio', 'note'], 'safe'],
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
        $query = UtAbonent::find();

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
            'schet' => $this->schet,
            'id_kart' => $this->id_kart,
            'id_rabota' => $this->id_rabota,
            'ur_fiz' => $this->ur_fiz,
            'id_dom' => $this->id_dom,
            'privat' => $this->privat,
            'id_oldkart' => $this->id_oldkart,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
