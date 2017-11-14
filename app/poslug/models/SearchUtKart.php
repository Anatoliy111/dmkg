<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtKart;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/**
 * SearchUtKart represents the model behind the search form of `app\poslug\models\UtKart`.
 */
class SearchUtKart extends UtKart
{
    /**
     * @inheritdoc
	 *
	 *
     */
	public $ulica;

    public function rules()
    {
        return [
            [['id', 'idcod', 'id_ulica', 'ur_fiz','id_dom', 'privat'], 'integer'],
            [['name_f', 'name_i', 'name_o', 'fio', 'dom', 'korp', 'pass', 'id_rabota','telef','ulica','kv'], 'safe'],
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
        $query = UtKart::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//		$query = new Query;
//		$query = (new \yii\db\Query())->from('ut_kart')->leftJoin('ut_abonent','ut_abonent.id_kart = ut_kart.id')->all();
////		$query = (new \yii\db\Query())->from('ut_kart')->all();
//
//		$dataProvider = new ArrayDataProvider([
//			'allModels' => $query,
//			'sort' => [
////				'attributes' => ['id','schet'],
//				'attributes' => ['id'],
//			],
//			'pagination' => [
//				'pageSize' => 20,
//			],
//		]);
//		$query->from('ut_kart')->all();
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

		$dataProvider->sort->attributes['utAbonents'] = [
			'asc' => ['ut_аbonent.schet' => SORT_ASC],
			'desc' => ['ut_аbonent.schet' => SORT_DESC],
		];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idcod' => $this->idcod,
            'id_ulica' => $this->id_ulica,
            'kv' => $this->kv,
            'ur_fiz' => $this->ur_fiz,
			'id_dom' => $this->id_dom,
			'privat' => $this->privat
        ]);

        $query->andFilterWhere(['like', 'name_f', $this->name_f])
            ->andFilterWhere(['like', 'name_i', $this->name_i])
            ->andFilterWhere(['like', 'name_o', $this->name_o])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'dom', $this->dom])
            ->andFilterWhere(['like', 'korp', $this->korp])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'telef', $this->telef])
			->andFilterWhere(['like', 'rabota', $this->rabota])
			->andFilterWhere(['LIKE', UtUlica::tableName() . '.ul', $this->ulica]);
//		    ->andFilterWhere(['LIKE', UtAbonent::tableName() . '.schet', $this->utAbonents]);
//			->andFilterWhere(['like', 'ut_ulica.ul', $this->ulica]);


        return $dataProvider;
    }
}
