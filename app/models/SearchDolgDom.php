<?php

namespace app\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * SearchUtDom represents the model behind the search form of `app\poslug\models\UtDom`.
 */
class SearchDolgDom extends DolgDom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kl_ul'], 'required'],
            [['kl_ul'], 'number'],
            [['ulnaim', 'nomdom'], 'string'],
            [['ndom'], 'integer'],
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
        $query = DolgDom::find();


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 50,
			],
//			'sort' => [
//				'attributes' => [
////					'id_ulica' => SORT_ASC,
//					'intdom' => SORT_ASC,
//				]
//			],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'kl_ul' => $this->kl_ul
        ]);

//        $query->orderBy('n_dom');

        $query->orderBy(['ulnaim' => SORT_ASC, 'ndom' => SORT_ASC, 'nomdom' => SORT_ASC]);



        return $dataProvider;
    }

}