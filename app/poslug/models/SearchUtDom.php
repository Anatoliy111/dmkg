<?php

namespace app\poslug\models;

use app\poslug\models\UtDom;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


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
            [['id', 'id_ulica'], 'integer'],
            [['n_dom', 'note','image'], 'safe'],
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
        ]);

        $query->andFilterWhere(['like', 'n_dom', $this->n_dom])
            ->andFilterWhere(['like', 'note', $this->note])
        ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }

    public function updspis()
    {

        $doms = UtKart::find()->groupBy(['id_ulica','dom'])->all();
        foreach ($doms as $adres) {
            // $customer - это объекта класса Customer
            if ($adres->dom<>'' and $adres->id_ulica<>null)
            {
                $FindDom = UtDom::findOne(['n_dom' => $adres->dom,'id_ulica' => $adres->id_ulica]);
                if ($FindDom == null)
                {
                    $dom = new UtDom();
                    $dom->id_ulica = $adres->id_ulica;
                    $dom->n_dom = $adres->dom;
                    $dom->save();
                }
            }

// обновить имеющуюся строку данных
//            $customer = Customer::findOne(123);
//            $customer->email = 'james@newexample.com';
//            $customer->save();
        }


        $query = UtDom::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}
