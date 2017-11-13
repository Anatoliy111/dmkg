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
	public $kart;
	public $org;

    public function rules()
    {
        return [
            [['id', 'id_org', 'schet', 'id_kart'], 'integer'],
            [['note','kart','org'], 'safe'],
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

		$query->joinWith('kart');
		$query->joinWith('org');

		$dataProvider->sort->attributes['kart'] = [
			'asc' => ['ut_kart.fio' => SORT_ASC],
			'desc' => ['ut_kart.fio' => SORT_DESC],
		];

		$dataProvider->sort->attributes['org'] = [
			'asc' => ['ut_org.naim' => SORT_ASC],
			'desc' => ['ut_org.naim' => SORT_DESC],
		];


        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_org' => $this->id_org,
            'schet' => $this->schet,
//            'id_kart' => $this->id_kart,
//            'id_oldkart' => $this->id_oldkart,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
		->andFilterWhere(['like', UtKart::tableName() . '.fio', $this->kart])
		->andFilterWhere(['like', UtOrg::tableName() . '.naim', $this->org]);

        return $dataProvider;
    }
}
