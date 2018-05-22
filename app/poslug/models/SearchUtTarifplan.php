<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtTarifplan;

/**
 * SearchUtTarifplan represents the model behind the search form of `app\poslug\models\UtTarifplan`.
 */
class SearchUtTarifplan extends UtTarifplan
{
    /**
     * @inheritdoc
     */
    public $ulica;
    public $n_dom;

    public function rules()
    {
        return [
//            [['id', 'id_dom', 'id_tipposl', 'id_vidpokaz'], 'integer'],
            [['period','ulica','n_dom'], 'safe'],
            [['tarifplan'], 'number'],
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
        $query = UtTarifplan::find();


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
        $query->leftJoin('ut_dom','`ut_tarifplan`.`id_dom`=`ut_dom`.`id`');
        $query->leftJoin('ut_ulica','`ut_ulica`.`id`=`ut_dom`.`id_ulica`');
//        $query->select('*, CAST(ut_dom.n_dom AS SIGNED) AS intdom');

        $dataProvider->sort->attributes['ulica'] = [
            'asc' => ['ut_ulica.ul' => SORT_ASC],
            'desc' => ['ut_ulica.ul' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['n_dom'] = [
            'asc' => ['CAST(ut_dom.n_dom AS SIGNED)' => SORT_ASC],
            'desc' => ['CAST(ut_dom.n_dom AS SIGNED)' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'period' => $this->period,
            'id_dom' => $this->id_dom,
            'id_tipposl' => $this->id_tipposl,
            'id_vidpokaz' => $this->id_vidpokaz,
            'tarifplan' => $this->tarifplan,
        ]);

        $query->andFilterWhere(['LIKE', UtUlica::tableName() . '.ul', $this->ulica]);
        $query->andFilterWhere(['LIKE', UtDom::tableName() . '.n_dom', $this->n_dom]);

        return $dataProvider;
    }
}
