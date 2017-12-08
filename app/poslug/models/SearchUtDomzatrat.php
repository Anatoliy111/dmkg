<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtDomzatrat;

/**
 * SearchUtDomzatrat represents the model behind the search form of `app\poslug\models\UtDomzatrat`.
 */
class SearchUtDomzatrat extends UtDomzatrat
{
    /**
     * @inheritdoc
     */
	public $ulica;

    public function rules()
    {
        return [
            [['id', 'id_ulica'], 'integer'],
            [['dom', 'note', 'date','ulica'], 'safe'],
            [['sum'], 'number'],
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
        $query = UtDomzatrat::find();

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

		$query->joinWith('ulica');
//		$query->joinWith('utAbonents');

		$dataProvider->sort->attributes['ulica'] = [
			'asc' => ['ut_ulica.ul' => SORT_ASC],
			'desc' => ['ut_ulica.ul' => SORT_DESC],
		];


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_ulica' => $this->id_ulica,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'dom', $this->dom])
		->andFilterWhere(['LIKE', UtUlica::tableName() . '.ul', $this->ulica]);

        return $dataProvider;
    }
}
